<?php

namespace App\Http\Controllers\Pemohon;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class RiwayatController extends Controller
{
    public function index()
    {
        $data = Peminjaman::where('user_id', auth()->id())
            ->with('fasilitas','bagian','pembayaran','pengembalian')
            ->orderByDesc('created_at')
            ->get();

        return view('pemohon.riwayat.index', compact('data'));
    }
}