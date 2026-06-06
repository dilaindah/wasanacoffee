<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id_detail';
    
    // Matikan timestamps karena di SQL adek gak ada kolom created_at & updated_at untuk tabel ini
    public $timestamps = false; 

    protected $fillable = [
        'id_pesanan',
        'id_produk',
        'qty',
        'harga_saat_ini',
        'subtotal',
    ];

    // Hubungkan ke data produk kopi
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}