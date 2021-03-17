<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index(){
        $threads=Thread::latest()->get();
        return view("threads.index",compact('threads'));
    }
    public function create(){
        return view('threads.create');
    }
    public function store(){
        $thread=Thread::create([
            'user_id'=>auth()->id(),
            'title'=>request("title"),
            'body'=>request("body"),
        ]);
        return redirect($thread->path());
    }
    public function show(Thread $thread){
        // return 'hi';
        return view("threads.show",compact('thread'));
    }
}
