<?php 

namespace App;

use App\Models\Favorite;

trait Favoritable{
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

    public function getFavoritedAttribute(){
        return $this->favorited();
    }

    public function remove_from_favorite(){
        return $this->favorites(['reply_id'=>$this->id])->delete();
    }
}