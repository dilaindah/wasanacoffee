<?php

namespace App\Http\Controllers; 

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // 1. Halaman Utama (Tabel Produk)
    public function index()
    {
        // Ambil semua data produk dari database menggunakan Model
        $produks = Produk::all(); 
        
        // Kirim data ke file index.blade.php di folder admin/produk
        return view('admin.produk.index', compact('produks'));
    }

    // 2. Halaman Form Tambah Varian
    public function create()
    {
        return view('admin.produk.create');
    }
}