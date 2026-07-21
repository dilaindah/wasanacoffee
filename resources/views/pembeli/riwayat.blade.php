<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased">

    @include('layouts.nav-pembeli')

    <div class="max-w-5xl mx-auto px-4 py-10">
        
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-amber-800 text-sm font-bold hover:underline">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <h2 class="text-3xl font-black text-amber-950 mb-2 tracking-tight">Riwayat Pesanan Anda</h2>
        <p class="text-gray-500 text-sm mb-8">Pantau status pembayaran dan proses pengiriman kopi Wasana Anda di sini.</p>

        @if($daftar_pesanan->isEmpty())
            <div class="bg-white rounded-[32px] p-12 text-center shadow-xl border border-amber-100 max-w-md mx-auto">
                <div class="w-16 h-16 bg-amber-50 text-amber-800 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <h3 class="text-lg font-bold text-amber-950">Belum Ada Pesanan</h3>
                <p class="text-gray-400 text-xs mt-1 mb-6">Anda belum pernah memesan kopi nih. Yuk pilih varian kopi terbaikmu sekarang!</p>
                <a href="{{ route('pembeli.varian') }}" class="inline-block bg-amber-800 hover:bg-amber-900 text-white font-bold px-6 py-3 rounded-xl text-xs transition-all shadow-md">
                    Pesan Kopi Pertama <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
        @else
            <div class="bg-white rounded-[32px] shadow-xl border border-amber-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-amber-800 text-amber-100 text-xs uppercase tracking-wider font-bold">
                                <th class="py-4 px-6">Tanggal</th>
                                <th class="py-4 px-6">Kode Pesanan</th>
                                <th class="py-4 px-6">Varian & Jumlah (Qty)</th>
                                <th class="py-4 px-6">Total Harga</th>
                                <th class="py-4 px-6 text-center">Status / Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-50 text-sm font-medium text-gray-700">
                            @foreach($daftar_pesanan as $pesanan)
                                <tr class="hover:bg-amber-50/40 transition">
                                    <td class="py-4 px-6 whitespace-nowrap text-gray-400 text-xs">
                                        {{ date('d M Y, H:i', strtotime($pesanan->created_at)) }}
                                    </td>
                                    
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono font-bold text-amber-900 tracking-wide">{{ $pesanan->kode_pesanan }}</span>
                                            
                                            <button onclick="salinKodePesanan('{{ $pesanan->kode_pesanan }}', this)" 
                                                    title="Salin Kode Pesanan"
                                                    class="inline-flex items-center justify-center w-7 h-7 bg-amber-50 hover:bg-amber-800 text-amber-800 hover:text-white rounded-lg transition-all active:scale-90 border border-amber-200/60 shadow-sm group">
                                                <i class="fa-regular fa-copy text-xs group-hover:scale-110 transition-transform"></i>
                                            </button>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6 text-amber-950">
                                        {{ $pesanan->rincian_varian }}
                                    </td>
                                    
                                    <td class="py-4 px-6 font-bold text-gray-900">
                                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($pesanan->status_pesanan == 'menunggu')
                                            <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                                                <span class="bg-amber-100 text-amber-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-amber-200">
                                                    <i class="fa-regular fa-clock mr-1"></i> Menunggu
                                                </span>
                                                {{-- Tombol interaktif pembantu informasi rekening --}}
                                                <button onclick="toggleRekening('rek-{{ $pesanan->kode_pesanan }}')" class="bg-amber-800 hover:bg-amber-900 text-white text-[10px] font-black px-2.5 py-1 rounded-lg transition transform active:scale-95 shadow-sm flex items-center gap-1">
                                                    <i class="fa-solid fa-credit-card"></i> Bayar
                                                </button>
                                            </div>
                                        @elseif($pesanan->status_pesanan == 'diproses')
                                            <span class="bg-blue-100 text-blue-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-blue-200">
                                                <i class="fa-solid fa-spinner fa-spin mr-1"></i> Diproses
                                            </span>
                                        @elseif($pesanan->status_pesanan == 'dikirim')
                                            <span class="bg-indigo-100 text-indigo-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-indigo-200">
                                                <i class="fa-solid fa-truck-fast mr-1"></i> Dikirim
                                            </span>
                                        @elseif($pesanan->status_pesanan == 'dibatalkan')
                                            <span class="bg-red-100 text-red-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-red-200">
                                                <i class="fa-solid fa-circle-xmark mr-1"></i> Dibatalkan
                                            </span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-green-200">
                                                <i class="fa-solid fa-circle-check mr-1"></i> Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                {{-- 🔥 REVISI LOGIS: Baris tambahan informasi rekening, muncul otomatis jika status 'menunggu' --}}
                                @if($pesanan->status_pesanan == 'menunggu')
                                    <tr id="rek-{{ $pesanan->kode_pesanan }}" class="bg-amber-50/50">
                                        <td colspan="5" class="py-3 px-6 border-t border-amber-100/70">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white border border-amber-200 p-4 rounded-2xl shadow-sm">
                                                <div class="flex items-start gap-3">
                                                    <div class="w-8 h-8 bg-amber-100 text-amber-900 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                                        <i class="fa-solid fa-building-columns text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-xs font-black text-amber-950 uppercase tracking-wide">Info Rekening Pembayaran Wasana</h4>
                                                        <p class="text-[11px] text-gray-500 mt-0.5 leading-relaxed">
                                                            Silakan transfer tepat senilai <strong class="text-amber-900">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong> ke rekening berikut:
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex flex-wrap items-center gap-4 bg-amber-50/40 border border-amber-100 px-4 py-2 rounded-xl">
                                                    <div class="text-xs">
                                                        <span class="text-[9px] text-gray-400 block font-bold uppercase tracking-wider">BANK BCA</span>
                                                        <span class="font-mono font-black text-amber-950 tracking-wide text-sm">8420 1234 56</span>
                                                        <span class="text-[10px] text-gray-400 block font-medium">a.n Wasana Coffee Official</span>
                                                    </div>
                                                    <button onclick="salinNomorRekening('8420123456', this)" 
                                                            class="bg-amber-100 hover:bg-amber-800 text-amber-900 hover:text-white font-bold text-xs px-3 py-2 rounded-lg transition-all active:scale-95 flex items-center gap-1">
                                                        <i class="fa-regular fa-copy"></i> Salin Rek
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

    <script>
        // Fungsi menyalin Kode Pesanan
        function salinKodePesanan(kode, elemenTombol) {
            navigator.clipboard.writeText(kode).then(() => {
                const ikonLama = elemenTombol.innerHTML;
                elemenTombol.innerHTML = '<i class="fa-solid fa-check text-xs"></i>';
                elemenTombol.classList.remove('bg-amber-50', 'text-amber-800', 'border-amber-200/60');
                elemenTombol.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600');
                
                setTimeout(() => {
                    elemenTombol.innerHTML = ikonLama;
                    elemenTombol.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600');
                    elemenTombol.classList.add('bg-amber-50', 'text-amber-800', 'border-amber-200/60');
                }, 1500);
            }).catch(err => {
                alert('Gagal menyalin kode, coba blok manual ya dek.');
            });
        }

        // 🔥 REVISI JAVASCRIPT: Fungsi menyalin Nomor Rekening Bank
        function salinNomorRekening(noRek, elemenTombol) {
            navigator.clipboard.writeText(noRek).then(() => {
                const teksLama = elemenTombol.innerHTML;
                elemenTombol.innerHTML = '<i class="fa-solid fa-circle-check"></i> Berhasil';
                elemenTombol.classList.remove('bg-amber-100', 'text-amber-900');
                elemenTombol.classList.add('bg-emerald-600', 'text-white');
                
                setTimeout(() => {
                    elemenTombol.innerHTML = teksLama;
                    elemenTombol.classList.remove('bg-emerald-600', 'text-white');
                    elemenTombol.classList.add('bg-amber-100', 'text-amber-900');
                }, 1500);
            });
        }

        // Fungsi buka-tutup (Toggle) sub-row info rekening jika ingin disembunyikan pembeli
        function toggleRekening(idElement) {
            const elemen = document.getElementById(idElement);
            if (elemen.classList.contains('hidden')) {
                elemen.classList.remove('hidden');
            } else {
                elemen.classList.add('hidden');
            }
        }
    </script>

</body>
</html>