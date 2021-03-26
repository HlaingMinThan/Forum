<?php

namespace App\Listeners;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyToThreadSubscribers
{
    public function handle($event)
    {
        $thread=$event->reply->thread;
        foreach ($thread->subscriptions as $sub) {
            if ($event->reply->user_id!=$sub->user_id) {
                $sub->user->notify(new ThreadWasUpdated($thread, $event->reply));
            }
        }
    }
}
