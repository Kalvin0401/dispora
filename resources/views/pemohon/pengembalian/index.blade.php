@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">🔄 Pengembalian Fasilitas</h1>
        <p class="text-sm opacity-90">Ajukan pengembalian setelah kegiatan selesai.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @forelse($data as $item)

    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-lg">
                    {{ $item->fasilitas->nama }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                </p>
            </div>

            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                Siap Dikembalikan
            </span>
        </div>

        @if(!$item->pengembalian)
        <form action="{{ route('pemohon.pengembalian.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="peminjaman_id" value="{{ $item->id }}">

            <div>
                <label class="text-sm text-gray-600">Kondisi Fasilitas</label>
                <select name="kondisi" class="w-full border rounded-lg p-2">
                    <option value="baik">Baik</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">Keterangan</label>
                <textarea name="keterangan"
                    class="w-full border rounded-lg p-2"
                    rows="2"></textarea>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                Ajukan Pengembalian
            </button>
        </form>
        @else
            <div class="bg-yellow-100 text-yellow-700 p-3 rounded-lg text-sm">
                Pengembalian sudah diajukan dan menunggu verifikasi petugas.
            </div>
        @endif

    </div>

    @empty

    <div class="bg-white p-10 text-center rounded-xl shadow text-gray-500">
        Tidak ada fasilitas yang perlu dikembalikan.
    </div>

    @endforelse

</div>
@endsection