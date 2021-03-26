<?php

namespace App\Models;

use App\Notifications\ThreadWasUpdated;
use App\Notifications\YouAreMentioned;
use App\RecordsActivity;
use App\Subscribable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded=[];
    protected $with=['channel','replies','creator'];
    use HasFactory,RecordsActivity,Subscribable;

    
   
    public function path()
    {
        return "/threads/{$this->channel->slug}/$this->id";
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function replies()
    {
        return  $this->hasMany(Reply::class);
    }

    // public function getReplyCount(){
    //     return $this->replies()->count(); //don't forget to add replies parentheses ,if dont't add parentheses the query is run again
    // }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $newReply=$this->replies()->create($reply);
        //send notification to thread subscriber
        foreach ($this->subscriptions as $sub) {
            if ($reply['user_id']!=$sub->user_id) {
                $sub->user->notify(new ThreadWasUpdated($this, $newReply));
            }
        }
        //send notification to mentioned user
        $replyBody=$newReply->body;
        preg_match_all("/\B\@([\w\-]+)/", $replyBody, $matches);
        $names=$matches[1];
        foreach ($names as $name) {
            $user=User::where("name", $name)->first();/**Be careful not using get() on where queries when u want only record */
            if ($user->id!=auth()->id()) {
                $user->notify(new YouAreMentioned($newReply));
            }
        }
        return $newReply;
    }
    
    public function hasAnyUpdate()
    {
        $key=$this->getCacheKey();
        $userLastReadTimeStamp=cache($key);
        return $this->updated_at>$userLastReadTimeStamp; //compare timestamp and return boolean
    }

    public function getCacheKey()
    {
        return sprintf("users.%s.reads.%s", auth()->id(), $this->id); // users.1.reads.2
    }

    public function saveLastReadTimestamp()
    {
        $key=$this->getCacheKey();

        // when user view a thread,save user last view timestamp for this thread show page in cache
        cache()->forever($key, Carbon::now());// demo => cache['users.1.reads.2'=>timestamp]
    }
}
