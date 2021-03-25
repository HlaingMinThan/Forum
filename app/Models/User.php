<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'email',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'name';
    }
    public function threads(){
        return $this->hasMany(Thread::class);
    }
    public function activities(){
        return $this->hasMany(Activity::class);
    }
    public function subscriptions(){
        return $this->hasMany(ThreadSubscription::class);
    }
    public function lastReply(){
        return $this->hasOne(Reply::class)->latest(); // a user has one latest reply
    }
    
    public function isReplyAfterOneMinute(){

        $userLastRepliedTime=$this->lastReply->updated_at;
        $beforeOneMinuteFromCurrent=Carbon::now()->subMinute();
        return  $userLastRepliedTime < $beforeOneMinuteFromCurrent;

    }
}
