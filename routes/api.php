<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Middleware to handle authenticated requests
Route::middleware('auth:sanctum')->group(function () {
    // Route to get authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route to like a post
    Route::post('/posts/{post}/like', [PostController::class, 'likePost'])->name('api.posts.like');

    // Route to add a comment to a post
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('api.posts.comments');
});

// API routes for creating, retrieving, updating, and deleting posts
Route::apiResource('posts', PostController::class)
    ->names([
        'index' => 'api.posts.index',
        'show' => 'api.posts.show',
        'store' => 'api.posts.store',
        'update' => 'api.posts.update',
        'destroy' => 'api.posts.destroy',
    ]);
