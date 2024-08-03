<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\Features\PengajuanController;
use App\Http\Controllers\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'user',
        'as' => 'user.',
        'middleware' => 'auth',
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

        // auth routes for user make pengajuan
        Route::group([
            'prefix' => 'pengajuan',
            'as' => 'pengajuan.',
            'middleware' => ['auth', 'hasRole:user', 'verified'],
        ], function () {
            Route::get('/', [PengajuanController::class, 'index'])->name('index');
            Route::get('create', [PengajuanController::class, 'create'])->name('create');
            Route::post('store', [PengajuanController::class, 'store'])->name('store');
            Route::get('show/{id}', [PengajuanController::class, 'show'])->name('show');
            Route::delete('delete/{id}', [PengajuanController::class, 'destroy'])->name('delete');
        });

    }
);

// special route for verify email
Route::get('/email/verify', [UserController::class, 'verifyEmail'])->middleware('auth')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [UserController::class, 'verifyEmailToken'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('email/verification-notification', [UserController::class, 'sendEmailVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');