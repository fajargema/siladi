<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('category', CategoryController::class);
        Route::resource('aspiration', AspirationController::class);
        Route::post('/proses-asp/{id}', [AspirationController::class, 'setProses'])->name('proses-asp');
        Route::post('/selesai-asp/{id}', [AspirationController::class, 'setSelesai'])->name('selesai-asp');

        Route::resource('complaint', ComplaintController::class);
        Route::post('/proses-pen/{id}', [ComplaintController::class, 'setProses'])->name('proses-pen');
        Route::post('/selesai-pen/{id}', [ComplaintController::class, 'setSelesai'])->name('selesai-pen');

        Route::resource('information', InformationRequestController::class);
        Route::post('/proses-inf/{id}', [InformationRequestController::class, 'setProses'])->name('proses-inf');
        Route::post('/selesai-inf/{id}', [InformationRequestController::class, 'setSelesai'])->name('selesai-inf');
    });
});
