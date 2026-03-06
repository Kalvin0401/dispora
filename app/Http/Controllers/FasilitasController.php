<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->get();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required',
        'lokasi' => 'required',
        'jenis' => 'required',
        'tarif' => 'required|numeric',
        'status' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

        $data = $request->only([
        'nama',
        'lokasi',
        'jenis',
        'tarif',
        'status'
    ]);

    if ($request->hasFile('foto')) {$data['foto'] = $request->file('foto')->store('fasilitas', 'public');
    }

    Fasilitas::create($data); // ✅ BENAR

    return redirect()->route('admin.fasilitas.index')
        ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
        'nama' => 'required',
        'lokasi' => 'required',
        'jenis' => 'required',
        'tarif' => 'required|numeric',
        'status' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->only([
        'nama',
        'lokasi',
        'jenis',
        'tarif',
        'status'
    ]);

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')
                                ->store('fasilitas', 'public');
    }

    $fasilitas->update($data);

    return redirect()->route('admin.fasilitas.index')
        ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function show(Fasilitas $fasilitas)
{
    return view('admin.fasilitas.show', compact('fasilitas'));
}
}
