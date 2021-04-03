<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class ThreadsSearchController extends Controller
{
    public function index()
    {
        $query = request('q');
        $searchResults = Thread::search($query)->paginate(10);
        return view('threads.index', [
            'threads' => $searchResults,
            'trending_threads' => Thread::getTrendingThreads()
        ]);
    }
}
