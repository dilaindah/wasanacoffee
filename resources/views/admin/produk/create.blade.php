@extends('layouts.admin')

@section('title', 'Tambah Varian Baru - Wasana Coffee')

@section('content')
    <!-- REVISI LAYOUT: Menyesuaikan margin bawah dan padding agar tidak terlalu sesak di mobile -->
    <div class="mb-6 sm:mb-8 pb-4 border-b border-amber-200/60">
        <a href="{{ route('admin.produk.index') }}" class="text-amber-800 hover:text-amber-950 font-medium text-xs sm:text-sm flex items-center gap-1 mb-2">
            ⬅️ Kembali ke Daftar Varian
        </a>
        <h2 class="text-xl sm:text-2xl font-black text-amber-950 tracking-tight">Tambah Varian Kopi Baru</h2>
        <p class="text-xs sm:text-sm text-gray-500">Masukkan detail ukuran varian, harga, dan stok awal produk.</p>
    </div>

    <!-- REVISI LAYOUT: Menggunakan p-5 sm:p-6 agar lebih proporsional di layar kecil -->
    <div class="max-w-xl w-full bg-white p-5 sm:p-6 rounded-[24px] shadow-sm border border-amber-100">
        <form action="{{ route('admin.produk.store') }}" method="POST" class="space-y-4 sm:space-y-5">
            @csrf

            <div>
                <label for="nama_varian" class="block text-xs sm:text-sm font-semibold text-amber-950 mb-1.5">Nama / Ukuran Varian</label>
                <input type="text" name="nama_varian" id="nama_varian" required 
                       placeholder="Contoh: Wasana Coffee - 500g" 
                       class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div>
                <label for="harga" class="block text-xs sm:text-sm font-semibold text-amber-950 mb-1.5">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" required 
                       placeholder="Contoh: 120000" 
                       class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <div>
                <label for="stok" class="block text-xs sm:text-sm font-semibold text-amber-950 mb-1.5">Stok Awal</label>
                <input type="number" name="stok" id="stok" required 
                       placeholder="Contoh: 25" 
                       class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-800/20 focus:border-amber-800 transition text-sm">
            </div>

            <!-- REVISI LAYOUT: Membuat tombol jadi full-width di HP agar enak ditekan jempol -->
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="w-full sm:flex-1 bg-amber-800 hover:bg-amber-900 text-white font-bold py-3 px-5 rounded-xl transition shadow-md text-sm text-center justify-center active:scale-95">
                    💾 Simpan Varian Kopi
                </button>
                <a href="{{ route('admin.produk.index') }}" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection