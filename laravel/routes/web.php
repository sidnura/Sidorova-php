<?php

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Comments\CommentController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::prefix('posts')->group(function () {

        Route::get('/', [PostController::class, 'index'])->name('posts.index');

        Route::middleware(['can:posts.create'])->group(function () {
            Route::get('/create', [PostController::class, 'create'])->name('posts.create');
            Route::post('/', [PostController::class, 'store'])->name('posts.store');
        });

        Route::post('/{post}/comments', [CommentController::class, 'store'])
        ->middleware('auth')
        ->name('posts.comments.store');

        Route::middleware(['auth'])->group(function () {
            Route::get('/{post}/edit', [PostController::class, 'edit'])
                ->where('post', '[0-9]+')
                ->name('posts.edit');
            Route::put('/{post}', [PostController::class, 'update'])
                ->where('post', '[0-9]+')
                ->name('posts.update');
        });

        Route::get('/{post}', [PostController::class, 'show'])
            ->where('post', '[0-9]+')
            ->name('posts.show');

        Route::middleware(['can:posts.delete'])->delete('/{post}', [PostController::class, 'destroy'])
            ->where('post', '[0-9]+')
            ->name('posts.destroy');
    });

    Route::middleware(['can:manage.all'])->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');
});

Route::redirect('/', '/posts');