<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Bobot\DataAsliController;
use App\Http\Controllers\Admin\Data\AlternatifController as DataAlternatifController;
use App\Http\Controllers\Admin\Data\KriteriaController as DataKriteriaController;
use App\Http\Controllers\Admin\Data\SubkriteriaController as DataSubkriteriaController;
use App\Http\Controllers\Admin\Features\NewsController;
use App\Http\Controllers\Admin\Management\PenerimaController;
use App\Http\Controllers\Admin\Management\PenilaianController;
use App\Http\Controllers\Admin\Management\PerhitunganController;
use App\Http\Controllers\Admin\Bobot\KriteriaController as BobotKriteriaController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// admin routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    // auth routes dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // auth routes news
    Route::get('news', [NewsController::class, 'index'])->name('news');

    // auth routes Data
    Route::group([
        'prefix' => 'data',
        'as' => 'data.',
    ], function () {
        Route::get('kriteria', [DataKriteriaController::class, 'index'])->name('kriteria');
        Route::get('subkriteria', [DataSubkriteriaController::class, 'index'])->name('subkriteria');
        Route::get('alternatif', [DataAlternatifController::class, 'index'])->name('alternatif');
    });

    // auth routes Management
    Route::group([
        'prefix' => 'management',
        'as' => 'management.',
    ], function () {
        Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian');
        Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
        Route::get('penerima', [PenerimaController::class, 'index'])->name('penerima');
    });

    // auth routes Bobot
    Route::group([
        'prefix' => 'bobot',
        'as' => 'bobot.',
    ], function () {
        Route::get('data-asli', [DataAsliController::class, 'index'])->name('data-asli');
        Route::get('kriteria', [BobotKriteriaController::class, 'index'])->name('kriteria');
    });

    // auth routes logout

});

