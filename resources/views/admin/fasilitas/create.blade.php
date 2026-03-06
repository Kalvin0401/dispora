@extends('layouts.dashboard')

@section('title', 'Tambah Fasilitas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Tambah Fasilitas</h1>

<form method="POST" action="{{ route('admin.fasilitas.store') }}"
      class="bg-white p-6 rounded shadow space-y-4" enctype="multipart/form-data">
    @csrf

    <input type="text" name="nama" placeholder="Nama Fasilitas"
       class="w-full border px-3 py-2 rounded" required>

<input type="text" name="lokasi" placeholder="Lokasi"
       class="w-full border px-3 py-2 rounded" required>

<select name="jenis" class="w-full border px-3 py-2 rounded">
    <option value="Gedung">Gedung</option>
    <option value="Lapangan">Lapangan</option>
    <option value="Stadion">Stadion</option>
    <option value="Kolam Renang">Kolam Renang</option>
</select>

<input type="text" name="tarif" placeholder="Tarif Sewa (Rp)"
       class="w-full border px-3 py-2 rounded" required>

<select name="status" class="w-full border px-3 py-2 rounded">
    <option value="tersedia">Tersedia</option>
    <option value="dipinjam">Dipinjam</option>
</select>

<div class="mb-4">
    <label class="block text-sm font-medium">Foto Fasilitas</label>
    <input type="file" name="foto"
           class="mt-1 block w-full border rounded p-2">
</div>


    <button class="bg-slate-900 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

@endsection
