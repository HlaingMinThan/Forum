<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user){

        $activities=$user->activities()->with('subject')->take(20)->latest()->get()->groupBy(function($activity){
            return $activity->created_at->format("M-d-Y");
        });
        return view("profiles.show",[
            "user"=>$user,
            "activities"=>$activities
        ]);
    }
   
}
