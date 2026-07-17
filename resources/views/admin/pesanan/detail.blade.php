@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $pesanan->kode_pesanan)

@section('content')
    <!-- Tombol Kembali -->
    <div class="mb-5">
        <a href="{{ route('admin.pesanan.index') }}" class="text-amber-900 hover:text-amber-950 text-sm font-semibold flex items-center gap-1">
            ⬅️ Kembali ke Daftar Pesanan
        </a>
    </div>

    @if(session('error'))
        <div class="mb-5 p-4 bg-white border border-red-200 text-red-800 rounded-xl text-sm font-medium shadow-sm flex items-center gap-2">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- Grid Utama: Menjadi 1 kolom di HP, 3 kolom di Desktop -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI & TENGAH: Data Detail Pesanan -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- 1. Ringkasan Status Utama (Khusus HP agar info langsung terlihat di paling atas) -->
            <div class="block lg:hidden bg-amber-950 text-white p-5 rounded-2xl shadow-sm">
                <span class="text-xs text-amber-200/80 uppercase font-bold tracking-wider block">Kode Pesanan</span>
                <h2 class="text-xl font-mono font-bold tracking-wide mb-3">{{ $pesanan->kode_pesanan }}</h2>
                <div class="flex justify-between items-center pt-2.5 border-t border-white/10">
                    <span class="text-xs text-amber-200/80">Status Saat Ini:</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight
                        @if($pesanan->status_pesanan == 'menunggu') bg-amber-700 text-amber-5 border border-amber-600
                        @elseif($pesanan->status_pesanan == 'diproses') bg-blue-700 text-blue-5 border border-blue-600
                        @elseif($pesanan->status_pesanan == 'dikirim') bg-purple-700 text-purple-5 border border-purple-600
                        @elseif($pesanan->status_pesanan == 'dibatalkan') bg-red-700 text-red-5 border border-red-600
                        @else bg-emerald-700 text-emerald-5 border border-emerald-600 @endif">
                        {{ $pesanan->status_pesanan }}
                    </span>
                </div>
            </div>

            <!-- 2. Informasi Pengiriman Pelanggan -->
            <div class="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-amber-100">
                <h3 class="text-sm font-bold uppercase text-amber-900 tracking-wider mb-4 border-b border-amber-50 pb-2 flex items-center gap-2">
                    <span>👤</span> Informasi Pengiriman Pelanggan
                </h3>
                
                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">Nama Lengkap</span>
                        <p class="text-gray-800 font-bold text-base">{{ $pesanan->nama }}</p>
                    </div>
                    
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">No HP / WhatsApp</span>
                        <p class="text-gray-800 font-semibold">{{ $pesanan->no_hp ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">Alamat Rumah Lengkap</span>
                        <p class="text-gray-800 font-semibold leading-relaxed">
                            {{ $pesanan->alamat ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. Rincian Kopi Yang Dibeli -->
            <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden">
                <div class="p-4 bg-amber-900/5 border-b border-amber-100">
                    <h3 class="text-sm font-bold uppercase text-amber-900 tracking-wider flex items-center gap-2">
                        <span>☕</span> Rincian Kopi Yang Dibeli
                    </h3>
                </div>
                
                <!-- TAMPILAN RESPONSIF HP: List Item (Bukan Tabel) -->
                <div class="block md:hidden divide-y divide-amber-50 px-4">
                    @foreach($detail_items as $item)
                        <div class="py-4 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-lg shadow-inner">
                                    🫘
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">Wasana Coffee {{ $item->id_produk == 1 ? '100g' : '250g' }}</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        Rp {{ number_format($item->harga_saat_ini, 0, ',', '.') }} × {{ $item->qty }} pcs
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-bold text-amber-900 block">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Total Pembayaran di HP -->
                    <div class="py-4 flex justify-between items-center bg-amber-50/-50">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Akhir:</span>
                        <span class="text-lg font-black text-amber-900">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- TAMPILAN LAPTOP / TABLET: Tabel Tradisional -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead class="bg-amber-900/5 text-amber-900 text-xs font-semibold uppercase tracking-wider border-b border-amber-100">
                            <tr>
                                <th class="p-4 pl-6">Varian Produk</th>
                                <th class="p-4 text-center">Harga Satuan</th>
                                <th class="p-4 text-center">Quantity</th>
                                <th class="p-4 text-right pr-6">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm divide-y divide-amber-50">
                            @foreach($detail_items as $item)
                                <tr class="hover:bg-amber-50/30 transition bg-white">
                                    <td class="p-4 pl-6 font-semibold text-gray-700">
                                        Wasana Coffee {{ $item->id_produk == 1 ? '100g' : '250g' }}
                                    </td>
                                    <td class="p-4 text-center font-bold text-amber-900">
                                        Rp {{ number_format($item->harga_saat_ini, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-center font-medium text-gray-600">
                                        {{ $item->qty }} Pcs
                                    </td>
                                    <td class="p-4 text-right pr-6 text-amber-900 font-bold">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-amber-900/5 font-bold text-amber-950 border-t border-amber-100">
                                <td colspan="3" class="p-4 text-right font-bold text-xs uppercase tracking-wider text-amber-950">
                                    Total Final Pembayaran :
                                </td>
                                <td class="p-4 text-right pr-6 text-base text-amber-900 font-bold">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Panel Kontrol Aksi -->
        <div class="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-amber-100 h-fit space-y-5">
            <div>
                <h3 class="text-sm font-bold uppercase text-amber-900 tracking-wider mb-3 border-b border-amber-50 pb-2 flex items-center gap-2">
                    <span>⚙️</span> Panel Kontrol Aksi
                </h3>
                
                <!-- Info Status Utama (Hanya muncul di laptop/desktop) -->
                <div class="hidden lg:block text-xs mb-2">
                    <p class="text-gray-400 font-semibold uppercase tracking-wider mb-1">Kode Pesanan:</p>
                    <p class="font-mono font-bold text-sm text-amber-950 tracking-wide mb-3">{{ $pesanan->kode_pesanan }}</p>
                    
                    <p class="text-gray-400 font-semibold uppercase tracking-wider mb-1">Status Saat Ini:</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight
                        @if($pesanan->status_pesanan == 'menunggu') bg-amber-50 text-amber-800 border border-amber-200/50
                        @elseif($pesanan->status_pesanan == 'diproses') bg-blue-50 text-blue-700 border border-blue-200/50
                        @elseif($pesanan->status_pesanan == 'dikirim') bg-purple-50 text-purple-700 border border-purple-200/50
                        @elseif($pesanan->status_pesanan == 'dibatalkan') bg-red-50 text-red-700 border border-red-200/50
                        @else bg-emerald-50 text-emerald-700 border border-emerald-200/50 @endif">
                        {{ $pesanan->status_pesanan }}
                    </span>
                </div>
            </div>

            <!-- Form Update Status -->
            <form method="POST" action="{{ route('admin.pesanan.update', $pesanan->id_pesanan) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        Ubah Status Ke:
                    </label>
                    <select name="status_pesanan" class="w-full bg-amber-50/50 border border-amber-200/60 rounded-xl px-3 py-2.5 text-sm font-semibold text-amber-950 focus:outline-none focus:border-amber-800 shadow-sm transition">
                        <option value="menunggu" {{ $pesanan->status_pesanan == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ $pesanan->status_pesanan == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ $pesanan->status_pesanan == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ $pesanan->status_pesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $pesanan->status_pesanan == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-amber-800 hover:bg-amber-900 text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider transition shadow-sm flex items-center justify-center gap-1.5 active:scale-[0.98]">
                    💾 Simpan Perubahan Status
                </button>
            </form>
        </div>
    </div>
@endsection