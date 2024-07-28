<?php

use App\Http\Controllers\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'user',
        'as' => 'user.',
        'middleware' => ['auth', 'hasRole:user'],
    ],
    function () {
        // auth routes profile
        Route::group([
            'prefix' => 'profile',
            'as' => 'profile.',
        ], function () {
            Route::get('/', [UserController::class, 'profile'])->name('index');
            Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
            Route::post('update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');
            Route::post('update-background', [UserController::class, 'saveBackgroundProfile'])->name('update-background');
            Route::post('update-password', [UserController::class, 'updatePassword'])->name('update-password');
        });
    }
);