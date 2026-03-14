<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\riwayatController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\TesController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', [authController::class, 'index'])->name('login');
Route::post('/login', [authController::class, 'Authenticate'])->name('proses-Login');
Route::post('/logout', [authController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/get-setting', [settingController::class, 'get']);
    Route::post('/update-setting', [settingController::class, 'update']);

    Route::resource('/dashboard', dashboardController::class);
    Route::resource('/tes', TesController::class);
    Route::resource('/user', userController::class);
    Route::resource('/riwayat', riwayatController::class);
    Route::get('/export-excel', [TesController::class, 'Excel'])->name('export.excel');
});
