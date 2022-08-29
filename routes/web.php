<?php

use App\Http\Controllers\PostTagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

// Route::get('/post', function () {
//     return view('posts.index');
// });

Auth::routes();
Route::resource('posts','PostController');
Route::resource('users','UserController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('posts.comments','PostCommentController')->only(['store']);
Route::resource('user.comments','UserCommentController')->only(['store']);
Route::get('/posts/tag/{id}',[App\Http\Controllers\PostTagController::class, 'index'])->name('posts.tag.index');
