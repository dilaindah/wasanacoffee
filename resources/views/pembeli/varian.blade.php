<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Varian Ukuran - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased">

    @include('layouts.nav-pembeli')

    <div class="max-w-2xl mx-auto px-4 py-10">
        
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-amber-800 text-sm font-bold hover:underline">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <h2 class="text-3xl font-black text-amber-950 mb-2 tracking-tight">Ukuran Kopi</h2>
        <p class="text-gray-500 text-sm mb-8">Pilih varian berat bubuk kopi Wasana dan tentukan jumlah pesanan Anda.</p>

        @if (session('error'))
            <div class="mb-4 text-sm text-red-600 bg-red-50 p-4 rounded-2xl border border-red-200 font-bold">
                <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('pembeli.proses_pesanan') }}" class="space-y-6">
            @csrf

            <div class="bg-white rounded-3xl p-6 shadow-xl border border-amber-100 flex items-center justify-between transition hover:border-amber-400 {{ $produk_100g->stok == 0 ? 'opacity-60 bg-gray-50' : '' }}">
                <div>
                    <h3 class="text-xl font-bold text-amber-900 flex items-center gap-2">
                        100 Gram <span class="text-xs bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full font-bold"></span>
                    </h3>
                    <p class="text-sm mt-1 {{ $produk_100g->stok > 0 ? 'text-green-600 font-semibold' : 'text-red-600 font-bold' }}">
                        Status Stok = {{ $produk_100g->stok > 0 ? $produk_100g->stok . ' Pcs' : 'Habis Total' }}
                    </p>
                </div>
                
                <div class="text-right space-y-3">
                    <span class="text-xl font-black text-amber-950 block">Rp {{ number_format($produk_100g->harga, 0, ',', '.') }}</span>
                    
                    <div class="flex items-center justify-end">
                        <button type="button" onclick="kurangQty('100g')" class="w-8 h-8 rounded-l-lg bg-amber-100 hover:bg-amber-200 text-amber-900 font-bold transition flex items-center justify-center" {{ $produk_100g->stok == 0 ? 'disabled' : '' }}>-</button>
                        <input type="number" id="qty_100g" name="qty_100g" value="0" min="0" max="{{ $produk_100g->stok }}" oninput="hitungTotal()"
                            class="w-14 h-8 text-center border-y border-amber-100 text-sm font-bold bg-white focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" {{ $produk_100g->stok == 0 ? 'disabled' : '' }}>
                        <button type="button" onclick="tambahQty('100g')" class="w-8 h-8 rounded-r-lg bg-amber-100 hover:bg-amber-200 text-amber-900 font-bold transition flex items-center justify-center" {{ $produk_100g->stok == 0 ? 'disabled' : '' }}>+</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border border-amber-100 flex items-center justify-between transition hover:border-amber-400 {{ $produk_250g->stok == 0 ? 'opacity-60 bg-gray-50' : '' }}">
                <div>
                    <h3 class="text-xl font-bold text-amber-900 flex items-center gap-2">
                        250 Gram <span class="text-xs bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full font-bold"></span>
                    </h3>
                    <p class="text-sm mt-1 {{ $produk_250g->stok > 0 ? 'text-green-600 font-semibold' : 'text-red-600 font-bold' }}">
                        Status Stok = {{ $produk_250g->stok > 0 ? $produk_250g->stok . ' Pcs' : 'Habis Total' }}
                    </p>
                </div>
                
                <div class="text-right space-y-3">
                    <span class="text-xl font-black text-amber-950 block">Rp {{ number_format($produk_250g->harga, 0, ',', '.') }}</span>
                    
                    <div class="flex items-center justify-end">
                        <button type="button" onclick="kurangQty('250g')" class="w-8 h-8 rounded-l-lg bg-amber-100 hover:bg-amber-200 text-amber-900 font-bold transition flex items-center justify-center" {{ $produk_250g->stok == 0 ? 'disabled' : '' }}>-</button>
                        <input type="number" id="qty_250g" name="qty_250g" value="0" min="0" max="{{ $produk_250g->stok }}" oninput="hitungTotal()"
                            class="w-14 h-8 text-center border-y border-amber-100 text-sm font-bold bg-white focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" {{ $produk_250g->stok == 0 ? 'disabled' : '' }}>
                        <button type="button" onclick="tambahQty('250g')" class="w-8 h-8 rounded-r-lg bg-amber-100 hover:bg-amber-200 text-amber-900 font-bold transition flex items-center justify-center" {{ $produk_250g->stok == 0 ? 'disabled' : '' }}>+</button>
                    </div>
                </div>
            </div>

            <div class="bg-amber-900 rounded-3xl p-6 text-white shadow-xl flex items-center justify-between sticky bottom-4 mt-10">
                <div>
                    <p class="text-xs text-amber-300 font-bold uppercase tracking-wider">Total Pembayaran Anda</p>
                    <span id="display_total" class="text-3xl font-black tracking-tight">Rp 0</span>
                </div>
                <button type="submit" class="bg-white hover:bg-amber-50 text-amber-950 font-black px-8 py-4 rounded-xl text-sm transition transform active:scale-95 shadow-md flex items-center gap-2">
                    Beli Sekarang <i class="fa-solid fa-bag-shopping"></i>
                </button>
            </div>

        </form>
    </div>

    <script>
        const harga100g = {{ $produk_100g->harga }};
        const harga250g = {{ $produk_250g->harga }};
        const maksStok100g = {{ $produk_100g->stok }};
        const maksStok250g = {{ $produk_250g->stok }};

        function tambahQty(varian) {
            let input = document.getElementById('qty_' + varian);
            let maks = varian === '100g' ? maksStok100g : maksStok250g;
            let nilaiSekarang = parseInt(input.value) || 0;
            
            if (nilaiSekarang < maks) {
                input.value = nilaiSekarang + 1;
                hitungTotal();
            }
        }

        function kurangQty(varian) {
            let input = document.getElementById('qty_' + varian);
            let nilaiSekarang = parseInt(input.value) || 0;
            
            if (nilaiSekarang > 0) {
                input.value = nilaiSekarang - 1;
                hitungTotal();
            }
        }

        function hitungTotal() {
            let input100g = document.getElementById('qty_100g');
            let input250g = document.getElementById('qty_250g');

            let qty100g = parseInt(input100g.value) || 0;
            let qty250g = parseInt(input250g.value) || 0;

            if (qty100g < 0) { qty100g = 0; input100g.value = 0; }
            if (qty250g < 0) { qty250g = 0; input250g.value = 0; }

            if (qty100g > maksStok100g) { qty100g = maksStok100g; input100g.value = maksStok100g; }
            if (qty250g > maksStok250g) { qty250g = maksStok250g; input250g.value = maksStok250g; }

            let grandTotal = (qty100g * harga100g) + (qty250g * harga250g);
            document.getElementById('display_total').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
        }
    </script>

</body>
</html>