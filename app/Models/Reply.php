<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $with=['favorites'];
    protected $guarded=[];
    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function favorites(){
        return $this->morphMany(Favorite::class,"favorited");//default is favoritable
    }
    public function add_to_favorite(){
        Favorite::create([
            "user_id"=>auth()->user()->id,
            "favorited_id"=>$this->id,
            "favorited_type"=>get_class($this)
        ]);
        // another way for polymorphic relation
        // $reply->favorites()->create(['user_id'=>auth()->user()->id]);
    }
    public function favorited(){
        //without parthensies this is not run query
        $duplicate=$this->favorites->where("user_id",auth()->id())->count();
       return !!$duplicate;
    }
}
