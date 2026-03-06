<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{

protected $table = 'peminjaman';

    public function user()
{
    return $this->belongsTo(User::class);
}

public function fasilitas()
{
    return $this->belongsTo(Fasilitas::class);
}

public function bagian()
{
    return $this->belongsTo(\App\Models\BagianFasilitas::class);
}

protected $fillable = [
    'user_id',
    'fasilitas_id',
    'bagian_id',
    'acara',
    'organisasi',
    'jumlah_peserta',
    'nama_peminjam',
    'no_hp',
    'tanggal_pinjam',
    'durasi',
    'total_biaya',
    'status'
];

public function pembayaran()
{
    return $this->hasOne(\App\Models\Pembayaran::class, 'peminjaman_id');
}

public function pengembalian()
{
    return $this->hasOne(\App\Models\Pengembalian::class);
}

}
