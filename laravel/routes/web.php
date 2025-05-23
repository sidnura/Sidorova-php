<?php

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Comments\CommentController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)
        ->except(['edit', 'update']) // Исключаем edit/update для отдельной обработки
        ->names([
            'index' => 'posts.index',
            'create' => 'posts.create',
            'store' => 'posts.store',
            'show' => 'posts.show',
            'destroy' => 'posts.destroy'
        ]);

    Route::middleware(['can:posts.edit'])->group(function () {
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    });

    Route::post('posts/{post}/comments', [CommentController::class, 'store'])
        ->name('posts.comments.store');

    Route::middleware(['can:manage.all'])->resource('users', UserController::class)
        ->except(['show'])
        ->names([
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.destroy'
        ]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');
});

Route::get('/test', function () {
    $data = ['title' => 'test', 'content' => 'test'];
    app()->make(App\Services\Posts\PostService::class)->create($data);
});

Route::redirect('/', '/posts');
