<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password Baru - Wasana Coffee</title>
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
                <h2 class="text-3xl font-bold text-amber-900 tracking-tight">Atur Ulang Password</h2>
                <p class="text-gray-500 text-sm mt-1">Silakan masukkan password baru Anda dengan teliti.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label class="block text-xs font-bold text-amber-950 uppercase tracking-widest mb-1.5 ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly
                        class="w-full px-5 py-3 rounded-xl border border-amber-200 bg-amber-50/50 outline-none transition text-sm text-gray-500 cursor-not-allowed shadow-sm">
                    @error('email') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold text-amber-950 uppercase tracking-widest mb-1.5 ml-1">Password Baru</label>
                    <input type="password" name="password" required placeholder="Minimal 8 karakter"
                        class="w-full px-5 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-600 outline-none transition text-sm text-gray-800 shadow-sm placeholder:text-gray-400">
                    @error('password') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-bold text-amber-950 uppercase tracking-widest mb-1.5 ml-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi password baru Anda"
                        class="w-full px-5 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-600 outline-none transition text-sm text-gray-800 shadow-sm placeholder:text-gray-400">
                    @error('password_confirmation') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-amber-800 hover:bg-amber-900 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all transform hover:scale-[1.01] active:scale-95 tracking-widest uppercase text-xs">
                        Perbarui Password <i class="fa-solid fa-circle-check ml-2"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>