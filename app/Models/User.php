<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Menentukan kolom mana saja yang boleh diisi (Mass Assignment).
     */
    protected $fillable = [
        'name',
        'identity_number', // Gunakan ini agar bisa login pakai NIM
        'password',
        'role',
    ];

    /**
     * Menyembunyikan kolom sensitif saat data dipanggil.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe data otomatis.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: Satu User bisa punya banyak Laporan.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    
}