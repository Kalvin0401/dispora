<?php

namespace App\Http\Controllers\Pemohon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
    {
        $fasilitasList = Fasilitas::where('status', 'tersedia')->get();

        $selectedFasilitas = null;

        if ($request->fasilitas_id) {
            $selectedFasilitas = Fasilitas::findOrFail($request->fasilitas_id);
        }

        return view('pemohon.peminjaman.create', compact(
            'fasilitasList',
            'selectedFasilitas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE DATA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
{
    $request->validate([
        'fasilitas_id' => 'required',
        'bagian_id' => 'required',
        'durasi' => 'required|integer|min:1',
        'acara' => 'required',
        'nama_peminjam' => 'required',
        'tanggal_pinjam' => 'required|date',
    ]);

    // 🔥 CEK DOUBLE BOOKING
    $cek = Peminjaman::where('bagian_id', $request->bagian_id)
        ->where('tanggal_pinjam', $request->tanggal_pinjam)
        ->whereIn('status', [
            'menunggu',
            'disetujui',
            'dibayar',
            'dibayar_valid',
            'menunggu_pengembalian'
        ])
        ->exists();

    if ($cek) {
        return back()
            ->withInput()
            ->with('error', 'Bagian ini sudah dipinjam pada tanggal tersebut.');
    }

    // Ambil bagian untuk ambil harga asli dari database
    $bagian = \App\Models\BagianFasilitas::findOrFail($request->bagian_id);

    $total = $bagian->harga * $request->durasi;

    Peminjaman::create([
        'user_id' => auth()->id(),
        'fasilitas_id' => $request->fasilitas_id,
        'bagian_id' => $request->bagian_id,
        'acara' => $request->acara,
        'organisasi' => $request->organisasi,
        'jumlah_peserta' => $request->jumlah_peserta,
        'nama_peminjam' => $request->nama_peminjam,
        'no_hp' => $request->no_hp,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'durasi' => $request->durasi,
        'total_biaya' => $total,
        'status' => 'menunggu'
    ]);

    return redirect()->route('pemohon.dashboard')
        ->with('success', 'Pengajuan berhasil dikirim.');
}

    /*
    |--------------------------------------------------------------------------
    | LIST FASILITAS
    |--------------------------------------------------------------------------
    */
    public function fasilitas()
    {
        $fasilitas = Fasilitas::latest()->get();
        return view('pemohon.fasilitas.index', compact('fasilitas'));
    }

    public function showFasilitas(Fasilitas $fasilitas)
    {
        return view('pemohon.fasilitas.show', compact('fasilitas'));
    }

   public function index(Request $request)
{
    $query = Peminjaman::where('user_id', auth()->id());

    // 🔍 Filter Status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // 🔎 Search fasilitas
    if ($request->search) {
        $query->whereHas('fasilitas', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        });
    }

    $data = $query->latest()->paginate(5);

    return view('pemohon.peminjaman.index', compact('data'));
}

public function show(Peminjaman $peminjaman)
{
    // Pastikan hanya user pemilik yang bisa akses
    if ($peminjaman->user_id !== auth()->id()) {
        abort(403);
    }

    return view('pemohon.peminjaman.show', compact('peminjaman'));
}



public function download(Peminjaman $peminjaman)
{
    if ($peminjaman->user_id !== auth()->id()) {
        abort(403);
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'pemohon.peminjaman.download',
        compact('peminjaman')
    );

    return $pdf->download('form-peminjaman-'.$peminjaman->id.'.pdf');
}

}
