<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased">

    @include('layouts.nav-pembeli')

    <section class="relative h-screen flex items-center justify-end overflow-hidden -mt-20">
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('images/home-pembeli.jpeg') }}" class="w-full h-full object-cover brightness-[0.4]" alt="Hero Pembeli">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 text-right text-white w-full">
            <p class="text-amber-400 font-bold tracking-widest uppercase text-xs md:text-sm mb-3 drop-shadow">
                <i class="fa-solid fa-mug-hot mr-1"></i> Selamat Datang Kembali
            </p>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 drop-shadow-2xl tracking-tight leading-tight">
                Welcome to Wasana Coffee,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-amber-400 to-amber-200 font-black block mt-3 drop-shadow-md">
                    {{ Auth::user()->nama }} 
                </span>
            </h1>
            <p class="text-sm md:text-lg font-light max-w-md ml-auto drop-shadow-md text-amber-100/90 italic border-r-4 border-amber-500 pr-4">
                "Siap mencicipi vibes Kintamani dalam tiap seduhan? Silakan jelajahi menu eksklusif Anda di bawah."
            </p>
            
            <div class="mt-12 text-amber-400/60 animate-bounce text-xs font-mono tracking-widest hidden md:block">
                SCROLL KE BAWAH UNTUK MENU <i class="fa-solid fa-arrow-down ml-1"></i>
            </div>
        </div>
    </section>

    <section id="produk" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-amber-950">
            <h2 class="text-3xl font-bold mb-12 text-center relative inline-block w-full">
                Produk Kami
                <div class="h-1 w-16 bg-amber-600 mx-auto mt-2 rounded-full"></div>
            </h2>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-amber-50 transform -rotate-1 transition hover:rotate-0 duration-300">
                    <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=2070" alt="Produk Premium Wasana" class="w-full h-[350px] object-cover">
                </div>
                
                <div class="space-y-6">
                    <h3 class="text-3xl font-bold text-amber-900">Eksplorasi Rasa Biji Kopi Nusantara</h3>
                    <p class="text-base text-gray-600 leading-relaxed">
                        Halo <strong>{{ Auth::user()->nama }}</strong>, khusus untuk Anda, kami menyajikan varian biji kopi pilihan bergaya premium yang dipetik langsung oleh petani mitra Wasana. Diproses secara higienis melalui teknik *roasting* modern untuk mengunci keaslian cita rasa buah kopi lokal, menghasilkan keseimbangan rasa manis alami, keasaman yang lembut, dan aroma cokelat pekat yang memikat.
                    </p>
                    
                    <div class="pt-2">
                        <a href="{{ route('pembeli.varian') }}" class="inline-block bg-amber-800 text-white px-8 py-3.5 rounded-xl font-bold text-base hover:bg-amber-900 transition-all transform hover:scale-[1.02] shadow-lg">
                        Pesan Sekarang <i class="fa-solid fa-cart-shopping ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#faf3e0]/60 border-t border-amber-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-amber-950 mb-4 text-center">Promosi dan Informasi</h2>
            <p class="text-center text-gray-500 text-sm mb-12 max-w-md mx-auto">Info promo eksklusif, diskon spesial, dan kabar terbaru dari jagat kopi Wasana khusus untuk Anda.</p>
            
            <div class="grid md:grid-cols-2 gap-8">
                
                <div class="bg-gradient-to-br from-amber-900 to-amber-950 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden flex flex-col justify-between h-64">
                    <div class="absolute top-[-20%] right-[-10%] w-40 h-40 bg-amber-700/20 rounded-full blur-2xl"></div>
                    <div>
                        <span class="bg-amber-500 text-amber-950 font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wider">PROMO BULAN INI</span>
                        <h4 class="text-2xl font-bold mt-4 tracking-tight">Diskon 20% Pengguna Baru Wasana!</h4>
                        <p class="text-amber-100/80 text-sm mt-2 max-w-sm">Nikmati potongan harga langsung tanpa minimum pembelian untuk transaksi pertama Anda di website.</p>
                    </div>
                    <div class="text-xs text-amber-400/80 font-mono tracking-wide">Kode Kupon: <span class="bg-amber-800/80 px-2 py-1 rounded border border-amber-700 text-amber-300 font-bold">WASANEW26</span></div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-amber-100 shadow-lg flex flex-col justify-between h-64">
                    <div>
                        <span class="bg-amber-100 text-amber-800 font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wider">INFO KEDAI</span>
                        <h4 class="text-2xl font-bold mt-4 text-amber-900 tracking-tight">Varian Kopi Luwak Baru Telah Hadir!</h4>
                        <p class="text-gray-500 text-sm mt-2">Mulai minggu ini, varian premium Luwak Gayo liar resmi dapat dipesan melalui dashboard pembeli Anda secara eksklusif.</p>
                    </div>
                    <div class="text-xs text-amber-800 font-bold flex items-center gap-1">
                        <i class="fa-solid fa-circle-info"></i> Stok terbatas tiap harinya
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="py-12 text-center text-gray-500 text-sm bg-white border-t border-amber-50">
        © 2026 Wasana Coffee 
    </footer>

</body>
</html>