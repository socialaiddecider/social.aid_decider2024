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

    Route::get('signout', [AuthController::class, 'signOut'])->name('signOut')->withoutMiddleware('guest')->middleware('auth');
});
