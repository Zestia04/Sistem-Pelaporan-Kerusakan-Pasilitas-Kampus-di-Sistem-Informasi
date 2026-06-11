<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal (Mass Assignment).
     * Sesuai dengan kebutuhan: judul, kategori, lokasi, deskripsi, foto, status, dan prioritas.
     */
protected $fillable = [
    'user_id', 'title', 'category', 'location', 'description', 'image', 'status', 'priority',
    'progress_image', 'completed_image' // <--- Tambahkan ini
];
    /**
     * Relasi: Satu laporan dimiliki oleh satu User (Pelapor).
     * Digunakan agar Admin bisa memanggil nama pelapor dengan $report->user->name.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope atau Helper (Opsional):
     * Memudahkan pengecekan status laporan di dalam file Blade atau Controller.
     */
    public function isCompleted()
    {
        return $this->status === 'selesai';
    }

    // Tambahkan ini di dalam file app/Models/Report.php
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'report_id');
    }
}