<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('settings', [SettingsController::class, 'show'])->name('profile.edit');
    Route::put('settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
});
