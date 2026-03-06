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
       Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peminjaman_id')
                ->constrained('peminjaman')   // ← WAJIB ditentukan
                ->cascadeOnDelete();

            $table->decimal('jumlah',12,2);
            $table->string('bukti_bayar')->nullable();
            $table->enum('status',['menunggu','valid','ditolak'])
                ->default('menunggu');

            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
