<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index($channelSlug = null)
    {
        return view('threads.index', [
            'threads' => $this->filterThreads($channelSlug),
        ]);
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required', new SpamFree],
            'body' => ['required', new SpamFree],
            'channel_id' => 'required|exists:channels,id',
            'g-recaptcha-response' => [new Recaptcha, 'required', ]
        ]);

        // store in database
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'slug' => Str::slug(request('title')) . '_' . uniqid(),
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id'),
        ]);
        return redirect($thread->path())->with('success', 'A Thread Has Been Created');
    }

    public function show($channelSlug, Thread $thread)
    {
        //get time of user last view into this page
        if (auth()->check()) {
            $thread->saveLastReadTimestamp();
        }

        //push that thread to thread_trending counting redis list
        $thread->pushToTrendingThreads();

        // increment visit count of that thread into redis
        $thread->incVisitors();

        return view('threads.show', compact('thread'));
    }

    public function update($channelSlug = null, Thread $thread)
    {
        //a user can update only his thread
        $this->authorize('update', $thread);
        $thread->update(request()->validate([
            'title' => ['required', new SpamFree],
            'body' => ['required', new SpamFree]
        ]));
    }

    public function destroy($channelSlug = null, Thread $thread)
    {
        //a user can delete only his thread
        $this->authorize('update', $thread);

        // delete all associate thread's replies and child relations
        foreach ($thread->replies as $reply) {
            $reply->delete();
        }

        $thread->delete();
        return redirect()->route('threads.index');
    }

    protected function filterThreads($channelSlug = null)
    {
        if (!empty($channelSlug)) {
            $channelId = Channel::whereSlug($channelSlug)->firstOrFail()->id;
            $threads = Thread::where('channel_id', $channelId)->latest();
        } else {
            $threads = Thread::latest();
        }
        if ($username = request('by')) {
            $userId = User::where('name', $username)->firstOrFail()->id;
            $threads = Thread::where('user_id', $userId)->latest();
        }
        if (request('popular')) {
            $threads = Thread::orderBy('replies_count', 'desc');
        }
        if (request('unanswered')) {
            $threads = Thread::where('replies_count', 0);
        }
        return $threads = $threads->paginate(10);
    }
}
