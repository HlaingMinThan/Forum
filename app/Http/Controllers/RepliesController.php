<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Thread $thread){
            request()->validate([
                "body"=>'required'
            ]);
            $thread->addReply([
                'body'=>request('body'),
                'user_id'=>auth()->user()->id
            ]);
            return redirect($thread->path());
    }
}
