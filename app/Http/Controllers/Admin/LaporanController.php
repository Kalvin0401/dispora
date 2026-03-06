<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('fasilitas','bagian')
            ->where('created_at','>=', Carbon::now()->subMonth())
            ->orderByDesc('tanggal_pinjam')
            ->get();

        return view('admin.laporan.index', compact('data'));
    }

    public function download()
    {
        $data = Peminjaman::with('fasilitas','bagian')
            ->where('created_at','>=', Carbon::now()->subMonth())
            ->orderByDesc('tanggal_pinjam')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('data'));

        return $pdf->download('Laporan-Peminjaman-1-Bulan-Terakhir.pdf');
    }
}