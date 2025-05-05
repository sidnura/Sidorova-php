<?php

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Comments\CommentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit')
    ->middleware('auth');

Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('posts.comments.store');