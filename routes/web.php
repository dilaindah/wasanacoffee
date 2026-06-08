<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

// ========================================================
// 1. ROUTE BAWAAN BREEZE (UNTUK PELANGGAN / USER BIASA)
// ========================================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ========================================================
// 2. ROUTE KHUSUS ADMIN (YANG SUDAH DIRAPIKAN)
// ========================================================

// --- ALAMAT LOGIN ADMIN (Di luar pengaman middleware) ---
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// --- ALAMAT DASHBOARD & CRUD ADMIN (Di dalam pengaman middleware) ---
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    
    // Halaman Utama / Dashboard Overview Admin
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Fitur Kelola Produk Admin (CRUD) - Pakai Cara Manual yang Jelas & Rapi
    Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/produk/edit/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
    
    // Menu hiasan sementara biar sidebar gak eror pas diklik
    Route::get('/pesanan', function() { return view('admin.dashboard'); })->name('admin.pesanan.index');
    Route::get('/laporan', function() { return view('admin.dashboard'); })->name('admin.laporan.index');
}); 