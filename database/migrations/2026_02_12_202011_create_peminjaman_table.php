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
       Schema::create('peminjaman', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');

    $table->string('acara');
    $table->string('organisasi')->nullable();
    $table->integer('jumlah_peserta');
    $table->string('nama_peminjam');
    $table->string('no_hp');

    $table->date('tanggal_pinjam');
    $table->integer('durasi');
    $table->decimal('total_biaya', 15, 2);

    $table->string('status')->default('menunggu');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
