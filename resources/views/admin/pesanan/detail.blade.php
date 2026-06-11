@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $pesanan->kode_pesanan)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.pesanan.index') }}" class="text-amber-900 hover:text-amber-950 text-sm font-semibold hover:underline flex items-center gap-1">
            ⬅️ Kembali ke Daftar Pesanan
        </a>
    </div>

    @if(session('error'))
        <div class="mb-5 p-4 bg-white border border-red-200 text-red-800 rounded-xl text-sm font-medium shadow-sm flex items-center gap-2">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-2 space-y-6">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100">
                <h3 class="text-sm font-bold uppercase text-amber-900 tracking-wider mb-4 border-b border-amber-50 pb-2">
                    👤 Informasi Pengiriman Pelanggan
                </h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex border-b border-amber-50 pb-2">
                        <span class="w-32 text-gray-500 font-medium">Nama Lengkap</span>
                        <span class="flex-1 text-gray-700 font-semibold">: {{ $pesanan->nama }}</span>
                    </div>
                    <div class="flex border-b border-amber-50 pb-2">
                        <span class="w-32 text-gray-500 font-medium">No HP / WA</span>
                        <span class="flex-1 text-gray-700 font-semibold">: {{ $pesanan->no_hp ?? '-' }}</span>
                    </div>
                    <div class="flex pt-1">
                        <span class="w-32 text-gray-500 font-medium">Alamat Rumah</span>
                        <span class="flex-1 text-gray-700 font-semibold leading-relaxed">: {{ $pesanan->alamat ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden">
                <div class="p-4 bg-amber-900/5 border-b border-amber-100">
                    <h3 class="text-sm font-bold uppercase text-amber-900 tracking-wider">
                        ☕ Rincian Kopi Yang Dibeli
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
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

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 h-fit">
    <h3 class="text-sm font-bold uppercase text-amber-900 tracking-wider mb-4 border-b border-amber-50 pb-2">
        ⚙️ Panel Kontrol Aksi
    </h3>
    
    <div class="mb-5 text-xs">
        <p class="text-gray-500 font-semibold uppercase tracking-wider">Status Saat Ini:</p>
        <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight
            @if($pesanan->status_pesanan == 'menunggu') bg-amber-50 text-amber-800 border border-amber-200/50
            @elseif($pesanan->status_pesanan == 'diproses') bg-blue-50 text-blue-700 border border-blue-200/50
            @elseif($pesanan->status_pesanan == 'dikirim') bg-purple-50 text-purple-700 border border-purple-200/50
            @else bg-emerald-50 text-emerald-700 border border-emerald-200/50 @endif">
            {{ $pesanan->status_pesanan }}
        </span>
    </div>

    <form method="POST" action="{{ route('admin.pesanan.update', $pesanan->id_pesanan) }}">
        @csrf
        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
            Ubah Status Ke:
        </label>
        
        <select name="status_pesanan" class="w-full bg-amber-50/50 border border-amber-200/60 rounded-xl px-3 py-2.5 text-sm font-semibold text-amber-950 focus:outline-none focus:border-amber-800 shadow-sm transition mb-5">
            <option value="menunggu" {{ $pesanan->status_pesanan == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="diproses" {{ $pesanan->status_pesanan == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="dikirim" {{ $pesanan->status_pesanan == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ $pesanan->status_pesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit" class="w-full bg-amber-800 hover:bg-amber-900 text-white font-semibold py-2.5 rounded-xl text-xs uppercase tracking-wider transition transform active:scale-95 shadow-sm flex items-center justify-center gap-1.5">
            💾 Simpan Perubahan Status
        </button>
    </form>
</div>
    </div>
@endsection