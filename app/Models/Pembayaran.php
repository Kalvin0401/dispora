<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public function pembayaran()
{
    return $this->hasOne(\App\Models\Pembayaran::class);
}

 protected $table = 'pembayaran';

    protected $fillable = [
        'peminjaman_id',
        'jumlah',
        'bukti_bayar',
        'status'
    ];


public function peminjaman()
{
    return $this->belongsTo(\App\Models\Peminjaman::class, 'peminjaman_id');
}
}
