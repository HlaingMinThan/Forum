<?php

namespace App;

use App\Models\ThreadSubscription;

trait Subscribable
{
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create(['user_id' => $userId ?: auth()->id()]);
    }

    public function unSubscribe($userId = null)
    {
        $this->subscriptions()->delete(['user_id' => $userId ?: auth()->id()]);
    }

   
}
