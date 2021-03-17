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
    public function show(Thread $thread){
        // return 'hi';
        return view("threads.show",compact('thread'));
    }
}
