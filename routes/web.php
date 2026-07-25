<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Redirect root to dashboard (which will redirect to login if guest)
Route::get('/', function () {
    return redirect('/dashboard');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Protected Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
    
    // CRUD Routes
    Route::resource('kamar', \App\Http\Controllers\KamarController::class);
    Route::resource('penyewa', \App\Http\Controllers\PenyewaController::class);
    Route::resource('pembayaran', \App\Http\Controllers\PembayaranController::class);
    Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index']);
    Route::get('/profil', [\App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
});
