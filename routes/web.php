<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\settingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [authController::class, 'index']);
Route::post('/login', [authController::class, 'Authenticate'])->name('proses-Login');


Route::get('/get-setting', [settingController::class, 'get']);
Route::post('/update-setting', [settingController::class, 'update']);

Route::resource('/dashboard', dashboardController::class);
