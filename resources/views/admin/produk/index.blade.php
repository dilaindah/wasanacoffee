@extends('layouts.admin')

@section('title', 'Kelola Varian Produk - Wasana Coffee')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Header: Tombol "Tambah Varian Baru" otomatis melebar penuh di HP -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 pb-4 border-b border-amber-200/60 gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-amber-900">Kelola Varian Kopi</h2>
            <p class="text-xs md:text-sm text-gray-500 mt-0.5">Atur daftar ukuran varian, harga, dan pantau stok kopi Wasana Coffee.</p>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center bg-amber-800 hover:bg-amber-900 text-white font-semibold py-2.5 px-5 rounded-xl transition shadow gap-2 text-sm">
            ➕ Tambah Varian Baru
        </a>
    </div>

    <!-- Tambahan `overflow-x-auto` membuat tabel bisa di-scroll secara horizontal di HP -->
    <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-x-auto whitespace-nowrap">
        <table class="w-full text-left border-collapse min-w-[600px] sm:min-w-full">
            <thead>
                <tr class="bg-amber-800 text-white text-xs md:text-sm font-semibold uppercase tracking-wider border-b border-amber-800">
                    <th class="p-3 md:p-4 pl-4 md:pl-6">No</th>
                    <th class="p-3 md:p-4">Ukuran Varian</th>
                    <th class="p-3 md:p-4">Harga</th>
                    <th class="p-3 md:p-4">Stok Toko</th>
                    <th class="p-3 md:p-4 text-center pr-4 md:pr-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-xs md:text-sm divide-y divide-amber-50">
                @forelse($produks as $index => $item)
                    <tr class="hover:bg-amber-50/30 transition">
                        <td class="p-3 md:p-4 pl-4 md:pl-6 font-medium text-gray-400">{{ $index + 1 }}</td>
                        <td class="p-3 md:p-4 font-semibold text-amber-950">{{ $item->nama_varian }}</td>
                        <td class="p-3 md:p-4 font-medium text-emerald-700">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="p-3 md:p-4">
                            @if($item->stok <= 5)
                                <span class="bg-red-50 text-red-700 px-2.5 py-1 rounded-full text-xs font-bold border border-red-100">
                                    ⚠️ Sisa {{ $item->stok }}
                                </span>
                            @else
                                <span class="bg-amber-50 text-amber-800 px-2.5 py-1 rounded-full text-xs font-semibold border border-amber-100">
                                    {{ $item->stok }} Pcs
                                </span>
                            @endif
                        </td>
                        <td class="p-3 md:p-4 text-center pr-4 md:pr-6 space-x-1.5">
                            <a href="{{ route('admin.produk.edit', $item->id_produk) }}" class="inline-block bg-amber-100 hover:bg-amber-200 text-amber-900 text-xs font-bold py-1.5 px-3 rounded-lg transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.produk.destroy', $item->id_produk) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus varian ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold py-1.5 px-3 rounded-lg transition">
                                    🗑️ Hapus
                                </h2>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400 italic whitespace-normal">
                            Belum ada varian produk kopi yang terdaftar. Silakan tambah baru!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection