<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Redis;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except('index', 'show');
    }
    
    public function index($channelSlug=null)
    {
        $threads=$this->filterThreads($channelSlug);
        $trending_threads=Redis::zrevrange('trending_threads', 0, 4);//get numeric array of jsons
        $trending_threads=array_map(function ($thread) {
            return json_decode($thread);
        }, $trending_threads);
       
        return view("threads.index", compact('threads', 'trending_threads'));
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store()
    {
        // validation
        request()->validate([
            'title'=>["required",new SpamFree],
            'body'=>["required",new SpamFree],
            'channel_id'=>"required|exists:channels,id"
        ]);
        // store in database
        $thread=Thread::create([
            'user_id'=>auth()->id(),
            'title'=>request("title"),
            'body'=>request("body"),
            'channel_id'=>request("channel_id"),
        ]);
        return redirect($thread->path())->with("flash", "A Thread Has Been Created");
    }

    public function show($channelSlug, Thread $thread)
    {
        //get time of user last view into this page
        if (auth()->check()) {
            $thread->saveLastReadTimestamp();
        }

        //when user read a thread increment one visit count in redis key
        Redis::zincrby("trending_threads", 1, json_encode([
            'title'=>$thread->title,
            'path'=>$thread->path(),
        ]));
        //get all users names for mention user autocompletion
        $usernames=User::all('name');
        return view("threads.show", [
            'thread'=>$thread,
            'usernames'=>$usernames
        ]);
    }

    public function destroy($channelSlug=null, Thread $thread)
    {
        //a user can delete only his thread
        $this->authorize('update', $thread);
        
        // delete all associate thread's replies and child relations
        foreach ($thread->replies as $reply) {
            $reply->delete();
        }
        
        $thread->delete();
        return redirect()->route("threads.index");
    }

    protected function filterThreads($channelSlug=null)
    {
        if (!empty($channelSlug)) {
            $channelId=Channel::whereSlug($channelSlug)->firstOrFail()->id;
            $threads=Thread::where("channel_id", $channelId)->latest();
        } else {
            $threads=Thread::latest();
        }
        if ($username=request('by')) {
            $userId=User::where("name", $username)->firstOrFail()->id;
            $threads=Thread::where("user_id", $userId)->latest();
        }
        if (request('popular')) {
            $threads = Thread::orderBy("replies_count", "desc");
        }
        if (request('unanswered')) {
            $threads = Thread::where("replies_count", 0);
        }
        return $threads=$threads->paginate(10);
    }
}
