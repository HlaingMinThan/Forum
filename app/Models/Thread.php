<?php

namespace App\Models;

use App\RecordsActivity;
use App\Subscribable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded=[];
    protected $with=['channel','replies','creator'];
    use HasFactory,RecordsActivity,Subscribable;

    
   
    public function path(){
        return "/threads/{$this->channel->slug}/$this->id";
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function replies(){
       return  $this->hasMany(Reply::class);
    }

    // public function getReplyCount(){
    //     return $this->replies()->count(); //don't forget to add replies parentheses ,if dont't add parentheses the query is run again
    // }

    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply){
       return $this->replies()->create($reply);
    }
    
}
