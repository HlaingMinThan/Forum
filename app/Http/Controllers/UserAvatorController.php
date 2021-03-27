<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAvatorController extends Controller
{
    public function update(User $user)
    {
        $user->update([
            "avator_path"=>request('avator')->store("avators", "public") //store met return stored path
        ]);
        return back();
    }
}
