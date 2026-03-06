<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['fasilitas','bagian','user'])
            ->where('status', 'selesai') // hanya final
            ->orderByDesc('tanggal_pinjam')
            ->get();

        return view('petugas.laporan.index', compact('data'));
    }
}