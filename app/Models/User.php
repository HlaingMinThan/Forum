<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avator_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'email',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isAdmin' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function subscribed($thread)
    {
        // get AuthUser Is Subscribe this Thread Or Not
        $subscriptions = $this->subscriptions()->where('thread_id', $thread->id)->get();
        // if  that subscriptions is not empty the user is not subscribed this thread
        // if  that subscriptions is  empty the user is not subscribed this thread
        return $subscriptions->isNotEmpty();
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest(); // a user has one latest reply
    }

    public function isReplyAfterOneMinute()
    {
        if (isset($this->lastReply->updated_at)) {
            $userLastRepliedTime = $this->lastReply->updated_at;
            $beforeOneMinuteFromCurrent = Carbon::now()->subMinute();
            return  $userLastRepliedTime < $beforeOneMinuteFromCurrent;
        }
        return true;
    }

    public function avator()
    {
        return $this->avator_path ?: '/avators/user.svg';
    }

    public function getAvatorPathAttribute($value)
    {
        //check profile picture exists or not
        return isset($value) ? "/{$value}" : '/avators/user.svg';
    }
}
