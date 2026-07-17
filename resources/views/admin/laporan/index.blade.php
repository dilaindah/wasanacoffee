@extends('layouts.admin')

@section('title', 'Laporan Penjualan - Wasana Coffee')

@section('content')
<div class="max-w-6xl mx-auto px-2 sm:px-4">
    <!-- Header: Menyesuaikan ukuran teks di HP agar tidak patah berantakan -->
    <div class="mb-6">
        <h2 class="text-2xl sm:text-3xl font-black text-amber-950 tracking-tight">Laporan Keuangan & Penjualan</h2>
        <p class="text-gray-500 text-xs sm:text-sm">Rekapitulasi omset berkala data Wasana Coffee.</p>
    </div>

    <!-- Statistik Utama: Otomatis 1 kolom di HP, 2 kolom di tablet/desktop -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Card Omset -->
        <div class="bg-white p-5 sm:p-6 rounded-[24px] shadow-sm border border-amber-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">Omset Selesai Bulan Ini</p>
                <h3 class="text-xl sm:text-2xl font-black text-amber-800 mt-1">Rp {{ number_format($omset_bulan_ini, 0, ',', '.') }}</h3>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-lg sm:text-xl text-amber-800 shrink-0">
                💰
            </div>
        </div>

        <!-- Card Jumlah Pesanan -->
        <div class="bg-white p-5 sm:p-6 rounded-[24px] shadow-sm border border-amber-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">Pesanan Sukses Bulan Ini</p>
                <h3 class="text-xl sm:text-2xl font-black text-amber-800 mt-1">{{ $pesanan_selesai_bulan_ini }} Pesanan</h3>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-50 rounded-2xl flex items-center justify-center text-lg sm:text-xl text-green-700 shrink-0">
                ✅
            </div>
        </div>
    </div>

    <!-- Container Arsip Pendapatan -->
    <div class="bg-white rounded-[24px] shadow-sm border border-amber-100 overflow-hidden">
        <div class="p-5 border-b border-amber-50 bg-amber-950/5">
            <h4 class="font-bold text-amber-950 text-sm">Arsip Pendapatan Bulanan</h4>
        </div>

        <!-- 1. TAMPILAN KHUSUS HP (Block Mobile): Berbentuk Card List Ringkas -->
        <div class="block sm:hidden divide-y divide-amber-50 px-4">
            @forelse($rekap_bulanan as $row)
                @php
                    $nama_bulan_rekap = date('F', mktime(0, 0, 0, $row->bulan, 10));
                @endphp
                <div class="py-4 space-y-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-sm font-black text-amber-950 block">📅 {{ $nama_bulan_rekap }} {{ $row->tahun }}</span>
                            <span class="text-xs text-gray-500 font-medium mt-0.5 block">{{ $row->jumlah_order }} Order Berhasil</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400 block uppercase font-bold tracking-tight">Total Pendapatan</span>
                            <span class="text-sm font-bold text-emerald-700 block">Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <!-- Tombol Cetak PDF yang Disesuaikan untuk Sentuhan Jari di Layar HP -->
                    <div class="pt-1">
                        <a href="{{ route('admin.laporan.pdf', ['bulan' => $row->bulan, 'tahun' => $row->tahun]) }}" 
                           class="w-full inline-flex items-center justify-center gap-1.5 bg-red-800 hover:bg-red-900 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition active:scale-[0.98]">
                            <span>📥</span> Cetak PDF Laporan
                        </a>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-gray-400 text-xs italic">
                    Belum ada data transaksi yang berstatus "Selesai".
                </div>
            @endforelse
        </div>

        <!-- 2. TAMPILAN KHUSUS DESKTOP (Hidden on Mobile): Menggunakan Tabel Tradisional -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-amber-800 text-white text-sm font-semibold uppercase tracking-wider border-b border-amber-800">
                        <th class="py-4 px-6">Bulan & Tahun</th>
                        <th class="py-4 px-6 text-center">Jumlah Transaksi Berhasil</th>
                        <th class="py-4 px-6">Total Pendapatan</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50 text-sm font-medium text-gray-700">
                    @forelse($rekap_bulanan as $row)
                        @php
                            $nama_bulan_rekap = date('F', mktime(0, 0, 0, $row->bulan, 10));
                        @endphp
                        <tr class="hover:bg-amber-50/40 transition">
                            <td class="py-4 px-6 font-bold text-amber-950">
                                📅 {{ $nama_bulan_rekap }} {{ $row->tahun }}
                            </td>
                            <td class="py-4 px-6 text-center font-semibold text-gray-600">
                                {{ $row->jumlah_order }} Order
                            </td>
                            <td class="py-4 px-6 font-bold text-emerald-700">
                                Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('admin.laporan.pdf', ['bulan' => $row->bulan, 'tahun' => $row->tahun]) }}" 
                                   class="inline-flex items-center gap-1.5 bg-red-800 hover:bg-red-900 text-white text-xs font-bold py-2 px-4 rounded-xl transition shadow-sm active:scale-95">
                                    <span>📥</span> Cetak PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400 text-xs italic">
                                Belum ada data transaksi yang berstatus "Selesai".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection