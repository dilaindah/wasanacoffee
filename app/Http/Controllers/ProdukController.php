<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // 1. Halaman Utama (Tabel Produk)
    public function index()
    {
        $produks = Produk::all(); 
        return view('admin.produk.index', compact('produks'));
    }

    // 2. Halaman Form Tambah Varian
    public function create()
    {
        return view('admin.produk.create');
    }

    // 3. Fungsi Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_varian' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
        ]);

        Produk::create([
            'nama_varian' => $request->nama_varian,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Varian kopi baru berhasil ditambahkan!');
    }

    // 4. Halaman Form Edit Varian (BARU)
    public function edit($id)
    {
        // Mencari data produk berdasarkan id_produk asli adek
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    // 5. Fungsi Proses Update Data ke Database (BARU)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_varian' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama_varian' => $request->nama_varian,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Varian kopi berhasil diperbarui!');
    }

    // 6. Fungsi Hapus Data / Delete (BARU)
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Varian kopi berhasil dihapus!');
    }
}