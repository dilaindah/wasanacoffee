<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased">

    @include('layouts.nav-pembeli')

    <div class="max-w-4xl mx-auto px-4 py-10">
        
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-amber-800 text-sm font-bold hover:underline">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <h2 class="text-3xl font-black text-amber-950 mb-2 tracking-tight">Pengaturan Profil</h2>
        <p class="text-gray-500 text-sm mb-8">Perbarui informasi akun dan alamat pengiriman kopi Wasana adek di sini.</p>

        <div class="space-y-8">
            
            <div class="bg-white rounded-[24px] p-6 md:p-8 shadow-xl border border-amber-100">
                <h3 class="text-lg font-bold text-amber-950 mb-1 flex items-center gap-2">
                    <i class="fa-solid fa-user text-amber-800"></i> Informasi Profil & Alamat
                </h3>
                <p class="text-gray-400 text-xs mb-6">Ubah nama, email, nomor HP, serta alamat lengkap rumah adek.</p>

                @if (session('status') === 'profile-updated')
                    <div class="mb-6 text-xs text-green-700 bg-green-50 p-3.5 rounded-xl border border-green-200 font-bold animate-fadeIn">
                        <i class="fa-solid fa-circle-check mr-1"></i> Profil berhasil diperbarui!
                    </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required
                            class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Nomor HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" placeholder="Contoh: 08123456789"
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Alamat Pengiriman Lengkap</label>
                        <textarea name="alamat" rows="3" placeholder="Masukkan nama jalan, nomor rumah, RT/RW, kecamatan, dan kota..."
                            class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="bg-amber-800 hover:bg-amber-900 text-white font-bold px-6 py-3 rounded-xl text-xs transition transform active:scale-95 shadow-md">
                            <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[24px] p-6 md:p-8 shadow-xl border border-amber-100">
                <h3 class="text-lg font-bold text-amber-950 mb-1 flex items-center gap-2">
                    <i class="fa-solid fa-lock text-amber-800"></i> Perbarui Password
                </h3>
                <p class="text-gray-400 text-xs mb-6">Pastikan akun adek tetap aman menggunakan password yang kuat.</p>

                @if (session('status') === 'password-updated')
                    <div class="mb-6 text-xs text-green-700 bg-green-50 p-3.5 rounded-xl border border-green-200 font-bold animate-fadeIn">
                        <i class="fa-solid fa-circle-check mr-1"></i> Password berhasil diubah!
                    </div>
                @endif

                @if($errors->updatePassword->any())
                    <div class="mb-6 text-xs text-red-600 bg-red-50 p-3.5 rounded-xl border border-red-200 font-bold">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $errors->updatePassword->first() }}
                    </div>
                @endif

                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Password Lama</label>
                            <input type="password" name="current_password" required
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Password Baru</label>
                            <input type="password" name="password" required
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="bg-amber-800 hover:bg-amber-900 text-white font-bold px-6 py-3 rounded-xl text-xs transition transform active:scale-95 shadow-md">
                            <i class="fa-solid fa-key mr-1"></i> Ganti Password
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</body>
</html>