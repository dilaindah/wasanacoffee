<!-- SILAHKAN SALIN SELURUH KODE INI DAN MASUKKAN KE FILE: resources/views/layouts/nav-pembeli.blade.php -->
<nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-sm border-b border-amber-100">
    <!-- REVISI UTAMA: Menggunakan w-full dan px agar logo mepet ke kiri mengikuti gaya Landing Page -->
    <div class="w-full px-6 sm:px-12">
        <div class="flex justify-between h-20 items-center">
            
            <!-- BAGIAN LOGO & TULISAN (SUDAH PAS MEPET KIRI) -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <!-- Logo Gambar -->
                    <img src="{{ asset('images/logo-wasana-coffee.jpeg') }}" 
                         alt="Logo Wasana Coffee" 
                         class="h-12 w-auto object-contain rounded-xl p-0.5 bg-amber-50/50 shadow-sm border border-amber-100">
                    
                    <!-- Tulisan Wasana Coffee -->
                    <span class="text-2xl font-bold text-amber-900 tracking-tighter">WASANA<span class="text-amber-600">COFFEE</span></span>
                </a>
            </div>
            
            <!-- 1. MENU UNTUK TAMPILAN LAPTOP (Desktop Menu) -->
            <div class="hidden md:flex space-x-6 items-center text-sm font-semibold text-amber-900">
                <a href="{{ route('home') }}" class="hover:text-amber-600 transition {{ Request::is('home') ? 'text-amber-600 font-bold' : '' }}">Home</a>
                <a href="{{ route('pembeli.riwayat') }}" class="hover:text-amber-600 transition">Riwayat</a>
                <a href="{{ route('pembeli.cek_status_form') }}" class="hover:text-amber-600 transition">Cek Status</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-amber-600 transition">Profil</a>
                <a href="https://wa.me/6287773382283" target="_blank" class="hover:text-amber-600 transition">WhatsApp</a>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition text-xs shadow-md font-bold">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
                    </button>
                </form>
            </div>

            <!-- 2. TOMBOL HAMBURGER (Responsif Android - Muncul Hanya di HP) -->
            <div class="flex items-center md:hidden">
                <button id="hamburger-btn" class="text-amber-900 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- 3. DROPDOWN MENU UNTUK HP (Otomatis Sembunyi, Muncul Pas Diklik) -->
    <div id="mobile-menu" class="hidden absolute top-20 left-0 w-full bg-white/95 backdrop-blur-md shadow-lg border-t border-amber-100 p-6 flex flex-col space-y-4 text-sm font-semibold text-amber-900 z-50 md:hidden">
        <a href="{{ route('home') }}" class="mobile-link hover:text-amber-600 transition py-1 {{ Request::is('home') ? 'text-amber-600 font-bold' : '' }}">Home</a>
        <a href="{{ route('pembeli.riwayat') }}" class="mobile-link hover:text-amber-600 transition py-1">Riwayat</a>
        <a href="{{ route('pembeli.cek_status_form') }}" class="mobile-link hover:text-amber-600 transition py-1">Cek Status</a>
        <a href="{{ route('profile.edit') }}" class="mobile-link hover:text-amber-600 transition py-1">Profil</a>
        <a href="https://wa.me/6287773382283" target="_blank" class="mobile-link hover:text-amber-600 transition py-1">WhatsApp</a>
        
        <!-- Tombol Logout Khusus HP -->
        <form method="POST" action="{{ route('logout') }}" class="w-full pt-2 border-t border-gray-100">
            @csrf
            <button type="submit" class="w-full text-center px-4 py-2.5 bg-red-600 text-white rounded-full hover:bg-red-700 transition text-xs shadow-md font-bold">
                <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
            </button>
        </form>
    </div>
</nav>
<div class="h-20"></div>

<!-- LOGIKA JAVASCRIPT BUKA-TUTUP NAV MENU DI HP -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    });
</script>