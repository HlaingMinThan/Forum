<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class ThreadsSearchController extends Controller
{
    public function index()
    {
        $trending_threads = Thread::getTrendingThreads();
        return view('threads.search', compact('trending_threads'));
    }
}
