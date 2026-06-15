<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLaporanController extends Controller
{
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
}