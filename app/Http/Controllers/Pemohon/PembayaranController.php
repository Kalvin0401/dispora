<?php

namespace App\Http\Controllers\Pemohon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PembayaranController extends Controller
{
   public function index()
{
    $data = \App\Models\Peminjaman::where('user_id', auth()->id())
                ->whereIn('status', ['disetujui','dibayar','selesai'])
                ->with('pembayaran','bagian','fasilitas')
                ->orderByDesc('created_at')
                ->get();

    return view('pemohon.pembayaran.index', compact('data'));
}
public function store(Request $request)
{
    $request->validate([
        'peminjaman_id' => 'required|exists:peminjaman,id',
        'bukti' => 'required|image|max:2048'
    ]);

    $peminjaman = \App\Models\Peminjaman::findOrFail($request->peminjaman_id);

    if ($peminjaman->user_id !== auth()->id()) {
        abort(403);
    }

    $path = $request->file('bukti')->store('bukti_pembayaran', 'public');

    \App\Models\Pembayaran::updateOrCreate(
    ['peminjaman_id' => $peminjaman->id],
    [
        'jumlah' => $peminjaman->total_biaya,
        'bukti_bayar' => $path,
        'status' => 'menunggu' // ✅ sesuai ENUM database
    ]
);

    $peminjaman->update([
        'status' => 'dibayar'
    ]);

    return redirect()->route('pemohon.pembayaran.index')
        ->with('success', 'Bukti pembayaran berhasil diupload.');
}
public function download(\App\Models\Peminjaman $peminjaman)
{
    if ($peminjaman->user_id !== auth()->id()) {
        abort(403);
    }

    $peminjaman->load('fasilitas','bagian','pembayaran');

    // 🔒 HANYA BOLEH DOWNLOAD JIKA SUDAH VALID
    if (!$peminjaman->pembayaran || $peminjaman->pembayaran->status !== 'valid') {
        return redirect()->back()->with('error','Invoice hanya bisa diunduh setelah pembayaran diverifikasi.');
    }

    $pdf = Pdf::loadView('pemohon.pembayaran.invoice', compact('peminjaman'))
              ->setPaper('a4','portrait');

    return $pdf->download('Invoice-'.$peminjaman->id.'.pdf');
}

public function surat($id)
{
    $peminjaman = \App\Models\Peminjaman::with('fasilitas','bagian','pembayaran')
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    if (!$peminjaman->pembayaran || $peminjaman->pembayaran->status != 'valid') {
        abort(403);
    }

    $pdf = Pdf::loadView('pemohon.pdf.surat_pernyataan', compact('peminjaman'));

    return $pdf->download('Surat-Pernyataan-'.$peminjaman->fasilitas->nama.'.pdf');
}
}