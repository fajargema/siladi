<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FEReportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/tentang', [FrontendController::class, 'about'])->name('about');
Route::get('/hubungi-kami', [FrontendController::class, 'contact'])->name('contact');
Route::post('/kirim', [FrontendController::class, 'kirim'])->name('kirim');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/laporan', [FrontendController::class, 'report'])->name('report');
    Route::get('/laporan/{slug}', [FrontendController::class, 'details'])->name('details');
    Route::get('/kategori/{id}', [FrontendController::class, 'category'])->name('category');

    Route::post('/simpan-pen', [FEReportController::class, 'simpanPen'])->name('simpanPen');
    Route::post('/simpan-asp', [FEReportController::class, 'simpanAsp'])->name('simpanAsp');
    Route::post('/simpan-inf', [FEReportController::class, 'simpanInf'])->name('simpanInf');
    Route::get('/edit/{id}', [FEReportController::class, 'edit'])->name('edit-pen');
    Route::put('/update-laporan/{id}', [FEReportController::class, 'update'])->name('update-pen');
    Route::delete('/hapus-laporan/{id}', [FEReportController::class, 'delete'])->name('delete-pen');
    Route::post('/comment', [FEReportController::class, 'comment'])->name('comment');

    Route::get('/search', [FEReportController::class, 'search'])->name('search');

    Route::get('/laporan-saya/{users_id}', [FEReportController::class, 'myReport'])->name('myReport');
});

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('type', TypeController::class)->only('index');
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
