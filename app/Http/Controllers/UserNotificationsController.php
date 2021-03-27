<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function index(User $user)
    {
        //get all user's un read notis
        return $user->unreadNotifications;
    }
    public function destroy(User $user, $notificationId)
    {
        //mark noti as read
        $user->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
