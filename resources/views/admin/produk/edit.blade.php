@extends('layouts.admin')

@section('title', 'Edit Varian - Wasana Coffee')

@section('content')
    <div class="mb-8 pb-4 border-b border-amber-200/60">
        <a href="{{ route('admin.produk.index') }}" class="text-amber-800 hover:text-amber-950 font-medium text-sm flex items-center gap-1 mb-2">
            ⬅️ Kembali ke Daftar Varian
        </a>
        <h2 class="text-2xl font-bold text-amber-900">Edit Varian Kopi</h2>
        <p class="text-sm text-gray-500">Ubah informasi nama varian, harga, atau stok untuk produk ini.</p>
    </div>

    <div class="max-w-xl bg-white p-6 rounded-2xl shadow-sm border border-amber-100">
        <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_varian" class="block text-sm font-semibold text-amber-950 mb-1">Nama / Ukuran Varian</label>
                <input type="text" name="nama_varian" id="nama_varian" required 
                       value="{{ $produk->nama_varian }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div>
                <label for="harga" class="block text-sm font-semibold text-amber-950 mb-1">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" required 
                       value="{{ $produk->harga }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div>
                <label for="stok" class="block text-sm font-semibold text-amber-950 mb-1">Stok Toko</label>
                <input type="number" name="stok" id="stok" required 
                       value="{{ $produk->stok }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-amber-800 hover:bg-amber-900 text-white font-semibold py-2.5 px-5 rounded-xl transition shadow text-sm text-center justify-center">
                    💾 Update Varian Kopi
                </button>
                <a href="{{ route('admin.produk.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection