<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\YouAreMentioned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyToMentionedUsers
{
    public function handle($event)
    {
        $mentionedUsers=$event->reply->mentionedUsers();
        foreach ($mentionedUsers as $name) {
            $user=User::whereName($name)->first();/**Be careful not using get() on where queries when u want only record */
            if ($user && $user->id!=auth()->id()) {
                $user->notify(new YouAreMentioned($event->reply));
            }
        }
    }
}
