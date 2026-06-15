<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Wasana Coffee</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 30px; border-b: 2px solid #78350f; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #451a03; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #78350f; font-size: 12px; font-weight: bold; }
        .meta-info { margin-bottom: 20px; font-size: 12px; }
        .meta-info table { width: 100%; }
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 11px; }
        table.data-table th { background-color: #451a03; color: #ffffff; padding: 10px; text-align: left; text-transform: uppercase; }
        table.data-table td { padding: 10px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        table.data-table tr:nth-child(even) { background-color: #fdfaf5; }
        
        /* Style Khusus untuk List Rincian Produk */
        .rincian-list { margin: 4px 0 0 0; padding-left: 12px; color: #6b7280; font-size: 10px; list-style-type: disc; }
        .rincian-item { margin-bottom: 2px; }
        
        .total-box { margin-top: 25px; text-align: right; font-size: 14px; font-weight: bold; color: #451a03; padding: 10px; background: #f59e0b; border-radius: 5px; float: right; width: 40%; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 5px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Wasana Coffee Management</h2>
        <p>LAPORAN PENJUALAN & OMSET BULANAN</p>
    </div>

    <div class="meta-info">
        <table>
            <tr>
                <td><strong>Periode Laporan:</strong> {{ $nama_bulan }} {{ $tahun }}</td>
                <td style="text-align: right;"><strong>Tanggal Cetak:</strong> {{ date('d M Y') }}</td>
            </tr>
            <tr>
                <td><strong>Status Transaksi:</strong> Sukses (Selesai)</td>
                <td style="text-align: right;"><strong>Oleh:</strong> Admin Wasana Coffee</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr style="background-color: #451a03;">
                <th style="color: white; width: 15%;">Tanggal</th>
                <th style="color: white; width: 25%;">Kode Pesanan</th>
                <th style="color: white; width: 45%;">Pelanggan & Rincian Item</th>
                <th style="color: white; width: 15%; text-align: right;">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_pesanan as $p)
            <tr>
                <td>{{ date('d/m/Y', strtotime($p->created_at)) }}</td>
                <td style="font-family: monospace; font-weight: bold; color: #78350f;">{{ $p->kode_pesanan }}</td>
                <td>
                    <strong>{{ $p->nama_pembeli }}</strong>
                    
                    @php
                        $items = DB::table('detail_pesanan')
                                    ->where('id_pesanan', $p->id_pesanan)
                                    ->get();
                    @endphp
                    
                    <ul class="rincian-list">
                        @foreach($items as $item)
                            <li class="rincian-item">
                                Varian {{ $item->id_produk == 1 ? '100g' : '250g' }} 
                                ({{ $item->qty }}x) - Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td style="text-align: right; font-weight: bold; color: #047857;">
                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        TOTAL OMSET: Rp {{ number_format($total_omset, 0, ',', '.') }}
    </div>

    <div class="footer">
        Laporan ini dihasilkan secara otomatis oleh Sistem Informasi Penjualan Wasana Coffee 2026.
    </div>

</body>
</html>