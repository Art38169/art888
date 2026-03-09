<?php

use App\Http\Controllers\CoinGameController;
use App\Http\Controllers\DiceGameController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::middleware(['auth'])->group(function () {
    Route::view('/dice', 'games.dice')->name('games.dice');
    Route::post('/dice/play', [DiceGameController::class, 'play'])->name('games.dice.play');
    Route::view('/coin', 'games.coin')->name('games.coin');
    Route::post('/coin/play', [CoinGameController::class, 'play'])->name('games.coin.play');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
