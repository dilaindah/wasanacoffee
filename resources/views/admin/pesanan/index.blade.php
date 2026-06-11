@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Wasana Coffee')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-4 border-b border-amber-200/60 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-amber-900">Kelola Pesanan Masuk</h2>
            <p class="text-sm text-gray-500">Monitor dan perbarui status pemesanan kopi Wasana dari pelanggan.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-amber-900/5 text-amber-900 text-sm font-semibold uppercase tracking-wider border-b border-amber-100">
                        <th class="p-4 pl-6">Tanggal Masuk</th>
                        <th class="p-4">Kode Pesanan</th>
                        <th class="p-4">Nama Pelanggan</th>
                        <th class="p-4">Total Harga</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-amber-50">
                    @forelse($daftar_pesanan as $p)
                        <tr class="hover:bg-amber-50/30 transition">
                            <td class="p-4 pl-6 font-medium text-gray-500 text-xs">
                                {{ date('d M Y, H:i', strtotime($p->created_at)) }} WIB
                            </td>
                            <td class="p-4 font-mono font-bold text-amber-950 tracking-wide">
                                {{ $p->kode_pesanan }}
                            </td>
                            <td class="p-4 font-semibold text-gray-700">
                                {{ $p->nama_pembeli }}
                            </td>
                            <td class="p-4 font-bold text-amber-900">
                                Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight
                                    @if($p->status_pesanan == 'menunggu') bg-amber-50 text-amber-800 border border-amber-200/50
                                    @elseif($p->status_pesanan == 'diproses') bg-blue-50 text-blue-700 border border-blue-200/50
                                    @elseif($p->status_pesanan == 'dikirim') bg-purple-50 text-purple-700 border border-purple-200/50
                                    @else bg-emerald-50 text-emerald-700 border border-emerald-200/50 @endif">
                                    {{ $p->status_pesanan }}
                                </span>
                            </td>
                            <td class="p-4 text-center pr-6">
                                <a href="{{ route('admin.pesanan.detail', $p->id_pesanan) }}" 
                                   class="inline-block bg-amber-800 hover:bg-amber-900 text-white text-xs font-bold py-1.5 px-3 rounded-lg transition shadow-sm">
                                    🔍 Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400 italic">
                                Belum ada data transaksi pesanan kopi yang masuk ke dalam sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($daftar_pesanan->hasPages())
            <div class="p-4 bg-amber-50/40 border-t border-amber-100 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs font-semibold text-amber-950">
                <div>
                    Menampilkan data <span class="font-bold text-amber-900">{{ $daftar_pesanan->firstItem() }}</span> 
                    sampai <span class="font-bold text-amber-900">{{ $daftar_pesanan->lastItem() }}</span> 
                    dari total <span class="font-bold text-amber-900">{{ $daftar_pesanan->total() }}</span> pesanan.
                </div>

                <div class="flex items-center gap-1.5">
                    {{-- Tombol Previous --}}
                    @if ($daftar_pesanan->onFirstPage())
                        <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed border border-gray-200/60">
                            ◀ Previous
                        </span>
                    @else
                        <a href="{{ $daftar_pesanan->previousPageUrl() }}" class="px-3 py-2 bg-white hover:bg-amber-800 hover:text-white text-amber-900 rounded-xl border border-amber-200 transition shadow-sm">
                            ◀ Previous
                        </a>
                    @endif

                    {{-- Tombol Next --}}
                    @if ($daftar_pesanan->hasMorePages())
                        <a href="{{ $daftar_pesanan->nextPageUrl() }}" class="px-3 py-2 bg-white hover:bg-amber-800 hover:text-white text-amber-900 rounded-xl border border-amber-200 transition shadow-sm">
                            Next ▶
                        </a>
                    @else
                        <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed border border-gray-200/60">
                            Next ▶
                        </span>
                    @endif
                </div>
            </div>
        @endif

    </div>
@endsection