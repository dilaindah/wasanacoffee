@extends('layouts.admin')

@section('title', 'Overview Dashboard - Wasana Coffee')

@section('content')
    <header class="flex justify-between items-center mb-8 pb-4 border-b border-amber-200/60">
        <div>
            <h2 class="text-2xl font-bold text-amber-900">Selamat Datang, Admin!</h2>
            <p class="text-sm text-gray-500">Berikut adalah ringkasan data toko kopi hari ini.</p>
        </div>
        <div class="text-sm bg-amber-100 text-amber-800 px-4 py-1.5 rounded-full font-medium shadow-sm border border-amber-200">
            🟢 Mode Administrator Aktif
        </div>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
            <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Produk</span>
            <span class="text-3xl font-bold text-amber-900 mt-2">0 Varian</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
            <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Pesanan</span>
            <span class="text-3xl font-bold text-amber-900 mt-2">0 Transaksi</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
            <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Pesanan Hari Ini</span>
            <span class="text-3xl font-bold text-emerald-700 mt-2">0 Pesanan</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
            <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Pendapatan</span>
            <span class="text-3xl font-bold text-emerald-700 mt-2">Rp 0</span>
        </div>
    </div>

    <div class="bg-gradient-to-r from-amber-800 to-amber-950 text-amber-100 p-6 rounded-2xl shadow-md">
        <p class="text-sm opacity-75">Grafik pesanan 7 hari terakhir akan muncul di sini.</p>
    </div>
@endsection