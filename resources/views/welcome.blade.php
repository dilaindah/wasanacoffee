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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-2xl font-bold text-amber-900 tracking-tighter">WASANA<span class="text-amber-600">COFFEE</span></span>
                </div>
                <div class="hidden md:flex space-x-8 items-center text-sm font-semibold text-amber-900">
                    <a href="#produk" class="hover:text-amber-600 transition">Beli Kopi</a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-amber-600 transition">WhatsApp</a>
                    @auth
                        <a href="{{ url('/home') }}" class="px-5 py-2 bg-amber-800 text-white rounded-full">Akun Saya</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-amber-600 transition">Login</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-amber-800 text-white rounded-full hover:bg-amber-900 transition shadow-md">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="relative h-screen flex items-center justify-end overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070" class="w-full h-full object-cover brightness-[0.5]" alt="Background Wasana Coffee">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-right text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-4 drop-shadow-lg">Welcome to<br>Wasana Coffee</h1>
            <p class="text-xl md:text-2xl font-light italic max-w-xl ml-auto drop-shadow-md text-amber-100">
                "Satu Sesapan, Berjuta Cerita. Temukan keajaiban biji kopi nusantara yang diproses dengan penuh cinta."
            </p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center text-amber-950">
            <h2 class="text-3xl font-bold mb-6 relative inline-block">
                Tentang Kami
                <div class="h-1 w-12 bg-amber-600 mx-auto mt-2"></div>
            </h2>
            <p class="text-lg leading-relaxed text-gray-600">
                Wasana Coffee lahir dari impian untuk menyajikan kopi berkualitas tinggi langsung ke tangan penikmatnya. Bermula dari kedai kecil, kami menjaga tradisi menyangrai biji kopi secara mandiri demi konsistensi rasa yang tak terlupakan. Kami percaya, kopi terbaik adalah kopi yang jujur pada asalnya.
            </p>
        </div>
    </section>

    <section id="produk" class="py-24 bg-[#faf3e0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-amber-950">
            <h2 class="text-3xl font-bold mb-12 text-center">Produk Kami</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white transform -rotate-2">
                    <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=2070" alt="Produk Wasana" class="w-full">
                </div>
                <div class="space-y-6">
                    <h3 class="text-4xl font-bold text-amber-900">Cita Rasa Kopi Wasana</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Biji kopi pilihan yang disangrai dengan presisi untuk menghasilkan aroma yang memikat dan body yang bold. Kami memastikan setiap kemasan yang sampai ke tangan Anda membawa kesegaran maksimal langsung dari hasil kebun petani lokal pilihan.
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

    <section class="py-24 bg-[#faf3e0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-16 text-center text-amber-950">Review Pelanggan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="bg-amber-800 p-10 rounded-[40px] text-center border border-amber-900/20 shadow-2xl transition hover:shadow-amber-900/20 hover:scale-105 transform">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white/30 shadow-lg">
                    <div class="flex justify-center gap-1 mb-4 text-amber-300 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-2 tracking-tight">Budi Santoso</h4>
                    <p class="text-amber-50/90 italic leading-relaxed">"Kopinya beneran fresh, aromanya kuat banget pas baru diseduh. Favorit saya yang varian 250g!"</p>
                </div>

                <div class="bg-amber-800 p-10 rounded-[40px] text-center border border-amber-900/20 shadow-2xl transition hover:shadow-amber-900/20 hover:scale-105 transform">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white/30 shadow-lg">
                    <div class="flex justify-center gap-1 mb-4 text-amber-300 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-2 tracking-tight">Siti Aminah</h4>
                    <p class="text-amber-50/90 italic leading-relaxed">"Suka banget sama tempatnya, kopinya nikmat dan pelayanannya ramah. Sukses terus Wasana Coffee!"</p>
                </div>

                <div class="bg-amber-800 p-10 rounded-[40px] text-center border border-amber-900/20 shadow-2xl transition hover:shadow-amber-900/20 hover:scale-105 transform">
                    <img src="https://randomuser.me/api/portraits/men/85.jpg" class="w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white/30 shadow-lg">
                    <div class="flex justify-center gap-1 mb-4 text-amber-300 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-2 tracking-tight">Andi Pratama</h4>
                    <p class="text-amber-50/90 italic leading-relaxed">"Pesan lewat website gampang banget, tinggal register terus checkout. Gak pake ribet dan cepat sampai."</p>
                </div>

            </div>
        </div>
    </section>


    <section class="py-24 bg-[#faf3e0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-12 text-center text-amber-950">Lokasi & Tempat</h2>
            <div class="bg-white rounded-[40px] overflow-hidden shadow-2xl flex flex-col md:flex-row border border-amber-100">
                <div class="md:w-1/3 p-12 bg-amber-900 text-amber-50 flex flex-col justify-center">
                    <div class="mb-8">
                        <h4 class="font-bold text-xl mb-2 text-amber-400"><i class="fa-solid fa-map-pin mr-2"></i> Alamat:</h4>
                        <p class="text-amber-100/90">Jl. Raya Wasana No. 123, Kabupaten Malang, Jawa Timur</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-2 text-amber-400"><i class="fa-solid fa-clock mr-2"></i> Jam Operasional:</h4>
                        <p class="text-amber-100/90">Setiap Hari<br>08.00 - 22.00 WIB</p>
                    </div>
                </div>
                <div class="md:w-2/3 h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.213123456789!2d112.5712345678901!3d-7.971234567890123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTgnMTYuNSJTIDExMsKwMzQnMTYuNCJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 text-center text-gray-500 text-sm bg-white border-t border-amber-50">
        © 2026 Wasana Coffee 
    </footer>

</body>
</html>