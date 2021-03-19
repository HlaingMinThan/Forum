<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user){

        // dd($user);
        return view("profiles.show",[
            "user"=>$user,
            "threads"=>$user->threads()->withCount('replies')->paginate(1)
        ]);
    }
   
}
