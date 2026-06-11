<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('feedbacks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('report_id')->constrained('reports')->onDelete('cascade'); // Menghubungkan ke tabel laporan
        $table->integer('rating'); // Menyimpan angka 1 sampai 5
        $table->text('comment');   // Menyimpan teks ulasan
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
