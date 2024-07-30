<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\SharedController;


Route::get('/', [SharedController::class, 'index'])->name('index');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
