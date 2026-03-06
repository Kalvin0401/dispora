<?php

namespace App\Http\Controllers\Pemohon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Fasilitas;
class PengembalianController extends Controller
{
public function index()
{
    $data = Peminjaman::where('user_id', auth()->id())
        ->where('status', 'dipinjam') // 🔥 harus sama dengan verifikasi pembayaran
        ->with('fasilitas','bagian','pengembalian')
        ->orderByDesc('created_at')
        ->get();

    return view('pemohon.pengembalian.index', compact('data'));
}

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'kondisi' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        if ($peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        // Simpan data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => now(),
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        // Update status
        $peminjaman->update([
            'status' => 'menunggu_pengembalian'
        ]);

        return redirect()->route('pemohon.pengembalian.index')
            ->with('success','Pengembalian berhasil diajukan.');
    }
}