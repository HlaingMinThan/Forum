<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except('index','show');
    }
    public function index($channelSlug=null){
        if($channelSlug){
            $channelId=Channel::whereSlug($channelSlug)->firstOrFail()->id;
            $threads=Thread::where("channel_id",$channelId)->latest();
        }else{
            $threads=Thread::withCount("replies")->latest();
        }
        if($username=request('by')){
            $userId=User::where("name",$username)->firstOrFail()->id;
            $threads=Thread::withCount('replies')->where("user_id",$userId)->latest();
        }
        if(request('popular')){
            $threads = Thread::withCount('replies')->orderBy("replies_count","desc");
        }
           $threads=$threads->get();
        //    dd($threads->toArray());
        return view("threads.index",compact('threads'));
    }

    public function create(){
        return view('threads.create');
    }
    public function store(){
        request()->validate([
            'title'=>"required",
            'body'=>"required",
            'channel_id'=>"required|exists:channels,id"
        ]);
        $thread=Thread::create([
            'user_id'=>auth()->id(),
            'title'=>request("title"),
            'body'=>request("body"),
            'channel_id'=>request("channel_id"),
        ]);
        return redirect($thread->path())->with("flash","A Thread Has Been Created");
    }
    public function show($channelSlug,Thread $thread){
        return view("threads.show",[
            'thread'=>$thread,
            'replies'=>$thread->replies()->with('owner')->withCount('favorites')->latest()->paginate(5)
        ]);
    }
    public function destroy($channelSlug=null,Thread $thread){
        $this->authorize('update',$thread);
        /* 
            $thread->replies()->delete(); //this way not calling on child relations
        */
        // Calling On Child Relations
        // First way
        foreach($thread->replies as $reply){
           $reply->delete();
        }
        /* Second way
            $thread->replies->each(function($reply){
            $reply->delete();
            }); 
        /*
        /* Third Way
             $thread->replies->each->delete();
        */
        $thread->delete();
        return redirect()->route("threads.index");
    }
}
