<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Rules\SpamFree;
use Exception;
use Illuminate\Support\Facades\Gate;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    public function index($channelSlug, Thread $thread)
    {
        return $thread->replies()->latest()->paginate(10);
    }
    public function store($channelSlug, Thread $thread)
    {

        //A user can reply again after 1minute
        if (Gate::denies("create", new Reply)) {
            return response("You are posting too frequently,pls take a break :)", 422);//error response to javascript
        }
        try {
            request()->validate([
            "body"=>['required',new SpamFree]
            ]);
        } catch (Exception $e) {
            return response("humm ,it may be spam", 422);//error response to javascript
        }

        $newReply=$thread->addReply([
            'body'=>request('body'),
            'user_id'=>auth()->user()->id
        ]);

        return $newReply->load('owner'); //return new reply json data back to javascript with owner relation
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->favorites->each->delete();
        $reply->delete();
        // return back()->with("flash","reply deleted");
         // no need to redirect because this request come from axios
    }
    public function update(Reply $reply)
    {
        try {
            request()->validate([
                "body"=>['required',new SpamFree]
            ]);
        } catch (Exception $e) {
            return response("humm ,it may be spam", 422);//error response to javascript
        }
        $this->authorize('update', $reply);
        $reply->update(['body'=>request('body')]);
        // no need to redirect because this request come from axios
    }
}
