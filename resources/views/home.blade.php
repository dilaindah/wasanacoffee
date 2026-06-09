<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Pembeli - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] min-h-screen flex flex-col items-center justify-center p-6 text-center">

    <div class="max-w-md bg-white p-8 rounded-[32px] shadow-xl border border-amber-100">
        <div class="w-20 h-20 bg-amber-100 text-amber-800 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-inner">
            <i class="fa-solid fa-mug-hot"></i>
        </div>
        
        <h1 class="text-2xl font-bold text-amber-950 mb-2">Selamat Datang, {{ Auth::user()->nama }}! 👋</h1>
        <p class="text-gray-500 text-sm mb-6">Akun pembeli adek sudah aktif. Ini adalah halaman utama (Home) pembeli Wasana Coffee.</p>
        
        <div class="bg-amber-50 p-4 rounded-xl text-left border border-amber-100 mb-6 space-y-2">
            <p class="text-xs text-amber-900 font-bold uppercase tracking-wider">📦 Data Pengiriman Anda:</p>
            <p class="text-sm text-gray-700"><strong>No. HP:</strong> {{ Auth::user()->no_hp }}</p>
            <p class="text-sm text-gray-700"><strong>Alamat:</strong> {{ Auth::user()->alamat }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm transition transform hover:scale-[1.02]">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar / Logout
            </button>
        </form>
    </div>

</body>
</html>