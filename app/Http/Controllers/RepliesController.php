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
        // if this thread is lock
        if ($thread->lock) {
            return response('this thread is locked by admin', 423);
        }
        //A user can reply again after 1minute
        if (Gate::denies('create', new Reply)) {
            return response('You are posting too frequently,pls take a break :)', 422);//error response to javascript
        }
        //validation
        try {
            request()->validate([
                'body' => ['required', new SpamFree]
            ]);
        } catch (Exception $e) {
            return response('humm ,it may be spam', 422);//error response to javascript
        }

        return $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->user()->id
        ])->load('owner'); //return new reply json data back to javascript with owner relation
    }

    public function destroy(Reply $reply)
    {
        // a user can delete only his reply
        $this->authorize('update', $reply);

        // when delete a reply ,delete all assosiate relation of that reply's favorites data
        $reply->favorites->each->delete();
        $reply->delete();
    }

    public function update(Reply $reply)
    {
        // a user can update only his reply
        $this->authorize('update', $reply);

        //validation
        try {
            request()->validate([
                'body' => ['required', new SpamFree]
            ]);
        } catch (Exception $e) {
            return response('humm ,it may be spam', 422);//error response to javascript
        }

        $reply->update(['body' => request('body')]);
    }
}
