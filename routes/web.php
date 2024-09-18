<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CommentController;

Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');

// Redirect root URL to /login
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route for the index page where users can post, like, and comment
Route::get('/posts', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');

// Route to show the form for creating a new post
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');

// Route to handle the form submission and store the post
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');

// Route to show the form for editing a specific post
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->middleware('auth')->name('posts.edit');

// Route to handle updating a specific post
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('auth')->name('posts.update');

// Route to handle deleting a specific post
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');

// Route to handle liking a post
Route::post('/posts/{id}/like', [PostController::class, 'likePost'])->middleware(['auth'])->name('posts.like');

// Route to add a comment to a post
Route::post('/posts/{id}/comments', [PostController::class, 'addComment'])->middleware(['auth'])->name('posts.comment');

// Route for editing a comment
Route::get('/comments/{id}/edit', [PostController::class, 'editComment'])->middleware('auth')->name('comments.edit');

// Route for updating a comment
Route::put('/comments/{id}', [PostController::class, 'updateComment'])->middleware('auth')->name('comments.update');

// Route for deleting a comment
Route::delete('/comments/{id}', [PostController::class, 'deleteComment'])->middleware('auth')->name('comments.delete');

// Routes for profile management
Route::middleware('auth')->group(function () {
    // Display the profile edit form
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update the user's profile information (supports both PUT and PATCH methods)
    Route::match(['put', 'patch'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Route to add a comment to a post
Route::post('/posts/{id}/comments', [PostController::class, 'addComment'])->middleware(['auth'])->name('posts.comment');
Route::post('/profile/update-background-photo', [PostController::class, 'updateBackgroundPhoto'])->name('profile.updateBackgroundPhoto');

    // Delete the user's account
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
