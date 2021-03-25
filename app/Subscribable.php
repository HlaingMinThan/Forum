<?php

namespace App;

use App\Models\ThreadSubscription;

trait Subscribable
{
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function subscribe($userId=null)
    {
        $this->subscriptions()->create(['user_id'=>$userId?:auth()->id()]);
    }
    public function unSubscribe($userId=null)
    {
        $this->subscriptions()->delete(['user_id'=>$userId?:auth()->id()]);
    }
  
    public function getSubscribedOrNot()
    {
        // get AuthUser Is Subscribe this Thread Or Not
        $subscriptions=$this->subscriptions()->where('user_id', auth()->id())->get();
        // if  that subscriptions is not empty the user is not subscribed this thread
        // if  that subscriptions is  empty the user is not subscribed this thread
        return $subscriptions->isNotEmpty();
    }
}
