<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\BagianFasilitas;
use Illuminate\Http\Request;

class BagianFasilitasController extends Controller
{
    // LIST BAGIAN PER FASILITAS
    public function index(Fasilitas $fasilitas)
    {
        $bagian = $fasilitas->bagian;

        return view('admin.bagian.index', compact('fasilitas','bagian'));
    }

    // FORM CREATE
    public function create(Fasilitas $fasilitas)
    {
        return view('admin.bagian.create', compact('fasilitas'));
    }

    // STORE
    public function store(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'nama_bagian' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required'
        ]);

        BagianFasilitas::create([
            'fasilitas_id' => $fasilitas->id,
            'nama_bagian' => $request->nama_bagian,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('admin.bagian.index', $fasilitas->id)
            ->with('success','Bagian berhasil ditambahkan');
    }

    // FORM EDIT
public function edit(BagianFasilitas $bagian)
{
    return view('admin.bagian.edit', compact('bagian'));
}

// UPDATE
public function update(Request $request, BagianFasilitas $bagian)
{
    $request->validate([
        'nama_bagian' => 'required',
        'harga' => 'required|numeric',
        'satuan' => 'required'
    ]);

    $bagian->update([
        'nama_bagian' => $request->nama_bagian,
        'harga' => $request->harga,
        'satuan' => $request->satuan,
    ]);

    return redirect()->route('admin.bagian.index', $bagian->fasilitas_id)
        ->with('success','Tarif berhasil diperbarui');
}

}
