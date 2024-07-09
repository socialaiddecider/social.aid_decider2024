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
    Route::group(
        [
            'prefix' => 'news',
            'as' => 'news.',
        ],
        function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('create', [NewsController::class, 'create'])->name('create');
            Route::post('store', [NewsController::class, 'store'])->name('store');
            Route::get('edit/{id}', [NewsController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [NewsController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [NewsController::class, 'destroy'])->name('delete');
        }
    );

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

        // auth routes Penilaian
        Route::group([
            'prefix' => 'penilaian',
            'as' => 'penilaian.',
        ], function () {
            Route::get('/', [PenilaianController::class, 'index'])->name('index');
            Route::get('create', [PenilaianController::class, 'create'])->name('create');
            Route::post('store', [PenilaianController::class, 'store'])->name('store');
            Route::get('edit/{date}/{id}', [PenilaianController::class, 'edit'])->name('edit');
            Route::put('update', [PenilaianController::class, 'update'])->name('update');
            Route::delete('delete/{date}/{id}', [PenilaianController::class, 'destroy'])->name('delete');
        });

        Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
        Route::get('penerima', [PenerimaController::class, 'index'])->name('penerima');
    });

    // auth routes Bobot
    Route::group([
        'prefix' => 'bobot',
        'as' => 'bobot.',
    ], function () {

        // auth routes Data Asli
        Route::group([
            'prefix' => 'data-asli',
            'as' => 'data-asli.',
        ], function () {
            Route::get('/', [DataAsliController::class, 'index'])->name('index');
            Route::get('create', [DataAsliController::class, 'create'])->name('create');
            Route::post('store', [DataAsliController::class, 'store'])->name('store');
            Route::get('edit/{id}', [DataAsliController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DataAsliController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [DataAsliController::class, 'destroy'])->name('delete');
        });

        // auth routes Bobot Kriteria
        Route::group(
            [
                'prefix' => 'kriteria',
                'as' => 'kriteria.',
            ],
            function () {
                Route::get('/', [BobotKriteriaController::class, 'index'])->name('index');
                Route::post('calc', [BobotKriteriaController::class, 'calc'])->name('calc');
                Route::post('save', [BobotKriteriaController::class, 'save'])->name('save');
            }
        );

    });

    // auth routes logout

});

