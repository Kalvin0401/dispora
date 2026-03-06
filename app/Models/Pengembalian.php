<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian'; // 🔥 TAMBAHKAN INI

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'kondisi',
        'keterangan'
    ];
    public function peminjaman()
{
    return $this->belongsTo(\App\Models\Peminjaman::class, 'peminjaman_id');
}
}
