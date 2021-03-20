<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Thread $thread){
            request()->validate([
                "body"=>'required'
            ]);
            $thread->addReply([
                'body'=>request('body'),
                'user_id'=>auth()->user()->id
            ]);
            return redirect($thread->path());
    }

    public function destroy($thread,Reply $reply){
        $this->authorize('update',$reply);
        $reply->delete();
        return back()->with("flash","reply deleted");
    }
}
