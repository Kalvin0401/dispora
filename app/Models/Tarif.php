<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $fillable = [
        'fasilitas_id',
        'nama_tarif',
        'keterangan',
        'harga'
    ];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
}
