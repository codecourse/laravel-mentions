<?php

use App\Http\Controllers\UserSearchController;
use App\Livewire\CommentIndex;
use App\Livewire\ProfileShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/comments', CommentIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('comments.index');

Route::get('/users/search', UserSearchController::class);

Route::get('/users/{user:username}', ProfileShow::class)
    ->middleware(['auth', 'verified'])
    ->name('profile.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
