<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class LockThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function store($channelSlug, Thread $thread)
    {
        $thread->lock();
        return redirect('/threads');
    }
}
