<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Wasana Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50/40 flex min-h-screen font-sans">

    <aside class="w-64 bg-amber-900 text-amber-100 flex flex-col shadow-xl">
        <div class="p-5 text-center border-b border-amber-800">
            <h1 class="text-xl font-bold tracking-wider text-white">Wasana Coffee</h1>
            <p class="text-xs text-amber-300/80 mt-1">Sistem Kendali Admin</p>
        </div>
        
            <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-white bg-transparent hover:bg-amber-800/100 rounded-xl font-medium transition group">
                <span class="mr-3">📊</span>
                <span>Dashboard Overview</span>
            </a>
            
            <a href="{{ route('admin.produk.index') }}" class="flex items-center px-4 py-3 text-white bg-transparent hover:bg-amber-800/100 rounded-xl font-medium transition group">
                <span class="mr-3">☕</span>
                <span>Kelola Produk</span>
            </a>

            <a href="{{ route('admin.pesanan.index') }}" class="flex items-center px-4 py-3 text-white bg-transparent hover:bg-amber-800/100 rounded-xl font-medium transition group">
                <span class="mr-3">🛍️</span>
                <span>Kelola Pesanan</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-4 py-3 text-white bg-transparent hover:bg-amber-800/100 rounded-xl font-medium transition group">
                <span class="mr-3">📈</span>
                <span>Laporan Penjualan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-amber-800 bg-amber-950/40">
            <div class="text-sm font-semibold text-white mb-2">👤 {{ session('admin_username') }}</div>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-center bg-red-800 hover:bg-red-900 text-white text-xs font-bold py-2 px-4 rounded-lg transition shadow">
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8">
        <header class="flex justify-between items-center mb-8 pb-4 border-b border-amber-200/60">
            <div>
                <h2 class="text-2xl font-bold text-amber-900">Selamat Datang, Admin!</h2>
                <p class="text-sm text-gray-500">Berikut adalah ringkasan data toko kopi hari ini.</p>
            </div>
            <div class="text-sm bg-amber-100 text-amber-800 px-4 py-1.5 rounded-full font-medium shadow-sm border border-amber-200">
                🟢 Mode Administrator Aktif
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Produk</span>
                <span class="text-3xl font-bold text-amber-900 mt-2">0 Varian</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Pesanan</span>
                <span class="text-3xl font-bold text-amber-900 mt-2">0 Orang</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Pesanan Hari Ini</span>
                <span class="text-3xl font-bold text-emerald-700 mt-2">0 Pesanan</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-100 flex flex-col justify-between">
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Pendapatan</span>
                <span class="text-3xl font-bold text-emerald-700 mt-2">0 Pesanan</span>
            </div>
        </div>

        <div class="bg-gradient-to-r from-amber-800 to-amber-950 text-amber-100 p-6 rounded-2xl shadow-md">
        </div>
    </main>

</body>
</html>