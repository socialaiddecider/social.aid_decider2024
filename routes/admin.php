<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// admin routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});
