<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Wasana Coffee')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50/40 flex min-h-screen font-sans">

    <aside class="w-64 bg-amber-900 text-amber-100 flex flex-col shadow-xl min-h-screen sticky top-0">
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
        @yield('content')
    </main>

</body>
</html>