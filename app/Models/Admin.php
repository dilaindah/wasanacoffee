<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'password',
    ];

    // Karena di tabel ada created_at dan updated_at, aktifkan timestamps
    public $timestamps = true;
}