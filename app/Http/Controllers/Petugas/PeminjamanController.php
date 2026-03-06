<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Fasilitas;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    public function verifikasi()
    {
        $data = Peminjaman::with(['fasilitas','bagian'])
                ->where('status','menunggu')
                ->latest()
                ->get();

        return view('petugas.verifikasi', compact('data'));
    }

public function dashboard()
{
    $menunggu = Peminjaman::where('status','menunggu')->count();
    $disetujui = Peminjaman::where('status','disetujui')->count();
    $ditolak = Peminjaman::where('status','ditolak')->count();
    $dipinjam = Fasilitas::where('status','dipinjam')->count();

    // 🔥 TAMBAHAN BARU
    $menungguPembayaran = \App\Models\Pembayaran::where('status','menunggu')->count();

    $menungguPengembalian = \App\Models\Pengembalian::whereHas('peminjaman', function($q){
        $q->where('status','menunggu_pengembalian');
    })->count();

    return view('petugas.dashboard', compact(
        'menunggu',
        'disetujui',
        'ditolak',
        'dipinjam',
        'menungguPembayaran',
        'menungguPengembalian'
    ));
}
public function setujui($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    $peminjaman->update([
        'status' => 'disetujui'
    ]);

    return back()->with('success','Permohonan disetujui');
}

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success','Permohonan ditolak');
    }

    public function download($id)
    {
        $peminjaman = Peminjaman::with('fasilitas')
                        ->findOrFail($id);

        $pdf = Pdf::loadView('petugas.pdf.peminjaman', compact('peminjaman'));

        return $pdf->download('form_peminjaman_'.$peminjaman->id.'.pdf');
    }
}