@extends('layouts.admin')

@section('title', 'Edit Varian - Wasana Coffee')

@section('content')
    <!-- Header: Menyesuaikan margin dan padding di HP -->
    <div class="mb-6 md:mb-8 pb-4 border-b border-amber-200/60">
        <a href="{{ route('admin.produk.index') }}" class="text-amber-800 hover:text-amber-950 font-medium text-sm flex items-center gap-1 mb-2">
            ⬅️ Kembali ke Daftar Varian
        </a>
        <h2 class="text-xl md:text-2xl font-bold text-amber-900">Edit Varian Kopi</h2>
        <p class="text-xs md:text-sm text-gray-500 mt-0.5">Ubah informasi nama varian, harga, atau stok untuk produk ini.</p>
    </div>

    <!-- Card: Menggunakan p-4 di HP dan p-6 di layar besar -->
    <div class="max-w-xl bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-amber-100">
        <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" class="space-y-4 md:space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_varian" class="block text-sm font-semibold text-amber-950 mb-1">Nama / Ukuran Varian</label>
                <input type="text" name="nama_varian" id="nama_varian" required 
                       value="{{ $produk->nama_varian }}"
                       class="w-full px-3 md:px-4 py-2.5 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div>
                <label for="harga" class="block text-sm font-semibold text-amber-950 mb-1">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" required 
                       value="{{ $produk->harga }}"
                       class="w-full px-3 md:px-4 py-2.5 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div>
                <label for="stok" class="block text-sm font-semibold text-amber-950 mb-1">Stok Toko</label>
                <input type="number" name="stok" id="stok" required 
                       value="{{ $produk->stok }}"
                       class="w-full px-3 md:px-4 py-2.5 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <!-- Tombol: flex-col-reverse agar Batal di bawah di HP, md:flex-row agar sejajar di laptop -->
            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-2">
                <a href="{{ route('admin.produk.index') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm transition text-center">
                    Batal
                </a>
                <button type="submit" class="w-full sm:flex-1 bg-amber-800 hover:bg-amber-900 text-white font-semibold py-2.5 px-5 rounded-xl transition shadow text-sm text-center flex justify-center items-center">
                    💾 Update Varian Kopi
                </button>
            </div>
        </form>
    </div>
@endsection