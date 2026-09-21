<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);

    Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore')->withTrashed();
    Route::delete('posts/{post}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force-delete')->withTrashed();
    
    Route::resource('posts', PostController::class);

     Route::resource('tags', TagController::class);
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::post('users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
});
require __DIR__.'/auth.php';