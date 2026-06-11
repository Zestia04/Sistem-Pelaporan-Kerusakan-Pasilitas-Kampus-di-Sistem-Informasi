<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (pelapor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Informasi Laporan
            $table->string('title');         // Judul singkat kerusakan (Contoh: Kursi Patah)
            $table->string('category');      // Kategori (Contoh: Sarpras, IT, Kebersihan)
            $table->string('location');      // Lokasi (Contoh: Gedung ICT Lantai 2)
            $table->text('description');     // Detail kronologi/kerusakan
            $table->string('image')->nullable(); // Foto bukti (dibuat nullable jika foto opsional)
            $table->string('progress_image')->nullable();  // Foto saat diproses
            $table->string('completed_image')->nullable(); // Foto saat selesai
            
            // Status Laporan (Alur kerja sistem)
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            
            // Prioritas (Diatur oleh Admin nantinya)
            $table->enum('priority', ['rendah', 'sedang', 'tinggi'])->default('rendah');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};