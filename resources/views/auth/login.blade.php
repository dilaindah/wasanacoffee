<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Pelanggan - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<!-- REVISI: Mengubah sistem flex & overflow agar layout responsif dan bisa di-scroll dengan aman di HP Android -->
<body class="bg-[#fdfaf5] min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 md:p-8 relative overflow-y-auto antialiased">
    
    <!-- Latar Belakang Dekoratif Statis -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-amber-200/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-amber-800/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- REVISI: Mengubah padding (p-6 di HP, p-10 di laptop) dan border radius agar serasi dengan Register -->
    <div class="w-full max-w-xl bg-white rounded-[24px] sm:rounded-[32px] shadow-2xl border border-amber-100/80 overflow-hidden relative z-10 my-auto">
        <div class="p-6 sm:p-8 md:p-10">
            
            <div class="text-center mb-6 sm:mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-amber-900 tracking-tight">Selamat Datang</h2>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Silakan masuk untuk melanjutkan pesanan kopi favoritmu.</p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-xs sm:text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-200 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
                @csrf

                <!-- ALAMAT EMAIL -->
                <div>
                    <label class="block text-[10px] sm:text-xs font-bold text-amber-950 uppercase tracking-widest mb-1.5 ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com"
                        class="w-full px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-600 outline-none transition text-sm text-gray-800 shadow-sm placeholder:text-gray-400">
                    <!-- Warning Merah untuk Email -->
                    @error('email') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="block text-[10px] sm:text-xs font-bold text-amber-950 uppercase tracking-widest mb-1.5 ml-1">Password</label>
                    <input type="password" name="password" required minlength="8" placeholder="Masukkan password Anda"
                        class="w-full px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-600 outline-none transition text-sm text-gray-800 shadow-sm placeholder:text-gray-400">
                    <!-- Warning Merah untuk Password -->
                    @error('password') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                </div>

                <!-- INGAT AKUN -->
                <div class="flex items-center ml-1">
                    <input id="remember_me" type="checkbox" name="remember" 
                        class="rounded border-gray-300 text-amber-800 focus:ring-amber-600 w-4 h-4 accent-amber-800">
                    <label for="remember_me" class="ms-2 text-xs text-gray-600 cursor-pointer select-none">Ingat akun saya di perangkat ini</label>
                </div>

                <!-- BUTTON SUBMIT -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-amber-800 hover:bg-amber-900 text-white font-bold py-3 sm:py-3.5 rounded-xl shadow-lg transition-all transform hover:scale-[1.01] active:scale-95 tracking-widest uppercase text-[10px] sm:text-xs">
                        Masuk Aplikasi <i class="fa-solid fa-right-to-bracket ml-2"></i>
                    </button>
                </div>

                <!-- FOOTER CARD LINKS -->
                <div class="flex flex-col gap-3 items-center pt-4 border-t border-gray-100 mt-4">
                    <p class="text-xs sm:text-sm text-gray-500">
                        Belum memiliki akun? <a href="{{ route('register') }}" class="text-amber-800 font-bold hover:underline">Daftar di sini</a>
                    </p>
                    <a href="{{ route('password.request') }}" class="text-[11px] sm:text-xs text-amber-700/80 hover:text-amber-900 hover:underline transition flex items-center gap-1">
                        <i class="fa-solid fa-lock text-[10px]"></i> Lupa Password Anda?
                    </a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>