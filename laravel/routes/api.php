<?php
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Comments\CommentController;

Route::prefix('api')->middleware('auth:api')->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('users', UserController::class)->middleware('can:manage.all');
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
});