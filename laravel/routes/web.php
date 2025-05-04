<?php

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Posts\PostController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);

Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');