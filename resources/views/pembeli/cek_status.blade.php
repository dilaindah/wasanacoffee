<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pesanan - Wasana Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#fdfaf5] font-sans antialiased">

    @include('layouts.nav-pembeli')

    <div class="max-w-3xl mx-auto px-4 py-10">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-amber-950 tracking-tight">Cek Status Pesanan</h2>
            <p class="text-gray-500 text-sm mt-1">Lacak posisi dan status pembuatan kopi Wasana adek secara real-time.</p>
        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-xl border border-amber-100 max-w-xl mx-auto mb-8">
            
            @if(session('error_cari'))
                <div class="mb-4 text-xs text-red-600 bg-red-50 p-3.5 rounded-xl border border-red-200 font-bold">
                    <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ session('error_cari') }}
                </div>
            @endif

            <form method="POST" action="{{ route('pembeli.cek_status_proses') }}">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-amber-950 uppercase tracking-wider mb-2">Masukkan Kode Pesanan</label>
                        <input type="text" name="kode_pesanan" value="{{ old('kode_pesanan', $pesanan->kode_pesanan ?? '') }}" placeholder="Contoh: WSN-20260610-6255" required
                            class="w-full bg-amber-50/50 border border-amber-200 rounded-xl px-4 py-3 text-sm font-mono font-bold tracking-wide text-amber-950 focus:outline-none focus:border-amber-600 focus:bg-white transition-all">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full sm:w-auto bg-amber-800 hover:bg-amber-900 text-white font-bold px-6 py-3 rounded-xl text-sm transition transform active:scale-95 shadow-md flex items-center justify-center gap-2">
                            <i class="fa-solid fa-magnifying-glass"></i> Cek Status
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if($pesanan != null)
            <div class="bg-white rounded-[32px] p-6 md:p-10 shadow-2xl border border-amber-100 max-w-2xl mx-auto transition-all animate-fadeIn">
                
                <div class="flex justify-between items-center border-b border-amber-50 pb-4 mb-8 text-xs">
                    <div>
                        <p class="text-gray-400 font-medium">KODE TRANSAKSI</p>
                        <p class="font-mono font-bold text-amber-950 text-sm tracking-wide">{{ $pesanan->kode_pesanan }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 font-medium">TOTAL BELANJA</p>
                        <p class="font-bold text-amber-900 text-sm">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="relative flex items-center justify-between mb-12 px-4">
                    
                    <div class="absolute left-6 right-6 bg-gray-200 h-1 top-1/2 transform -translate-y-1/2 z-0"></div>
                    
                    <div class="absolute left-6 bg-amber-800 h-1 top-1/2 transform -translate-y-1/2 z-0 transition-all duration-700"
                        style="width: {{ $pesanan->status_pesanan == 'menunggu' ? '0%' : ($pesanan->status_pesanan == 'diproses' ? '29%' : ($pesanan->status_pesanan == 'dikirim' ? '59%' : '88%')) }};">
                    </div>

                    <div class="z-10 text-center flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-4 transition-all duration-300
                            {{ $pesanan->status_pesanan == 'menunggu' ? 'bg-amber-600 text-white border-amber-200 scale-110 shadow-lg shadow-amber-200' : 'bg-amber-800 text-white border-white' }}">
                            <i class="fa-regular fa-clock text-xs"></i>
                        </div>
                        <span class="text-[11px] font-bold mt-2 tracking-tight 
                            @if($pesanan->status_pesanan == 'menunggu') text-amber-800 
                            @else text-gray-700 @endif">
                            Menunggu
                        </span>
                    </div>

                    <div class="z-10 text-center flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-4 transition-all duration-300
                            @if($pesanan->status_pesanan == 'diproses') bg-blue-600 text-white border-blue-200 scale-110 shadow-lg shadow-blue-200
                            @elseif($pesanan->status_pesanan == 'dikirim' || $pesanan->status_pesanan == 'selesai') bg-blue-800 text-white border-white
                            @else bg-gray-200 text-gray-400 border-white @endif">
                            <i class="fa-solid fa-spinner {{ $pesanan->status_pesanan == 'diproses' ? 'fa-spin' : '' }} text-xs"></i>
                        </div>
                        <span class="text-[11px] font-bold mt-2 tracking-tight 
                            @if($pesanan->status_pesanan == 'diproses') text-blue-700 
                            @elseif($pesanan->status_pesanan == 'dikirim' || $pesanan->status_pesanan == 'selesai') text-gray-700 
                            @else text-gray-400 @endif">Diproses</span>
                    </div>

                    <div class="z-10 text-center flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-4 transition-all duration-300
                            @if($pesanan->status_pesanan == 'dikirim') bg-purple-600 text-white border-purple-200 scale-110 shadow-lg shadow-purple-200
                            @elseif($pesanan->status_pesanan == 'selesai') bg-purple-800 text-white border-white
                            @else bg-gray-200 text-gray-400 border-white @endif">
                            <i class="fa-solid fa-truck-fast text-xs"></i>
                        </div>
                        <span class="text-[11px] font-bold mt-2 tracking-tight 
                            @if($pesanan->status_pesanan == 'dikirim') text-purple-700 
                            @elseif($pesanan->status_pesanan == 'selesai') text-gray-700 
                            @else text-gray-400 @endif">Dikirim</span>
                    </div>

                    <div class="z-10 text-center flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-4 transition-all duration-300
                            {{ $pesanan->status_pesanan == 'selesai' ? 'bg-green-600 text-white border-green-200 scale-110 shadow-lg shadow-green-200' : 'bg-gray-200 text-gray-400 border-white' }}">
                            <i class="fa-solid fa-circle-check text-xs"></i>
                        </div>
                        <span class="text-[11px] font-bold mt-2 tracking-tight {{ $pesanan->status_pesanan == 'selesai' ? 'text-green-700' : 'text-gray-400' }}">Selesai</span>
                    </div>

                </div>

                <div class="bg-amber-50/60 rounded-xl p-4 border border-amber-100 flex items-center gap-3 text-left">
                    <div class="text-amber-800 text-base">
                        <i class="fa-solid fa-circle-info animate-pulse"></i>
                    </div>
                    <p class="text-xs text-amber-950 font-semibold leading-relaxed">
                        Status Pesanan diperbarui secara berkala oleh admin. Mohon cek halaman ini secara berkala untuk memantau status pesanan kopi Anda.
                    </p>
                </div>

            </div>
        @endif

    </div>

</body>
</html>