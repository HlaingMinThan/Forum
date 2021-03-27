<?php

namespace App;

use App\Models\Favorite;

trait Favoritable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, "favorited");//default is favoritable
    }

    public function add_to_favorite()
    {
        //favorited type and favorited id will be automatically insert
        $this->favorites()->create(['user_id'=>auth()->id()]);
    }

    public function favorited()
    {
        //without parthensies this is not run query
        $duplicate=$this->favorites->where("user_id", auth()->id())->count();
        return !!$duplicate;
    }

    /*
         getFavoritedAttribute function add favorited data
         to each reply json format which send to vue
     */
    public function getFavoritedAttribute()
    {
        return $this->favorited();
    }

    public function remove_from_favorite()
    {
        $this->favorites->where("user_id", auth()->id())->each->delete();
    }
}
