<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_pelanggan',
        'kode_pesanan',
        'total_harga',
        'status_pesanan',
    ];

    // Hubungkan ke data pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan', 'id_pelanggan');
    }
}