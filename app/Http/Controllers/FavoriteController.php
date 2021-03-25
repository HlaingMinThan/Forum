<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reply;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Reply $reply)
    {
        if (!$reply->favorited()) {
            $reply->add_to_favorite();
        }
    }
    
    public function destroy(Reply $reply)
    {
        if ($reply->favorited()) {
            $reply->remove_from_favorite();
        }
    }
}
