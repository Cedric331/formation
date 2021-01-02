<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{

    public function index()
    {
        $courses = Course::with('user')
        ->select()
        ->withCount('episodes')->get();

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

    public function toggleProgress(Request $request)
    {
        $id = $request->input('episode');
        $user = Auth::user();
        $user->episodes()->toggle($id);

        return $user->episodes;
    }
}
