@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Wasana Coffee')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Header: Ukuran margin dan text menyesuaikan resolusi HP -->
    <div class="mb-6 md:mb-8 pb-4 border-b border-amber-200/60">
        <h2 class="text-xl md:text-2xl font-bold text-amber-900">Kelola Pesanan Masuk</h2>
        <p class="text-xs md:text-sm text-gray-500 mt-0.5">Monitor dan perbarui status pemesanan kopi Wasana dari pelanggan.</p>
    </div>

    <!-- ================= TAMPILAN LAPTOP / TABLET (hidden di hp dengan md:block) ================= -->
    <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden mb-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-amber-800 text-white text-sm font-semibold uppercase tracking-wider border-b border-amber-800">
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
                                @elseif($p->status_pesanan == 'dibatalkan') bg-red-50 text-red-700 border border-red-200/50
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

    <!-- ================= TAMPILAN KHUSUS HP (md:hidden - Berubah Menjadi List Kartu) ================= -->
    <div class="block md:hidden space-y-3 mb-4">
        @forelse($daftar_pesanan as $p)
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-amber-100 flex flex-col gap-3">
                <!-- Baris Atas: Kode Pesanan dan Status Badge -->
                <div class="flex justify-between items-start border-b border-amber-50 pb-2.5">
                    <div>
                        <span class="text-2xs uppercase font-semibold text-gray-400 block">KODE PESANAN</span>
                        <span class="font-mono font-bold text-sm text-amber-950 tracking-wide">{{ $p->kode_pesanan }}</span>
                    </div>
                    <div>
                        <span class="px-2.5 py-0.5 rounded-full text-2xs font-bold uppercase tracking-tight block
                            @if($p->status_pesanan == 'menunggu') bg-amber-50 text-amber-800 border border-amber-200/50
                            @elseif($p->status_pesanan == 'diproses') bg-blue-50 text-blue-700 border border-blue-200/50
                            @elseif($p->status_pesanan == 'dikirim') bg-purple-50 text-purple-700 border border-purple-200/50
                            @elseif($p->status_pesanan == 'dibatalkan') bg-red-50 text-red-700 border border-red-200/50
                            @else bg-emerald-50 text-emerald-700 border border-emerald-200/50 @endif">
                            {{ $p->status_pesanan }}
                        </span>
                    </div>
                </div>

                <!-- Baris Tengah: Detail Pembeli, Waktu Transaksi & Nominal -->
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <span class="text-gray-400 font-medium block">Pelanggan:</span>
                        <span class="font-semibold text-gray-700 block truncate">{{ $p->nama_pembeli }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-gray-400 font-medium block">Total Pembayaran:</span>
                        <span class="font-bold text-amber-900 block">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="col-span-2 mt-1 pt-1.5 border-t border-dashed border-amber-100/60 text-2xs text-gray-400 font-medium">
                        📅 {{ date('d M Y, H:i', strtotime($p->created_at)) }} WIB
                    </div>
                </div>

                <!-- Baris Bawah: Tombol Aksi penuh untuk jempol HP -->
                <div class="pt-1">
                    <a href="{{ route('admin.pesanan.detail', $p->id_pesanan) }}" 
                       class="w-full flex justify-center items-center bg-amber-800 hover:bg-amber-900 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition shadow-sm gap-1">
                        🔍 Lihat Detail Pesanan
                    </a>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-400 bg-white rounded-2xl shadow-sm border border-amber-100 italic text-sm">
                Belum ada data transaksi pesanan kopi yang masuk ke dalam sistem.
            </div>
        @endforelse
    </div>

    <!-- ================= PAGINATION: Terintegrasi rapi dengan card/tabel di atasnya ================= -->
    @if($daftar_pesanan->hasPages())
        <div class="bg-white p-4 rounded-2xl border border-amber-100 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-semibold text-amber-950">
            <div class="text-center sm:text-left text-gray-500">
                Menampilkan <span class="font-bold text-amber-900">{{ $daftar_pesanan->firstItem() }}</span> 
                - <span class="font-bold text-amber-900">{{ $daftar_pesanan->lastItem() }}</span> 
                dari <span class="font-bold text-amber-900">{{ $daftar_pesanan->total() }}</span> pesanan.
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto justify-center">
                {{-- Tombol Previous --}}
                @if ($daftar_pesanan->onFirstPage())
                    <span class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-gray-50 text-gray-400 rounded-xl cursor-not-allowed border border-gray-200/60">
                        ◀ Prev
                    </span>
                @else
                    <a href="{{ $daftar_pesanan->previousPageUrl() }}" class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-white hover:bg-amber-800 hover:text-white text-amber-900 rounded-xl border border-amber-200 transition shadow-sm">
                        ◀ Prev
                    </a>
                @endif

                {{-- Tombol Next --}}
                @if ($daftar_pesanan->hasMorePages())
                    <a href="{{ $daftar_pesanan->nextPageUrl() }}" class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-white hover:bg-amber-800 hover:text-white text-amber-900 rounded-xl border border-amber-200 transition shadow-sm">
                        Next ▶
                    </a>
                @else
                    <span class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-gray-50 text-gray-400 rounded-xl cursor-not-allowed border border-gray-200/60">
                        Next ▶
                    </span>
                @endif
            </div>
        </div>
    @endif
@endsection