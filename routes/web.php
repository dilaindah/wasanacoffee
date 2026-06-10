<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LandingController; 
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

// --- 🚀 BARU: RUTE ALUR PEMESANAN KOPI (HARI 5) ---
// 1. Halaman pilih varian ukuran & input Qty
Route::get('/pesan-kopi', [LandingController::class, 'pilihVarian'])->middleware(['auth'])->name('pembeli.varian');

// 2. Logika memproses data pesanan masuk ke database
Route::post('/proses-pesanan', [LandingController::class, 'simpanPesanan'])->middleware(['auth'])->name('pembeli.proses_pesanan');

// 3. Halaman konfirmasi sukses setelah beli
Route::get('/pesanan-sukses/{kode}', [LandingController::class, 'pesananSukses'])->middleware(['auth'])->name('pembeli.sukses');


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
    
    // Menu hiasan sementara biar sidebar gak eror pas diklik
    Route::get('/pesanan', function() { return view('admin.dashboard'); })->name('admin.pesanan.index');
    Route::get('/laporan', function() { return view('admin.dashboard'); })->name('admin.laporan.index');
});