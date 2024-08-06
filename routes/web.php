<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\SharedController;


Route::get('/', [SharedController::class, 'index'])->name('index');
Route::get('/show-data', [SharedController::class, 'showData'])->name('showData');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
