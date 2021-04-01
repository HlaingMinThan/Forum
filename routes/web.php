<?php

use App\Http\Controllers\BestReplyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LockThreadController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ThreadSubscriptionController;
use App\Http\Controllers\UserAvatorController;
use App\Http\Controllers\UserNotificationsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Thread
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/threads/store', [ThreadController::class, 'store'])->name('threads.store')->middleware('email-must-verified');
Route::get('/threads/{channel}/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::delete('/threads/{channel}/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
Route::get('/threads/{channel}', [ThreadController::class, 'index'])->name('channel.index');

// Lock Thread
Route::post('/threads/{channel}/{thread}/lock', [LockThreadController::class, 'store'])->name('lock_threads.store');
Route::delete('/threads/{channel}/{thread}/lock', [LockThreadController::class, 'destroy'])->name('lock_threads.destroy');

// Reply
Route::get('/threads/{channel}/{thread}/replies', [RepliesController::class, 'index'])->name('replies.index');
Route::post('/threads/{channel}/{thread}/replies', [RepliesController::class, 'store'])->name('replies.store');
Route::delete('/replies/{reply}', [RepliesController::class, 'destroy'])->name('replies.destroy');
Route::patch('/replies/{reply}', [RepliesController::class, 'update'])->name('replies.update');

// Best reply
Route::post('/replies/{reply}/best', [BestReplyController::class, 'store'])->name('best_replies.store');

//Favorite
Route::post('/replies/{reply}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/replies/{reply}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

//Profile
Route::get('/profiles/{user}', [ProfilesController::class, 'show'])->name('profiles.show');
Route::post('/profiles/{user}/avator', [UserAvatorController::class, 'update'])->name('avator.update');

//notifications
Route::get('/profiles/{user}/notifications', [UserNotificationsController::class, 'index'])->name('userNotifications.index');
Route::delete('/profiles/{user}/notifications/{notification}', [UserNotificationsController::class, 'destroy'])->name('userNotifications.destroy');

// ThreadSubscription
Route::post('/threads/{channel:slug}/{thread}/subscriptions', [ThreadSubscriptionController::class, 'store'])->name('threadSubscription.store');
Route::delete('/threads/{channel:slug}/{thread}/subscriptions', [ThreadSubscriptionController::class, 'destroy'])->name('threadSubscription.destroy');

require __DIR__ . '/auth.php';
