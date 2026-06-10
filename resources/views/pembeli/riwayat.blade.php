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
                <p class="text-gray-400 text-xs mt-1 mb-6">Adek belum pernah memesan kopi nih. Yuk pilih varian kopi terbaikmu sekarang!</p>
                <a href="{{ route('pembeli.varian') }}" class="inline-block bg-amber-800 hover:bg-amber-900 text-white font-bold px-6 py-3 rounded-xl text-xs transition-all shadow-md">
                    Pesan Kopi Pertama <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
        @else
            <div class="bg-white rounded-[32px] shadow-xl border border-amber-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-amber-950 text-amber-100 text-xs uppercase tracking-wider font-bold">
                                <th class="py-4 px-6">Tanggal</th>
                                <th class="py-4 px-6">Kode Pesanan</th>
                                <th class="py-4 px-6">Varian & Jumlah (Qty)</th>
                                <th class="py-4 px-6">Total Harga</th>
                                <th class="py-4 px-6 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-50 text-sm font-medium text-gray-700">
                            @foreach($daftar_pesanan as $pesanan)
                                <tr class="hover:bg-amber-50/40 transition">
                                    <td class="py-4 px-6 whitespace-nowrap text-gray-400 text-xs">
                                        {{ date('d M Y, H:i', strtotime($pesanan->created_at)) }}
                                    </td>
                                    
                                    <td class="py-4 px-6 font-mono font-bold text-amber-900 tracking-wide">
                                        {{ $pesanan->kode_pesanan }}
                                    </td>
                                    
                                    <td class="py-4 px-6 text-amber-950">
                                        {{ $pesanan->rincian_varian }}
                                    </td>
                                    
                                    <td class="py-4 px-6 font-bold text-gray-900">
                                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($pesanan->status_pesanan == 'menunggu')
                                            <span class="bg-amber-100 text-amber-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-amber-200">
                                                <i class="fa-regular fa-clock mr-1"></i> Menunggu
                                            </span>
                                        @elseif($pesanan->status_pesanan == 'diproses')
                                            <span class="bg-blue-100 text-blue-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-blue-200">
                                                <i class="fa-solid fa-spinner fa-spin mr-1"></i> Diproses
                                            </span>
                                        @elseif($pesanan->status_pesanan == 'dikirim')
                                            <span class="bg-indigo-100 text-indigo-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-indigo-200">
                                                <i class="fa-solid fa-truck-fast mr-1"></i> Dikirim
                                            </span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-green-200">
                                                <i class="fa-solid fa-circle-check mr-1"></i> Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

</body>
</html>