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
        // auth routes Data Kriteria
        Route::group([
            'prefix' => 'kriteria',
            'as' => 'kriteria.',
        ], function () {
            Route::get('/', [DataKriteriaController::class, 'index'])->name('index');
            Route::get('create', [DataKriteriaController::class, 'create'])->name('create');
            Route::post('store', [DataKriteriaController::class, 'store'])->name('store');
            Route::get('edit/{id}', [DataKriteriaController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DataKriteriaController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [DataKriteriaController::class, 'destroy'])->name('delete');
        });

        // auth routes Data Subkriteria
        Route::group([
            'prefix' => 'subkriteria',
            'as' => 'subkriteria.',
        ], function () {
            Route::get('/', [DataSubkriteriaController::class, 'index'])->name('index');
            Route::get('detail/{id}', [DataSubkriteriaController::class, 'detail'])->name('detail');
            Route::get('create/{id}', [DataSubkriteriaController::class, 'create'])->name('create');
            Route::post('store', [DataSubkriteriaController::class, 'store'])->name('store');
            Route::get('edit/{id}', [DataSubkriteriaController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DataSubkriteriaController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [DataSubkriteriaController::class, 'destroy'])->name('delete');
        });

        // auth routes Data Alternatif
        Route::group([
            'prefix' => 'alternatif',
            'as' => 'alternatif.',
        ], function () {
            Route::get('/', [DataAlternatifController::class, 'index'])->name('index');
            Route::get('create', [DataAlternatifController::class, 'create'])->name('create');
            Route::post('store', [DataAlternatifController::class, 'store'])->name('store');
            Route::get('edit/{id}', [DataAlternatifController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DataAlternatifController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [DataAlternatifController::class, 'destroy'])->name('delete');
        });

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

