<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/community', [CommunityController::class, 'index'])->name('community');

Route::middleware(['auth:sanctum'])->group(function () {
    // Thread
    Route::get('/thread', [ThreadController::class, 'index'])->name('thread');

    // Thread View
    Route::get('/thread/{id}/{thread_name}', [ThreadController::class, 'showThread'])->name('show-thread');
});

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin get featured thread
    Route::get('/admin/featured-thread', [DashboardController::class, 'getFeaturedThreads'])->name('admin.featured-thread');   

    // Admin get learning hub
    Route::get('/admin/learning-hub', [DashboardController::class, 'getLearningHub'])->name('admin.learning-hub');   

    // Admin get threads
    Route::get('/admin/threads', [DashboardController::class, 'getThreads'])->name('admin.threads');       

    // Admin get users
    Route::get('/admin/users', [DashboardController::class, 'getUsers'])->name('admin.users');     
});