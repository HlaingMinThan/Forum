<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function index(User $user){
        return $user->unreadNotifications;
    }
    public function delete(User $user,$notificationId){
        $user->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
