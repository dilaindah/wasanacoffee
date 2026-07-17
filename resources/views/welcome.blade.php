<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wasana Coffee - Rasakan Keasliannya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased">

   <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-sm border-b border-amber-100">
    <div class="w-full px-6 sm:px-12">
        <div class="flex justify-between h-20 items-center">
            
            <!-- BAGIAN LOGO & TULISAN -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center gap-3">
                    <!-- Logo Gambar -->
                    <img src="{{ asset('images/logo-wasana-coffee.jpeg') }}" 
                         alt="Logo Wasana Coffee" 
                         class="h-12 w-auto object-contain rounded-xl p-0.5 bg-amber-50/50 shadow-sm border border-amber-100">
                    
                    <!-- Tulisan Wasana Coffee -->
                    <span class="text-2xl font-bold text-amber-900 tracking-tighter">WASANA<span class="text-amber-600">COFFEE</span></span>
                </a>
            </div>
            
            <!-- 1. MENU UNTUK TAMPILAN LAPTOP (Dekstop Menu) -->
            <div class="hidden md:flex space-x-8 items-center text-sm font-semibold text-amber-900">
                <a href="#produk" class="hover:text-amber-600 transition">Beli Kopi</a>
                <a href="https://wa.me/6287773382283" target="_blank" class="hover:text-amber-600 transition">WhatsApp</a>
                @auth
                    <a href="{{ url('/home') }}" class="px-5 py-2 bg-amber-800 text-white rounded-full">Akun Saya</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-amber-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-amber-800 text-white rounded-full hover:bg-amber-800 transition shadow-md">Register</a>
                @endauth
            </div>

            <!-- 2. TOMBOL HAMBURGER (Muncul Hanya di HP / Android) -->
            <div class="flex items-center md:hidden">
                <button id="hamburger-btn" class="text-amber-900 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- 3. DROPDOWN MENU UNTUK HP (Otomatis Sembunyi, Muncul Saat Di-klik) -->
    <div id="mobile-menu" class="hidden absolute top-20 left-0 w-full bg-white/95 backdrop-blur-md shadow-lg border-t border-amber-100 p-6 flex flex-col space-y-4 text-sm font-semibold text-amber-900 z-50 md:hidden">
        <a href="#produk" class="mobile-link hover:text-amber-600 transition py-1">Beli Kopi</a>
        <a href="https://wa.me/6287773382283" target="_blank" class="mobile-link hover:text-amber-600 transition py-1">WhatsApp</a>
        @auth
            <a href="{{ url('/home') }}" class="mobile-link text-center px-5 py-2 bg-amber-800 text-white rounded-full">Akun Saya</a>
        @else
            <a href="{{ route('login') }}" class="mobile-link hover:text-amber-600 transition py-1">Login</a>
            <a href="{{ route('register') }}" class="mobile-link text-center px-5 py-2 bg-amber-800 text-white rounded-full hover:bg-amber-900 transition shadow-md">Register</a>
        @endauth
    </div>
