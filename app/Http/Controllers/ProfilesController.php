<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $activities=Activity::getAllActivitiesFrom($user);
        return view("profiles.show", [
            "user"=>$user,
            "activities"=>$activities
        ]);
    }
}
