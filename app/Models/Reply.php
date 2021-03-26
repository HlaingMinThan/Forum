<?php

namespace App\Models;

use App\Favoritable;
use App\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory,RecordsActivity,Favoritable;
    
    protected $with=['favorites','owner'];
    //register name for getFavoritedAttribute,getOwnerAttribute function for pass to vue
    protected $appends=['favorited'];
    protected $guarded=[];

    protected static function booted()
    {
        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });
        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
    public function path()
    {
        return $this->thread->path()."#reply_$this->id";
    }
    public function mentionedUsers()
    {
        preg_match_all("/\B\@([\w\-]+)/", $this->body, $matches);
        return $matches[1];
    }
    public function setBodyAttribute($body)// override before insert in to table
    {
        $this->attributes['body']=preg_replace(
            "/\B\@([\w\-]+)/", //search mention user
            '<a class="text-blue-600 underline" href="/profiles/$1">@$1</a>',
            $body
        );
    }
}
