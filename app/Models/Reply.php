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

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }
   
    public function thread(){
        return $this->belongsTo(Thread::class);
    }
    public function path(){
        return $this->thread->path()."#reply_$this->id";
    }
}
