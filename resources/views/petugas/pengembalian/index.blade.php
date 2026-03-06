@extends('layouts.petugas')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-orange-600 to-red-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">🔄 Pengembalian Fasilitas</h1>
        <p class="text-sm opacity-90">
            Pengajuan pengembalian yang perlu diverifikasi.
        </p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @forelse($data as $item)

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-lg font-semibold">
                    {{ $item->peminjaman->fasilitas->nama }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ $item->peminjaman->nama_peminjam }}
                </p>

                <p class="text-sm mt-2">
                    Kondisi:
                    <span class="font-semibold text-indigo-600">
                        {{ ucfirst($item->kondisi) }}
                    </span>
                </p>
            </div>

            <a href="{{ route('petugas.pengembalian.show',$item->id) }}"
               class="text-indigo-600 text-sm hover:underline">
               Lihat Detail
            </a>

        </div>

    </div>

    @empty

    <div class="bg-white p-8 text-center rounded-xl shadow text-gray-500">
        Tidak ada pengajuan pengembalian.
    </div>

    @endforelse

</div>
@endsection