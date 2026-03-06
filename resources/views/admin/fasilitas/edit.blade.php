@extends('layouts.dashboard')

@section('title', 'Edit Fasilitas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Edit Fasilitas</h1>

<form method="POST"
      action="{{ route('admin.fasilitas.update', $fasilitas) }}"
      class="bg-white p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')

    <!-- Nama -->
    <div>
        <label class="block mb-1">Nama Fasilitas</label>
        <input type="text"
               name="nama"
               value="{{ $fasilitas->nama }}"
               class="w-full border px-3 py-2 rounded"
               required>
    </div>

    <!-- Lokasi -->
    <div>
        <label class="block mb-1">Lokasi</label>
        <input type="text"
               name="lokasi"
               value="{{ $fasilitas->lokasi }}"
               class="w-full border px-3 py-2 rounded"
               required>
    </div>

    <!-- Jenis -->
    <div>
        <label class="block mb-1">Jenis</label>
        <select name="jenis"
                class="w-full border px-3 py-2 rounded">

            <option value="Gedung"
                {{ $fasilitas->jenis == 'Gedung' ? 'selected' : '' }}>
                Gedung
            </option>

            <option value="Lapangan"
                {{ $fasilitas->jenis == 'Lapangan' ? 'selected' : '' }}>
                Lapangan
            </option>

            <option value="Stadion"
                {{ $fasilitas->jenis == 'Stadion' ? 'selected' : '' }}>
                Stadion
            </option>

            <option value="Kolam Renang"
                {{ $fasilitas->jenis == 'Kolam Renang' ? 'selected' : '' }}>
                Kolam Renang
            </option>

        </select>
    </div>

    <!-- Tarif -->
    <div>
        <label class="block mb-1">Tarif (Rp)</label>
        <input type="text"
               name="tarif"
               value="{{ $fasilitas->tarif }}"
               class="w-full border px-3 py-2 rounded"
               required>
    </div>

    <!-- Status -->
    <div>
        <label class="block mb-1">Status</label>
        <select name="status"
                class="w-full border px-3 py-2 rounded">

            <option value="tersedia"
                {{ $fasilitas->status == 'tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>

            <option value="dipinjam"
                {{ $fasilitas->status == 'dipinjam' ? 'selected' : '' }}>
                Dipinjam
            </option>

        </select>
    </div>

    <button class="bg-slate-900 text-white px-4 py-2 rounded">
        Update
    </button>

</form>

@endsection
