<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Fasilitas;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::with([
                'peminjaman.fasilitas',
                'peminjaman.user'
            ])
            ->whereHas('peminjaman', function($q){
                $q->where('status','menunggu_pengembalian');
            })
            ->latest()
            ->get();

        return view('petugas.pengembalian.index', compact('data'));
    }

    public function show($id)
    {
        $item = Pengembalian::with([
                'peminjaman.fasilitas',
                'peminjaman.user'
            ])
            ->findOrFail($id);

        return view('petugas.pengembalian.show', compact('item'));
    }

public function valid($id)
{
    $pengembalian = Pengembalian::with('peminjaman.fasilitas')
                    ->findOrFail($id);

    if (!$pengembalian->peminjaman) {
        return back()->with('error','Data peminjaman tidak ditemukan.');
    }

    $peminjaman = $pengembalian->peminjaman;

    // ✅ Status selesai
    $peminjaman->update([
        'status' => 'selesai'
    ]);

    // ✅ Fasilitas kembali tersedia
    if ($peminjaman->fasilitas) {
        $peminjaman->fasilitas->update([
            'status' => 'tersedia'
        ]);
    }

    return redirect()
            ->route('petugas.pengembalian.index')
            ->with('success','Pengembalian disetujui.');
}

    public function tolak($id)
    {
        $pengembalian = Pengembalian::with('peminjaman')->findOrFail($id);

        if (!$pengembalian->peminjaman) {
            return back()->with('error','Relasi peminjaman tidak ditemukan.');
        }

        $pengembalian->peminjaman->status = 'selesai';
        $pengembalian->peminjaman->save();

        return redirect()
            ->route('petugas.pengembalian.index')
            ->with('success','Pengembalian ditolak.');
    }
}