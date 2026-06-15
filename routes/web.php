<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LandingController; 
use App\Http\Controllers\AdminPesananController; 
use App\Http\Controllers\AdminLaporanController; // 🚀 TAMBAHAN: SINKRONKAN CONTROLLER LAPORAN
use Illuminate\Support\Facades\Route;

// ========================================================
// 1. ROUTE BAWAAN BREEZE & PEMBELI (USER BIASA)
// ========================================================

// Mengarahkan halaman utama lewat LandingController agar datanya dinamis
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Halaman dashboard bawaan Laravel Breeze (Bisa dibiarkan dulu)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- RUTE HALAMAN UTAMA PEMBELI ---
Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

// --- 🚀 ALUR PEMESANAN KOPI (HARI 5) ---
Route::get('/pesan-kopi', [LandingController::class, 'pilihVarian'])->middleware(['auth'])->name('pembeli.varian');
Route::post('/proses-pesanan', [LandingController::class, 'simpanPesanan'])->middleware(['auth'])->name('pembeli.proses_pesanan');
Route::get('/pesanan-sukses/{kode}', [LandingController::class, 'pesananSukses'])->middleware(['auth'])->name('pembeli.sukses');

// --- 🚀 BARU: RUTE RIWAYAT PESANAN PEMBELI (HARI 6) ---
Route::get('/riwayat-pesanan', [LandingController::class, 'riwayatPesanan'])->middleware(['auth'])->name('pembeli.riwayat');

// --- 🚀 BARU: RUTE CEK STATUS TRACKING PESANAN (HARI 6) ---
Route::get('/cek-status', [LandingController::class, 'halamanCekStatus'])->middleware(['auth'])->name('pembeli.cek_status_form');
Route::post('/cek-status', [LandingController::class, 'prosesCekStatus'])->middleware(['auth'])->name('pembeli.cek_status_proses');

// Fitur Profile bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ========================================================
// 2. ROUTE KHUSUS ADMIN (JANGAN DICAMPUR PELANGGAN)
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

    // Fitur Kelola Produk Admin (CRUD)
    Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/produk/edit/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
    
    // --- 🚀 UTAMA HARI 8: RUTE LAPORAN KEMUANGAN & CETAK PDF ---
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/cetak-pdf/{bulan}/{tahun}', [AdminLaporanController::class, 'cetakPdf'])->name('admin.laporan.pdf');

    // --- 🚀 UTAMA HARI 7: RUTE KELOLA PESANAN (ADMIN) ---
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan.index');
    Route::get('/pesanan/{id}', [AdminPesananController::class, 'detail'])->name('admin.pesanan.detail');
    Route::post('/pesanan/{id}/update', [AdminPesananController::class, 'updateStatus'])->name('admin.pesanan.update');
});