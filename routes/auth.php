<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => 'guest',
], function () {
    Route::get('signin', [AuthController::class, 'index'])->name('signIn');
    Route::post('signin', [AuthController::class, 'signIn'])->name('postSignIn');

    Route::get('signup', [AuthController::class, 'signUp'])->name('signUp');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('changePassword');

    Route::get('signout', [AuthController::class, 'signOut'])->name('signOut')->withoutMiddleware('guest')->middleware('auth');
});

// special route for reset password
Route::get('auth/reset-password/{token}', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('auth/reset-password', [AuthController::class, 'doResetPassword'])->middleware('guest')->name('password.update');