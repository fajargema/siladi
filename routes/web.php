<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/tentang', [FrontendController::class, 'about'])->name('about');
Route::get('/hubungi-kami', [FrontendController::class, 'contact'])->name('contact');
Route::post('/kirim', [FrontendController::class, 'kirim'])->name('kirim');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/laporan', [FrontendController::class, 'report'])->name('report');
    Route::get('/laporan/{slug}', [FrontendController::class, 'details'])->name('details');
    Route::post('/simpan-pen', [FrontendController::class, 'simpanPen'])->name('simpanPen');
    Route::post('/simpan-asp', [FrontendController::class, 'simpanAsp'])->name('simpanAsp');
    Route::post('/simpan-inf', [FrontendController::class, 'simpanInf'])->name('simpanInf');
    Route::post('/comment', [FrontendController::class, 'comment'])->name('comment');

    Route::get('/search', [FrontendController::class, 'search'])->name('search');

    Route::get('/laporan-saya/{users_id}', [FrontendController::class, 'myReport'])->name('myReport');
});

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('type', TypeController::class);
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
