<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function store($channelSlug, Thread $thread)
    {
        $thread->subscribe();
    }
     
    public function destroy($channelSlug, Thread $thread)
    {
        $thread->unSubscribe();
    }
}
