<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPesananController extends Controller
{
    // 1. Menampilkan Semua Daftar Pesanan Masuk (DENGAN REVISI PAGINATION)
    public function index()
    {
        // Ambil data pesanan digabung (JOIN) dengan tabel pelanggan untuk dapat nama pembeli
        // REVISI: Mengubah ->get() menjadi ->paginate(10) agar sinkron dengan template view bawahnya
        $daftar_pesanan = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select('pesanan.*', 'pelanggan.nama as nama_pembeli')
            ->orderBy('pesanan.created_at', 'desc')
            ->paginate(10); 

        return view('admin.pesanan.index', compact('daftar_pesanan'));
    }

    // 2. Menampilkan Halaman Detail Transaksi & Data Pelanggan
    public function detail($id)
    {
        // Ambil data induk pesanan beserta data pelanggannya
        $pesanan = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select('pesanan.*', 'pelanggan.nama', 'pelanggan.no_hp', 'pelanggan.alamat')
            ->where('pesanan.id_pesanan', $id)
            ->first();

        if (!$pesanan) {
            abort(404, 'Pesanan tidak ditemukan.');
        }

        // Ambil rincian item kopi yang dibeli
        $detail_items = DB::table('detail_pesanan')
            ->where('id_pesanan', $id)
            ->get();

        return view('admin.pesanan.detail', compact('pesanan', 'detail_items'));
    }

    // 3. Update Status Pesanan + 🔥 LOGIKA POTONG STOK OTOMATIS
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            // REVISI: Sudah ditambahkan 'dibatalkan' di paling ujung validasi
            'status_pesanan' => 'required|in:menunggu,diproses,dikirim,selesai,dibatalkan'
        ]);

        $status_baru = $request->status_pesanan;

        // Ambil status pesanan saat ini sebelum diupdate
        $pesanan_lama = DB::table('pesanan')->where('id_pesanan', $id)->first();

        if (!$pesanan_lama) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        // 🔥 LOGIKA OTOMATIS JURUS STOK HARI 7 (POTONG STOK):
        // Jika status diubah ke 'diproses' DAN sebelumnya berstatus 'menunggu'
        if ($status_baru === 'diproses' && $pesanan_lama->status_pesanan === 'menunggu') {
            
            // Ambil rincian barang yang dibeli di pesanan ini
            $items = DB::table('detail_pesanan')->where('id_pesanan', $id)->get();

            foreach ($items as $item) {
                // Ambil info stok produk saat ini di database
                $produk = DB::table('produk')->where('id_produk', $item->id_produk)->first();

                if ($produk) {
                    // Proteksi jika stok ternyata kurang dari qty yang dibeli
                    if ($produk->stok < $item->qty) {
                        return redirect()->back()->with('error', "Gagal proses! Stok untuk produk varian ID {$item->id_produk} tidak mencukupi.");
                    }

                    // Kurangi stok di tabel produk
                    DB::table('produk')
                        ->where('id_produk', $item->id_produk)
                        ->decrement('stok', $item->qty);
                }
            }
        }

        // 🔥 LOGIKA BARU (PENGEMBALIAN STOK JIKA DIBATALKAN):
        // Jika status baru diubah ke 'dibatalkan' DAN status sebelumnya BUKAN 'menunggu' 
        // (artinya status sebelumnya sudah sempat memotong stok)
        if ($status_baru === 'dibatalkan' && $pesanan_lama->status_pesanan !== 'menunggu' && $pesanan_lama->status_pesanan !== 'dibatalkan') {
            
            // Ambil rincian produk yang dibeli
            $items = DB::table('detail_pesanan')->where('id_pesanan', $id)->get();

            foreach ($items as $item) {
                // Kembalikan stok produk (tambahkan kembali senilai qty yang dibatalkan)
                DB::table('produk')
                    ->where('id_produk', $item->id_produk)
                    ->increment('stok', $item->qty);
            }
        }

        // Update status pesanan di tabel pesanan
        DB::table('pesanan')
            ->where('id_pesanan', $id)
            ->update([
                // Pastikan nama kolom database disesuaikan, di sini tertulis 'status_pesanan'
                'status_pesanan' => $status_baru,
                'updated_at' => now()
            ]);

        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}