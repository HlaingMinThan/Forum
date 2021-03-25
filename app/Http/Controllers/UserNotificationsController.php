<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function index(User $user)
    {
        return $user->unreadNotifications;
    }
    public function destroy(User $user, $notificationId)
    {
        $user->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
