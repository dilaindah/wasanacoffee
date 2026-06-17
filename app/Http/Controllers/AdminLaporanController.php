<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLaporanController extends Controller
{
    /**
     * HARI 8: Halaman Menu Laporan Keuangan
     */
    public function index()
    {
        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        // 1. Hitung total omset bulan ini (Hanya pesanan yang berstatus 'selesai')
        $omset_bulan_ini = DB::table('pesanan')
            ->where('status_pesanan', 'selesai')
            ->whereMonth('created_at', $bulan_ini)
            ->whereYear('created_at', $tahun_ini)
            ->sum('total_harga');

        // 2. Hitung total pesanan sukses bulan ini
        $pesanan_selesai_bulan_ini = DB::table('pesanan')
            ->where('status_pesanan', 'selesai')
            ->whereMonth('created_at', $bulan_ini)
            ->whereYear('created_at', $tahun_ini)
            ->count();

        // 3. Rekapitulasi bulanan untuk tabel bawah (GROUP BY Bulan & Tahun)
        $rekap_bulanan = DB::table('pesanan')
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('COUNT(id_pesanan) as jumlah_order'),
                DB::raw('SUM(total_harga) as total_pendapatan')
            )
            ->where('status_pesanan', 'selesai')
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'desc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'desc')
            ->get();

        return view('admin.laporan.index', compact('omset_bulan_ini', 'pesanan_selesai_bulan_ini', 'rekap_bulanan'));
    }

    /**
     * HARI 8: Fungsi Cetak PDF Laporan Bulanan
     */
    public function cetakPdf($bulan, $tahun)
    {
        // Ambil semua item pesanan yang selesai pada bulan dan tahun terpilih untuk detail PDF
        $data_pesanan = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select('pesanan.*', 'pelanggan.nama as nama_pembeli')
            ->where('pesanan.status_pesanan', 'selesai')
            ->whereMonth('pesanan.created_at', $bulan)
            ->whereYear('pesanan.created_at', $tahun)
            ->orderBy('pesanan.created_at', 'asc')
            ->get();

        $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 10));
        $total_omset = $data_pesanan->sum('total_harga');

        // Load view khusus PDF dan lempar datanya
        $pdf = Pdf::loadView('admin.laporan.pdf_template', compact('data_pesanan', 'nama_bulan', 'tahun', 'total_omset'));
        
        // Download otomatis file PDF-nya
        return $pdf->download("Laporan_Keuangan_Wasana_Coffee_{$nama_bulan}_{$tahun}.pdf");
    }

    /**
     * 🚀 BARU - HARI 9: Dashboard Overview Admin & Integrasi Grafik Chart.js
     */
    public function dashboardOverview()
    {
        // 1. Hitung Total Varian Produk
        $total_produk = DB::table('produk')->count();

        // 2. Hitung Total Semua Pesanan
        $total_pesanan = DB::table('pesanan')->count();

        // 3. Hitung Pesanan Hari Ini saja
        $pesanan_hari_ini = DB::table('pesanan')
            ->whereDate('created_at', date('Y-m-d'))
            ->count();

        // 4. Hitung Total Pendapatan (Hanya dari pesanan yang berstatus 'selesai')
        $total_pendapatan = DB::table('pesanan')
            ->where('status_pesanan', 'selesai')
            ->sum('total_harga');

        // 5. Ambil data transaksi 7 hari terakhir untuk grafik Chart.js
        $grafik_raw = DB::table('pesanan')
            ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('COUNT(id_pesanan) as jumlah_order'))
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal', 'asc')
            ->get();

        // Rapikan struktur data grafik agar tanggal yang kosong di database tetap memunculkan angka 0
        $data_grafik = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $formatted_date = date('d M', strtotime($date));
            
            // Cari data transaksi yang cocok dengan tanggal loop ini
            $match = $grafik_raw->firstWhere('tanggal', $date);
            
            $data_grafik['labels'][] = $formatted_date;
            $data_grafik['data'][] = $match ? $match->jumlah_order : 0;
        }

        // Lempar semua variabel ke view dashboard admin
        return view('admin.dashboard', compact(
            'total_produk', 
            'total_pesanan', 
            'pesanan_hari_ini', 
            'total_pendapatan',
            'data_grafik'
        ));
    }
}