<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] min-h-screen flex items-center justify-center p-4 md:p-8 relative overflow-hidden">
    
    <!-- Background Blur Efek Kopi -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-amber-200/40 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-amber-800/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-xl bg-white rounded-[32px] shadow-2xl border border-amber-100/80 overflow-hidden relative z-10 my-4">
        <div class="p-8 md:p-10">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-amber-900 tracking-tight">Lupa Password?</h2>
                <p class="text-gray-500 text-sm mt-2">Jangan khawatir! Beritahu kami alamat email Anda, dan kami akan mengirimkan link reset password baru.</p>
            </div>

            <!-- Session Status / Notifikasi Sukses -->
            @if (session('status'))
                <div class="mb-5 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-200 text-center">
                    <i class="fa-solid fa-circle-check mr-1.5"></i> {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label class="block text-xs font-bold text-amber-950 uppercase tracking-widest mb-1.5 ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com"
                        class="w-full px-5 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-600 outline-none transition text-sm text-gray-800 shadow-sm placeholder:text-gray-400">
                    @error('email') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-amber-800 hover:bg-amber-900 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all transform hover:scale-[1.01] active:scale-95 tracking-widest uppercase text-xs">
                        Kirim Link Reset <i class="fa-solid fa-paper-plane ml-2"></i>
                    </button>
                </div>

                <div class="flex flex-col gap-3 items-center pt-4 border-t border-gray-100 mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-amber-800 font-bold hover:underline flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Masuk
                    </a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>