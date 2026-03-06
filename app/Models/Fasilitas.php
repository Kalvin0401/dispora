<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = ['nama', 'lokasi', 'jenis', 'tarif', 'status', 'foto'];

public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}

public function tarifs()
{
    return $this->hasMany(Tarif::class);
}

public function bagian()
{
    return $this->hasMany(BagianFasilitas::class);
}


public function getHargaMulaiAttribute()
{
    return $this->bagian->min('harga');
}

public function show(Fasilitas $fasilitas)
{
    $fasilitas->load('bagian');
    return view('pemohon.fasilitas.show', compact('fasilitas'));
}

}
