<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class LandingController extends Controller
{
    // Halaman awal / Landing Page Utama Wasana Coffee
    public function index()
    {
        return view('welcome'); // atau view('landing') sesuai nama file adek
    }

    // 1. Menampilkan Halaman Pilih Varian (Sesuai Tabel 'produk' Adek)
    public function pilihVarian()
    {
        // Mengambil data varian 100g (id 1) dan 250g (id 2) dari tabel produk adek
        $produk_100g = DB::table('produk')->where('id_produk', 1)->first();
        $produk_250g = DB::table('produk')->where('id_produk', 2)->first();

        // Data cadangan otomatis jika tabel produk di database adek masih kosong (biar gak eror saat tes)
        if (!$produk_100g) {
            $produk_100g = (object) ['id_produk' => 1, 'nama_varian' => 'Wasana Coffee 100g', 'harga' => 20000, 'stok' => 15];
        }
        if (!$produk_250g) {
            $produk_250g = (object) ['id_produk' => 2, 'nama_varian' => 'Wasana Coffee 250g', 'harga' => 45000, 'stok' => 5];
        }

        return view('pembeli.varian', compact('produk_100g', 'produk_250g'));
    }

    // 2. Memproses Simpan ke 2 Tabel Sekaligus ('pesanan' & 'detail_pesanan' Adek)
    public function simpanPesanan(Request $request)
    {
        // Validasi input qty
        $request->validate([
            'qty_100g' => 'required|integer|min:0',
            'qty_250g' => 'required|integer|min:0',
        ]);

        // Ambil harga asli dari DB adek
        $p_100g = DB::table('produk')->where('id_produk', 1)->first();
        $p_250g = DB::table('produk')->where('id_produk', 2)->first();

        $harga_100g = $p_100g ? $p_100g->harga : 20000;
        $harga_250g = $p_250g ? $p_250g->harga : 45000;

        $qty_100g = $request->qty_100g;
        $qty_250g = $request->qty_250g;

        // Logika proteksi: Pembeli wajib memilih minimal 1 item
        if ($qty_100g == 0 && $qty_250g == 0) {
            return redirect()->back()->with('error', 'Silakan masukkan jumlah kopi yang ingin dibeli terlebih dahulu!');
        }

        // Hitung total harga dan subtotal masing-masing varian
        $subtotal_100g = $qty_100g * $harga_100g;
        $subtotal_250g = $qty_250g * $harga_250g;
        $total_harga = $subtotal_100g + $subtotal_250g;

        // OTOMATIS GENERATE KODE PESANAN UNIK (Contoh: WSN-20260610-A8F1)
        $tanggal = date('Ymd');
        $karakterUnik = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $kode_pesanan = 'WSN-' . $tanggal . '-' . $karakterUnik;

        // Ambil ID Pelanggan yang sedang login (Breeze default memakai Auth::id())
        $id_pelanggan = Auth::id(); 

        // PROSES INPUT TABEL 1: pesanan (Induk)
        // insertGetId digunakan untuk mengambil ID pesanan yang baru saja tercipta untuk dipakai di tabel detail
        $id_pesanan_baru = DB::table('pesanan')->insertGetId([
            'id_pelanggan' => $id_pelanggan,
            'kode_pesanan' => $kode_pesanan,
            'total_harga' => $total_harga,
            'status_pesanan' => 'menunggu', // Sesuai ENUM database adek
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // PROSES INPUT TABEL 2: detail_pesanan (Anak)
        // Jika varian 100g dibeli, masukkan datanya
        if ($qty_100g > 0) {
            DB::table('detail_pesanan')->insert([
                'id_pesanan' => $id_pesanan_baru,
                'id_produk' => 1, // Varian 100g
                'qty' => $qty_100g,
                'harga_saat_ini' => $harga_100g,
                'subtotal' => $subtotal_100g
            ]);
        }

        // Jika varian 250g dibeli, masukkan datanya
        if ($qty_250g > 0) {
            DB::table('detail_pesanan')->insert([
                'id_pesanan' => $id_pesanan_baru,
                'id_produk' => 2, // Varian 250g
                'qty' => $qty_250g,
                'harga_saat_ini' => $harga_250g,
                'subtotal' => $subtotal_250g
            ]);
        }

        return redirect()->route('pembeli.sukses', $kode_pesanan);
    }

    // 3. Halaman Sukses Tampilan Transaksi (Relasi ke tabel pesanan & detail)
    public function pesananSukses($kode)
    {
        // Mengambil data dari tabel pesanan adek
        $pesanan = DB::table('pesanan')->where('kode_pesanan', $kode)->first();
        
        if (!$pesanan) {
            abort(404);
        }

        // Mengambil rincian item belanjaan dari tabel detail_pesanan adek
        $detail = DB::table('detail_pesanan')
                    ->where('id_pesanan', $pesanan->id_pesanan)
                    ->get();

        return view('pembeli.sukses', compact('pesanan', 'detail'));
    }
}