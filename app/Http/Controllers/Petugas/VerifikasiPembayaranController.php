<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class VerifikasiPembayaranController extends Controller
{
    public function index()
    {
        $data = Pembayaran::with('peminjaman.user','peminjaman.fasilitas')
                ->where('status','menunggu')
                ->latest()
                ->get();

        return view('petugas.verifikasi_pembayaran', compact('data'));
    }

public function valid(Pembayaran $pembayaran)
{
    $pembayaran->update([
        'status' => 'valid'
    ]);

    $pembayaran->peminjaman->update([
        'status' => 'dipinjam'
    ]);

    return back()->with('success','Pembayaran diverifikasi.');
}

    public function tolak(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'ditolak'
        ]);

        $pembayaran->peminjaman->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success','Pembayaran ditolak.');
    }
}