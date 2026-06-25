<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="max-w-2xl w-full bg-white rounded-[32px] p-6 md:p-10 shadow-2xl border border-amber-100">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-amber-950 tracking-tight">Pesanan Berhasil Dibuat!</h2>
            <p class="text-gray-500 text-xs md:text-sm mt-1">Silakan lakukan pembayaran manual agar pesanan segera diproses admin.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            
            <div class="bg-amber-50/50 p-5 rounded-2xl border border-amber-100 space-y-3.5">
                <div class="flex justify-between items-center text-xs pb-2 border-b border-amber-100/60">
                    <span class="text-gray-500 font-medium">KODE PESANAN:</span>
                    <div class="flex items-center gap-1.5">
                        <span id="kode_pesanan" class="font-mono font-bold text-amber-900 tracking-wider bg-amber-100/50 px-2 py-0.5 rounded">{{ $pesanan->kode_pesanan }}</span>
                        <button onclick="salinTeks('kode_pesanan', this)" class="text-amber-700 hover:text-amber-950 transition p-1" title="Salin Kode Pesanan">
                            <i class="fa-regular fa-copy"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex flex-col gap-2 text-xs">
                    <span class="text-gray-500 font-medium">Rincian Item:</span>
                    @foreach($detail as $item)
                        <div class="flex justify-between text-gray-700 font-semibold pl-2">
                            <span>• Varian {{ $item->id_produk == 1 ? '100g' : '250g' }} <span class="text-amber-800">(x{{ $item->qty }})</span></span>
                            <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-center text-sm border-t border-amber-100/60 pt-3 mt-2">
                    <span class="text-amber-950 font-bold">TOTAL TAGIHAN:</span>
                    <span class="text-xl font-black text-amber-900">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="space-y-5">
                <div class="bg-white p-5 rounded-2xl border-2 border-dashed border-amber-200">
                    <h4 class="text-xs font-bold text-amber-950 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-credit-card text-amber-800"></i> Rekening Pembayaran:
                    </h4>
                    <div class="space-y-2 text-xs md:text-sm text-gray-700">
                        <p><strong>Bank:</strong> Bank Central Asia (BCA)</p>
                        <div class="flex items-center justify-between">
                            <p><strong>No. Rek:</strong> <span id="no_rek" class="bg-amber-100 px-2 py-0.5 rounded font-mono font-bold text-amber-950 tracking-wide">123-4567-890</span></p>
                            <button onclick="salinTeks('no_rek', this)" class="text-amber-700 hover:text-amber-950 transition mr-1" title="Salin No Rekening">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                        <p><strong>A.N:</strong> Wasana Coffee Management</p>
                    </div>
                </div>

                <div>
                    <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full bg-amber-800 hover:bg-amber-900 text-white font-bold py-3.5 rounded-xl text-sm transition-all shadow-md transform active:scale-95">
                        Kembali ke Home Pembeli <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-8 bg-orange-50 border-2 border-orange-200 rounded-2xl p-4 flex items-start gap-3 shadow-sm">
            <div class="text-orange-600 text-lg mt-0.5 animate-bounce">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="text-xs md:text-sm text-amber-950 leading-relaxed">
                <strong class="text-orange-700 font-black block uppercase tracking-wide mb-1 text-xs"><i class="fa-solid fa-circle-exclamation"></i> PENTING SEBELUM TRANSFER:</strong>
                Mohon wajib menyertakan <span class="bg-orange-200 text-orange-950 px-1.5 py-0.5 rounded font-black font-mono">KODE PESANAN</span> di dalam <strong>kolom berita/catatan transfer</strong> Anda.
            </div>
        </div>

    </div>

    <script>
        function salinTeks(idElemen, tombol) {
            // Ambil text dari elemen berdasarkan ID
            let teks = document.getElementById(idElemen).innerText;

            // Logika menyalin data teks ke clipboard internal sistem device
            navigator.clipboard.writeText(teks).then(() => {
                // Mengubah ikon menjadi tanda centang hijau tanda berhasil
                let ikonAsli = tombol.innerHTML;
                tombol.innerHTML = '<i class="fa-solid fa-check text-green-600 animate-scale"></i>';
                tombol.disabled = true;

                // Kembalikan ikon semula setelah 2 detik biar bisa dicopy ulang kalau mau
                setTimeout(() => {
                    tombol.innerHTML = ikonAsli;
                    tombol.disabled = false;
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
            });
        }
    </script>

</body>
</html>