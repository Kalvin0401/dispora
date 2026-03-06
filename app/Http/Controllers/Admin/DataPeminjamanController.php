<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DataPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['fasilitas','bagian','user','pembayaran']);

        // filter status jika ada
        if($request->status){
            $query->where('status', $request->status);
        }

        $data = $query->orderByDesc('created_at')->get();

        return view('admin.peminjaman.index', compact('data'));
    }

    public function show($id)
    {
        $item = Peminjaman::with(['fasilitas','bagian','user','pembayaran','pengembalian'])
            ->findOrFail($id);

        return view('admin.peminjaman.show', compact('item'));
    }
}