</nav>

    <!-- HERO SECTION -->
    <section class="relative h-screen flex items-center justify-end overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-section.png') }}" class="w-full h-full object-cover brightness-[0.45] blur-[4px]" alt="Background Wasana Coffee">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-right text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-4 drop-shadow-lg">Welcome to<br>Wasana Coffee</h1>
            <p class="text-xl md:text-2xl font-light italic max-w-xl ml-auto drop-shadow-md text-amber-100">
                "Satu Sesapan, Berjuta Cerita. Nikmati keaslian cita rasa premium Arabika Kintamani Bali yang diproses dengan dedikasi nyata. Komitmen kualitas terbaik di setiap cangkir Anda, karena <span class="text-amber-300 font-bold not-italic">Wasana bukan wacana</span>."
            </p>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center text-amber-950">
            <h2 class="text-3xl font-bold mb-6 relative inline-block">
                Tentang Kami
                <div class="h-1 w-12 bg-amber-600 mx-auto mt-2"></div>
            </h2>
            <p class="text-lg leading-relaxed text-gray-600">
                Wasana Coffee merupakan UMKM produsen kopi bubuk premium yang berdedikasi menyajikan cita rasa asli Bali langsung ke tangan Anda. Berlokasi di Batubulan, Gianyar, Bali, kami mengolah biji kopi pilihan terbaik, khususnya Kopi Arabika Kintamani melalui proses higienis hingga menjadi bubuk kopi berkualitas tinggi yang siap dinikmati.
            </p>
        </div>
    </section>

    <!-- PRODUK KAMI -->
    <section id="produk" class="py-24 bg-[#faf3e0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-amber-950">
            <h2 class="text-3xl font-bold mb-12 text-center">Produk Kami</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white transform -rotate-2 -translate-x-16 max-w-sm ml-auto">
                    <img src="{{ asset('images/foto-produk.png') }}" alt="Produk Wasana" class="w-full object-cover aspect-[4/3]">
                </div>
                <div class="space-y-6">
                    <h3 class="text-4xl font-bold text-amber-900">Cita Rasa Premium Arabika Kintamani</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Wasana Coffee diproses secara higienis hingga menjadi bubuk kopi berkualitas tinggi dengan aroma yang memikat dan karakter rasa yang khas.
                        <br><br>
                        Kami menghadirkan dua varian ukuran utama, yaitu 100g dan 250g, untuk memenuhi kebutuhan seduhan harian Anda dengan jaminan kesegaran maksimal langsung ke tangan penikmat kopi lokal.
                    </p>
                    @auth
                        <a href="{{ route('home') }}" class="inline-block bg-amber-800 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-amber-900 transition-all transform hover:scale-105 shadow-xl">
                            Pesan Sekarang <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-block bg-amber-800 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-amber-900 transition-all transform hover:scale-105 shadow-xl">
                            Pesan Sekarang <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- REVIEW PELANGGAN -->
    <section class="py-24 bg-[#faf3e0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-16 text-center text-amber-950">Review Pelanggan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="bg-amber-800 p-10 rounded-[40px] text-center border border-amber-900/20 shadow-2xl transition hover:shadow-amber-900/20 hover:scale-105 transform">
                    <img src="{{ asset('images/afik.jpeg') }}" class="w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white/30 shadow-lg" alt="Reviewer">
                    <div class="flex justify-center gap-1 mb-4 text-amber-300 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-2 tracking-tight">Afik</h4>
                    <p class="text-amber-50/90 italic leading-relaxed">"Bubuk kopinya beneran fresh, aroma khas Arabika Kintamani langsung terasa kuat begitu kemasannya dibuka. Varian bubuk kopi yang 250g pas banget buat stok ngopi di rumah!"</p>
                </div>

                <div class="bg-amber-800 p-10 rounded-[40px] text-center border border-amber-900/20 shadow-2xl transition hover:shadow-amber-900/20 hover:scale-105 transform">
                    <img src="{{ asset('images/sintya.jpeg') }}" class="w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white/30 shadow-lg" alt="Reviewer">
                    <div class="flex justify-center gap-1 mb-4 text-amber-300 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-2 tracking-tight">Sintya Maharani</h4>
                    <p class="text-amber-50/90 italic leading-relaxed">"Suka banget sama kualitas produknya! Hasil gilingan bubuk kopinya halus, kualitasnya premium, dan segel kemasannya rapi banget sehingga aromanya tetap terjaga. Sukses terus untuk Wasana Coffee di Gianyar!"</p>
                </div>

                <div class="bg-amber-800 p-10 rounded-[40px] text-center border border-amber-900/20 shadow-2xl transition hover:shadow-amber-900/20 hover:scale-105 transform">
                    <img src="{{ asset('images/erina.jpeg') }}" class="w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white/30 shadow-lg" alt="Reviewer">
                    <div class="flex justify-center gap-1 mb-4 text-amber-300 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-2 tracking-tight">Erina Cipta</h4>
                    <p class="text-amber-50/90 italic leading-relaxed">"Kopi bubuk lokal terbaik yang pernah saya coba! Ukuran kemasan 100g nya pas banget buat dibawa ke kantor, praktis dan aromanya tetep awet."</p>
                </div>

            </div>
        </div>
    </section>

    <!-- LOKASI & TEMPAT -->
    <section class="py-24 bg-[#faf3e0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-12 text-center text-amber-950">Lokasi & Tempat</h2>
            <div class="bg-white rounded-[40px] overflow-hidden shadow-2xl flex flex-col md:flex-row border border-amber-100">
                <div class="md:w-1/3 p-12 bg-amber-900 text-amber-50 flex flex-col justify-center">
                    <div class="mb-8">
                        <h4 class="font-bold text-xl mb-2 text-amber-400"><i class="fa-solid fa-map-pin mr-2"></i> Alamat:</h4>
                        <p class="text-amber-100/90">Peruma Sasih Asri Blk. II B No.2, Batubulan, Kec. Sukawati, Kabupaten Gianyar, Bali 80237</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-2 text-amber-400"><i class="fa-solid fa-clock mr-2"></i> Jam Operasional:</h4>
                        <p class="text-amber-100/90">Senin - Jumat<br>08.00 - 18.00 WIB</p>
                    </div>
                </div>
                <div class="md:w-2/3 h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5814642500045!2d115.26475881084839!3d-8.636116087770251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23fee1fa2d679%3A0x9da6342f2e5b2c1e!2sPeruma%20Sasih%20Asri%20Blk.%20II%20B%20No.2%2C%20Batubulan%2C%20Kec.%20Sukawati%2C%20Kabupaten%20Gianyar%2C%20Bali%2080237!5e0!3m2!1sid!2sid!4v1784244531788!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-12 text-center text-gray-500 text-sm bg-white border-t border-amber-50">
        © 2026 Wasana Coffee 
    </footer>

    <!-- LOGIKA JAVASCRIPT BUKA-TUTUP NAV MENU DI HP -->
    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        // Toggle menu saat tombol hamburger di-klik
        hamburgerBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Otomatis menutup menu kembali setelah user memilih salah satu link menu
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>

</body>
</html>