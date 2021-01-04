<?php

namespace App\Youtube;

use DateInterval;
use Illuminate\Support\Facades\Http;

class YouTubeServices{

    private $key = null;

    public function __construct(string $key) {
        $this->key = $key;
    }

    public function handleYouTubeVideoDuration(string $video_url){

        preg_match('/embed\/(.+)/', $video_url, $matches);
        $id = $matches[1];

        $http = Http::get("https://www.googleapis.com/youtube/v3/videos?key={$this->key}&id={$id}&part=contentDetails");
        $decode = json_decode($http);

        $duration = $decode->items[0]->contentDetails->duration;

        $interval = new DateInterval($duration);

        return $interval->s + $interval->i * 60 + $interval->h * 3600;
    }

}
