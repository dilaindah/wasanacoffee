@extends('layouts.admin') {{-- Sesuaikan dengan nama file layout utama adek --}}

@section('title', 'Laporan Penjualan - Wasana Coffee')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-black text-amber-950 tracking-tight">Laporan Keuangan & Penjualan</h2>
        <p class="text-gray-500 text-sm">Rekapitulasi omset berkala data Wasana Coffee.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-black uppercase tracking-wider">Omset Selesai Bulan Ini</p>
                <h3 class="text-2xl font-black text-amber-800 mt-1">Rp {{ number_format($omset_bulan_ini, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-xl text-amber-800">
                💰
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-black uppercase tracking-wider">Pesanan Sukses Bulan Ini</p>
                <h3 class="text-2xl font-black text-amber-800 mt-1">{{ $pesanan_selesai_bulan_ini }} Pesanan</h3>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-xl text-green-700">
                ✅
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[24px] shadow-xl border border-amber-100 overflow-hidden">
        <div class="p-5 border-b border-amber-50 bg-amber-950/5">
            <h4 class="font-bold text-amber-950 text-sm">Arsip Pendapatan Bulanan</h4>
        </div>
        <div class="overflow-x-auto">
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