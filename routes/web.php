<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::middleware(['auth'])->group(function () {
    Route::view('/dice', 'games.dice')->name('games.dice');
    Route::view('/coin', 'games.coin')->name('games.coin');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
