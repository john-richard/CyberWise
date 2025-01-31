<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeaturedThreadController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('reset-password', [AuthController::class, 'resetPassword']);
    
// Get Threads
Route::get('/threads', [ThreadController::class, 'getThreads']);

// Get Featured Threads
Route::get('/featured-threads', [FeaturedThreadController::class, 'getFeaturedThreads']);

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']); // List all users
    Route::post('/users', [UserController::class, 'store']); // Create a new user
    Route::get('/users/{id}', [UserController::class, 'show']); // Get details of a user
    Route::put('/users/{id}', [UserController::class, 'update']); // Update user details
    Route::delete('/users/{id}', [UserController::class, 'delete']); // Delete a user

    Route::post('/featured-thread', [FeaturedThreadController::class, 'createFeaturedThread']); // Create a featured thread
    Route::put('/featured-thread/{id}', [FeaturedThreadController::class, 'updateFeaturedThread']); // Update featured thread
    Route::delete('/featured-thread/{id}', [FeaturedThreadController::class, 'deleteFeaturedThread']); // Deactivate thread

    Route::post('/learning-hub', [FeaturedThreadController::class, 'createLearningHub']); // Create a learning hub
    Route::put('/learning-hub/{id}', [FeaturedThreadController::class, 'updateLearningHub']); // Update learning hub
    Route::delete('/learning-hub/{id}', [FeaturedThreadController::class, 'deleteLearningHub']); // Delete learning hub
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Create a Thread
    Route::post('/thread', [ThreadController::class, 'createThread'])->name('create-thread');

    // Update a Thread
    Route::post('/thread/{id}', [ThreadController::class, 'updateThread'])->name('update-thread');

    // Store a posts (comment to thread)
    Route::post('/thread/{id}/post', [PostController::class, 'store']);

    // Delete a posts (comment to thread) - not yet
    Route::delete('/thread/{id}/post', [PostController::class, 'destroy']);

});