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
        Schema::create('bagian_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->string('nama_bagian');
            $table->string('satuan'); // hari / jam
            $table->decimal('harga', 15, 2);
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bagian_fasilitas');
    }
};
