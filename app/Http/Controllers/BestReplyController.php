<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class BestReplyController extends Controller
{
    public function store(Reply $reply)
    {
        if (!$reply->isBest()) {
            $reply->thread->markAsBestReply($reply);
        }
    }
}
