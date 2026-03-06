<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BagianFasilitas extends Model
{
protected $fillable = [
    'fasilitas_id',
    'nama_bagian',
    'harga',
    'satuan'
];

public function fasilitas()
{
    return $this->belongsTo(\App\Models\Fasilitas::class);
}

}
