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
            
            <!-- FORM PERBARUI INFORMASI PROFIL & ALAMAT -->
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
                        <!-- NAMA LENGKAP -->
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                            @error('nama') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <!-- ALAMAT EMAIL -->
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Alamat Email</label>
                            <!-- REVISI ABSOLUT: Menggunakan gabungan type="text", pattern HTML5, dan Real-time Javascript Listener -->
                            <input type="text" id="email-input" name="email" value="{{ old('email', $user->email) }}" required
                                pattern="[a-zA-Z0-9._%+-]+@gmail\.com"
                                placeholder="contoh@gmail.com"
                                oninput="validateGmail(this)"
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                            
                            <!-- Tempat munculnya pesan warning merah custom di bawah input secara real-time -->
                            <span id="email-warning" class="text-red-500 text-xs mt-1 ml-1 hidden">
                                <i class="fa-solid fa-circle-exclamation mr-1"></i>Format salah! Wajib menggunakan domain '@gmail.com' murni.
                            </span>

                            @error('email') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <!-- NOMOR HP / WHATSAPP -->
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Nomor HP / WhatsApp</label>
                            <input type="tel" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" required
                                pattern="[0-9]{10,14}" 
                                title="Format nomor salah. Harap masukkan hanya angka sepanjang 10-14 digit (Contoh: 081234567890)" 
                                placeholder="Contoh: 08123456789"
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                            @error('no_hp') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- ALAMAT PENGIRIMAN LENGKAP -->
                    <div>
                        <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Alamat Pengiriman Lengkap</label>
                        <textarea name="alamat" required rows="3" placeholder="Masukkan nama jalan, nomor rumah, RT/RW, kecamatan, dan kota..."
                            class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                        @error('alamat') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" id="submit-btn" class="bg-amber-800 hover:bg-amber-900 text-white font-bold px-6 py-3 rounded-xl text-xs transition transform active:scale-95 shadow-md">
                            <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- FORM PERBARUI PASSWORD -->
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
                        <!-- PASSWORD LAMA -->
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Password Lama</label>
                            <input type="password" name="current_password" required minlength="8"
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                            @error('current_password', 'updatePassword') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <!-- PASSWORD BARU -->
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Password Baru</label>
                            <input type="password" name="password" required minlength="8" placeholder="Minimal 8 karakter"
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                            @error('password', 'updatePassword') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <!-- KONFIRMASI PASSWORD BARU -->
                        <div>
                            <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required minlength="8"
                                class="w-full bg-amber-50/40 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                            @error('password_confirmation', 'updatePassword') <span class="text-red-500 text-xs mt-1 ml-1 block"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
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

    <!-- JAVASCRIPT VALIDASI DUA LAPIS (Mencegah Bypass Sempurna) -->
    <script>
        function validateGmail(input) {
            const val = input.value;
            const warningEl = document.getElementById('email-warning');
            const submitBtn = document.getElementById('submit-btn');
            
            // Aturan super ketat wajib diakhiri tulisan @gmail.com murni
            const targetDomain = "@gmail.com";
            
            if (val.length > 0 && !val.endsWith(targetDomain)) {
                // Tampilkan warning text merah buatan adek
                warningEl.classList.remove('hidden');
                warningEl.classList.add('block');
                // Kasih tahu browser kalau input ini tidak sah agar form terkunci bawaan
                input.setCustomValidity("Wajib diakhiri dengan @gmail.com");
            } else {
                // Sembunyikan warning merah kalau udah bener
                warningEl.classList.remove('block');
                warningEl.classList.add('hidden');
                // Kembalikan ke mode valid
                input.setCustomValidity("");
            }
        }
    </script>

</body>
</html>