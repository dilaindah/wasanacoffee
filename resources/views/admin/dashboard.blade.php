@extends('layouts.admin')

@section('title', 'Overview Dashboard - Wasana Coffee')

@section('content')
    <header class="flex justify-between items-center mb-8 pb-4 border-b border-amber-200/60">
        <div>
            <h2 class="text-2xl font-black text-amber-950 tracking-tight">Selamat Datang, Admin!</h2>
            <p class="text-sm text-gray-500">Berikut adalah ringkasan data toko kopi hari ini.</p>
        </div>
        <div class="text-sm bg-amber-100 text-amber-800 px-4 py-1.5 rounded-full font-medium shadow-sm border border-amber-200">
            🟢 Mode Administrator Aktif
        </div>
    </header>

    <!-- REVISI UTAMA: Perbaikan Gradasi Warna Card Pertama (Total Produk) Agar Senada & Keluar Cokelat Espresso -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        
        <!-- CARD 1: TOTAL PRODUK (Cokelat Espresso Pekat - FIXED) -->
        <div class="bg-gradient-to-br from-amber-900 to-amber-950 p-6 rounded-[24px] shadow-xl text-white flex flex-col justify-between hover:scale-[1.03] transition-all duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 text-white/10 text-7xl transition-all group-hover:scale-110 duration-300">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-amber-200/80 uppercase tracking-wider block mb-1">Total Produk</span>
                <span class="text-3xl font-black tracking-tight text-amber-50">{{ $total_produk }} Varian</span>
            </div>
            <span class="text-[11px] text-amber-300/60 mt-4 block">Varian menu kopi aktif</span>
        </div>
        
        <!-- CARD 2: TOTAL PESANAN (Medium Roast Coffee) -->
        <div class="bg-gradient-to-br from-amber-700 to-amber-900 p-6 rounded-[24px] shadow-xl text-white flex flex-col justify-between hover:scale-[1.03] transition-all duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 text-white/10 text-7xl transition-all group-hover:scale-110 duration-300">
                <i class="fa-solid fa-seedling"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-amber-200/80 uppercase tracking-wider block mb-1">Total Pesanan</span>
                <span class="text-3xl font-black tracking-tight text-amber-50">{{ $total_pesanan }} Transaksi</span>
            </div>
            <span class="text-[11px] text-amber-200/60 mt-4 block">Seluruh order terkumpul</span>
        </div>
        
        <!-- CARD 3: PESANAN HARI INI (Creamy Caramel Latte) -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-700 p-6 rounded-[24px] shadow-xl text-white flex flex-col justify-between hover:scale-[1.03] transition-all duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 text-white/10 text-7xl transition-all group-hover:scale-110 duration-300">
                <i class="fa-solid fa-truck-ramp-box"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-amber-100 uppercase tracking-wider block mb-1">Pesanan Hari Ini</span>
                <span class="text-3xl font-black tracking-tight text-white">{{ $pesanan_hari_ini }} Pesanan</span>
            </div>
            <span class="text-[11px] text-amber-100/60 mt-4 block">Perlu diproses segera</span>
        </div>
        
        <!-- CARD 4: TOTAL PENDAPATAN (Warm Golden Amber) -->
        <div class="bg-gradient-to-br from-amber-600 to-amber-800 p-6 rounded-[24px] shadow-xl text-white flex flex-col justify-between hover:scale-[1.03] transition-all duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 text-white/10 text-7xl transition-all group-hover:scale-110 duration-300">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-amber-200/80 uppercase tracking-wider block mb-1">Total Pendapatan</span>
                <span class="text-2xl font-black tracking-tight text-amber-50">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
            </div>
            <span class="text-[11px] text-amber-200/60 mt-4 block">Omzet bersih terverifikasi</span>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 mb-8">
        <div class="mb-4">
            <h4 class="font-bold text-amber-950 text-sm">Tren Volume Pesanan (7 Hari Terakhir)</h4>
            <p class="text-gray-400 text-xs">Grafik fluktuasi jumlah order harian pelanggan Wasana Coffee.</p>
        </div>
        <div class="w-full" style="height: 300px; position: relative;">
            <canvas id="trenPesananChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('trenPesananChart').getContext('2d');
            
            const labelsGrafik = @json($data_grafik['labels']);
            const dataGrafik = @json($data_grafik['data']);

            new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labelsGrafik,
                    datasets: [{
                        label: ' Jumlah Pesanan Masuk',
                        data: dataGrafik,
                        borderColor: '#78350f', 
                        backgroundColor: 'rgba(245, 158, 11, 0.1)', 
                        borderWidth: 3,
                        pointBackgroundColor: '#b45309',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        tension: 0.3 
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false 
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, 
                                font: { weight: 'bold' }
                            },
                            grid: { color: '#f3f4f6' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>
@endsection