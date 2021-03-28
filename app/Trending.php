<?php
namespace App;

use Illuminate\Support\Facades\Redis;

trait Trending
{
    public static function getTrendingThreads()
    {
        return array_map(function ($thread) {
            return json_decode($thread);
        }, Redis::zrevrange('trending_threads', 0, 4));
    }
    public function pushToTrendingThreads()
    {
        Redis::zincrby("trending_threads", 1, json_encode([
            'title'=>$this->title,
            'path'=>$this->path(),
        ]));
    }
}
