<?php

namespace App\Http\Controllers;

use App\Inspections\Spam;
use App\Models\Reply;
use App\Models\Thread;

class RepliesController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }
    public function index($channelSlug,Thread $thread){
        return $thread->replies()->latest()->paginate(10);
    }
    public function store($channelSlug,Thread $thread,Spam $spam){
           
            $this->validateReply();

            $newReply=$thread->addReply([
                'body'=>request('body'),
                'user_id'=>auth()->user()->id
            ]);

           return $newReply->load('owner'); //return new reply json data back to javascript with owner relation
    }

    public function destroy(Reply $reply){
        $this->authorize('update',$reply);
        $reply->favorites->each->delete();
        $reply->delete();
        // return back()->with("flash","reply deleted");
         // no need to redirect because this request come from axios
    }
    public function update(Reply $reply){

        $this->validateReply();
        $this->authorize('update',$reply);
        $reply->update(['body'=>request('body')]);
        // no need to redirect because this request come from axios

    }

    public function validateReply(){

        request()->validate([
            "body"=>'required'
        ]);

        (new Spam)->detect(request("body"));

    }
}
