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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 flex flex-col justify-between hover:scale-[1.02] transition duration-300">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Produk</span>
            <span class="text-3xl font-black text-amber-950 mt-2">{{ $total_produk }} Varian</span>
        </div>
        
        <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 flex flex-col justify-between hover:scale-[1.02] transition duration-300">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</span>
            <span class="text-3xl font-black text-amber-950 mt-2">{{ $total_pesanan }} Transaksi</span>
        </div>
        
        <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 flex flex-col justify-between hover:scale-[1.02] transition duration-300">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pesanan Hari Ini</span>
            <span class="text-3xl font-bold text-emerald-700 mt-2">{{ $pesanan_hari_ini }} Pesanan</span>
        </div>
        
        <div class="bg-white p-6 rounded-[24px] shadow-xl border border-amber-100 flex flex-col justify-between hover:scale-[1.02] transition duration-300">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</span>
            <span class="text-2xl font-black text-emerald-700 mt-2">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
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
            
            // Mengambil data dari Laravel Controller ke Javascript
            const labelsGrafik = @json($data_grafik['labels']);
            const dataGrafik = @json($data_grafik['data']);

            new Chart(ctx, {
                type: 'line', // Jenis grafik garis elegan
                data: {
                    labels: labelsGrafik,
                    datasets: [{
                        label: ' Jumlah Pesanan Masuk',
                        data: dataGrafik,
                        borderColor: '#78350f', // Warna cokelat tema Wasana Coffee
                        backgroundColor: 'rgba(245, 158, 11, 0.1)', // Transparansi amber
                        borderWidth: 3,
                        pointBackgroundColor: '#b45309',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        tension: 0.3 // Membuat garisnya melengkung halus (smooth)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Sembunyikan kotak label atas agar rapi
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Angkanya naik per 1 pesanan (bulat)
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