<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification; 

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelanggan'; 
    protected $primaryKey = 'id_pelanggan'; 

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mengirimkan notifikasi reset password kustom bertema Wasana Coffee
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}