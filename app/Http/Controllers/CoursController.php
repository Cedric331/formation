<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Youtube\YouTubeServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class CoursController extends Controller
{

    public function index()
    {
        $courses = Course::with('user')
        ->select()
        ->withCount('episodes')
        ->addSelect(DB::raw(
        '(SELECT SUM(duration)
            FROM episodes
            WHERE episodes.course_id = courses.id
            ) AS total_duration'
        ))
        ->paginate(5);

        return Inertia::render('Courses/index', ['cours' => $courses]);
    }

    public function show($id)
    {
        $cours = Course::where('id', $id)->with('episodes')->with('user')->first();

        $episodes = Episode::where('course_id', $cours->id)->get();

        $watch = Auth::user()->episodes;

        return Inertia::render('Courses/show', [
            'cours' => $cours,
            'episodes' => $episodes,
            'watch' => $watch]);
    }

    public function store(Request $request, YouTubeServices $youTube)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'episodes' => ['required', 'array'],
            'episodes.*.title' => 'required',
            'episodes.*.description' => 'required',
            'episodes.*.video_url' => 'required',
        ]);

        $cours = Course::create($request->all());

        foreach ($request->input('episodes') as $episode) {
            $episode['course_id'] = $cours->id;
            $episode['duration'] = $youTube->handleYouTubeVideoDuration($episode['video_url']);
            Episode::create($episode);
        }

        return redirect()->route('cours.index')->with('success', 'Formation créé');
     }


    public function toggleProgress(Request $request)
    {
        $id = $request->input('episode');
        $user = Auth::user();
        $user->episodes()->toggle($id);

        return $user->episodes;
    }

    public function edit($id)
    {
        $cours = Course::where('id', $id)->with('episodes')->firstOrFail();
        $this->authorize('update', $cours);

        return Inertia::render('Courses/edit', ['cours' => $cours]);
    }

    public function update(Request $request)
    {
        $cours = Course::where('id', $request->id)->with('episodes')->firstOrFail();

        $this->authorize('update', $cours);
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'episodes' => ['required', 'array'],
        //     'episodes.*.title' => 'required',
        //     'episodes.*.description' => 'required',
        //     'episodes.*.video_url' => 'required',
        // ]);

        $cours->update($request->all());
        $cours->episodes()->delete();

        foreach ($request->episodes as $episode) {
            $episode['course_id'] = $cours->id;
                Episode::create($episode);
        }

        return redirect()->back()->with('success', 'Formation modifiée');
     }
}
