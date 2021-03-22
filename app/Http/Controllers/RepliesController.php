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
    
    public function store($channelSlug,Thread $thread){
            request()->validate([
                "body"=>'required'
            ]);
            $newReply=$thread->addReply([
                'body'=>request('body'),
                'user_id'=>auth()->user()->id
            ]);
            // return created new reply as a json to vue
            if(request()->expectsJson()){
                return json_encode($newReply->load('owner'));//new reply as well as owner data
            }
    }

    public function destroy(Reply $reply){
        $this->authorize('update',$reply);
        $reply->favorites->each->delete();
        $reply->delete();
        // return back()->with("flash","reply deleted");
         // no need to redirect because this request come from axios
    }
    public function update(Reply $reply){
        $this->authorize('update',$reply);
        $reply->update(['body'=>request('body')]);
        // no need to redirect because this request come from axios
    }
}
