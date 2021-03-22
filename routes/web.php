<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ThreadController;
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
Route::get("/threads",[ThreadController::class,'index'])->name('threads.index');
Route::get("/threads/create",[ThreadController::class,"create"])->name('threads.create');
Route::get("/threads/{channel}",[ThreadController::class,'index'])->name('channel.index');
Route::post("/threads/store",[ThreadController::class,"store"])->name('threads.store');
Route::get("/threads/{channel}/{thread}",[ThreadController::class,'show'])->name('threads.show');
Route::delete("/threads/{channel}/{thread}",[ThreadController::class,'destroy'])->name('threads.destroy');
Route::post("/threads/{channel}/{thread}/replies",[RepliesController::class,"store"])->name('replies.store');
Route::delete("/replies/{reply}",[RepliesController::class,"destroy"])->name('replies.destroy');
Route::patch("/replies/{reply}",[RepliesController::class,"update"])->name('replies.update');
Route::post("/replies/{reply}/favorite",[FavoriteController::class,"store"])->name('favorites.store');
Route::delete("/replies/{reply}/favorite",[FavoriteController::class,"destroy"])->name('favorites.destroy');
Route::get('/profiles/{user}',[ProfilesController::class,'show'])->name("profiles.show");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
