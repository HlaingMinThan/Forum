<?php

namespace App\Models;

use App\Events\ReplyCreated;
use App\RecordsActivity;
use App\Subscribable;
use App\Trending;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Thread extends Model
{
    protected $guarded = [];
    protected $with = ['channel', 'creator'];
    use HasFactory,RecordsActivity,Subscribable,Trending;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/$this->slug";
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

    public function addReply($reply) //Array
    {
        $newReply = $this->replies()->create($reply);

        event(new ReplyCreated($newReply)); // check in the eventservice provider to what happen

        return $newReply;
    }

    public function hasAnyUpdate()
    {
        if (auth()->check()) {
            $key = $this->getCacheKey();
            $userLastReadTimeStamp = cache($key);
            return $this->updated_at > $userLastReadTimeStamp; //compare timestamp and return boolean
        }
        return false;
    }

    public function getCacheKey()
    {
        return sprintf('users.%s.reads.%s', auth()->id(), $this->id); // users.1.reads.2
    }

    public function saveLastReadTimestamp()
    {
        $key = $this->getCacheKey();

        // when user view a thread,save user last view timestamp for this thread show page in cache
        cache()->forever($key, Carbon::now());// demo => cache['users.1.reads.2'=>timestamp]
    }

    public function visitors()
    {
        /*u can write this way too
            $visitors=Redis::get("threads.{$this->id}.visits");
            return isset($visitors) ? Redis::get("threads.{$this->id}.visits"):0;
        */

        return Redis::get("threads.{$this->id}.visits") ?? 0;
    }

    public function incVisitors()
    {
        Redis::incr("threads.{$this->id}.visits");
    }

    public function markAsBestReply($reply)
    {
        $this->update([
            'best_reply_id' => $reply->id
        ]);
    }

    public function lock()
    {
        $this->update([
            'lock' => true
        ]);
    }
}
