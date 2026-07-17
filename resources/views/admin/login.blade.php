<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Wasana Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- REVISI LAYOUT: Mengubah flex agar mendukung scrolling aman di layar HP dan anti-terpotong -->
<body class="bg-amber-100 min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 md:p-8 overflow-y-auto antialiased">

    <!-- REVISI LAYOUT: Ditambahkan my-auto dan modifikasi padding dinamis p-6 ke p-8 agar pas di semua ukuran Android/iOS -->
    <div class="bg-amber-50 p-6 sm:p-8 rounded-2xl shadow-xl w-full max-w-md border border-amber-200 my-auto">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-amber-900 tracking-wide">Admin Login</h2>
            <p class="text-amber-700 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        @if ($errors->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg mb-4 text-sm text-center">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf 

            <div class="mb-4">
                <label class="block text-amber-900 text-sm font-semibold mb-2" for="username">Username</label>
                <input class="w-full px-4 py-2.5 bg-white border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent text-amber-900" 
                       type="text" name="username" id="username" placeholder="Masukkan username admin" required>
            </div>

            <div class="mb-6">
                <label class="block text-amber-900 text-sm font-semibold mb-2" for="password">Password</label>
                <input class="w-full px-4 py-2.5 bg-white border border-amber-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent text-amber-900" 
                       type="password" name="password" id="password" placeholder="••••••••" required>
            </div>

            <button class="w-full bg-amber-800 hover:bg-amber-900 text-white font-bold py-2.5 px-4 rounded-xl transition duration-200 shadow-md transform active:scale-95" 
                    type="submit">
                Login
            </button>
        </form>
    </div>

</body>
</html>