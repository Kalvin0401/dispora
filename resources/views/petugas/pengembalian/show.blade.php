@extends('layouts.petugas')

@section('content')
<div class="space-y-6">

    <div class="bg-white p-6 rounded-2xl shadow space-y-6">

        <h2 class="text-xl font-bold text-red-600">
            Detail Pengembalian
        </h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500">Nama Peminjam</p>
                <p class="font-semibold">
                    {{ $item->peminjaman->nama_peminjam }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Fasilitas</p>
                <p class="font-semibold">
                    {{ $item->peminjaman->fasilitas->nama }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal Pinjam</p>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal Kembali</p>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Kondisi</p>
                <p class="font-semibold text-indigo-600">
                    {{ ucfirst($item->kondisi) }}
                </p>
            </div>

        </div>

        @if($item->keterangan)
        <div>
            <p class="text-gray-500">Keterangan</p>
            <p class="text-sm text-gray-700">
                {{ $item->keterangan }}
            </p>
        </div>
        @endif

        <div class="flex gap-4 pt-4">

            <form action="{{ route('petugas.pengembalian.valid',$item->id) }}" method="POST">
                @csrf
                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm">
                    ✔ Terima
                </button>
            </form>

            <form action="{{ route('petugas.pengembalian.tolak',$item->id) }}" method="POST">
                @csrf
                <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm">
                    ✖ Tolak
                </button>
            </form>

        </div>

    </div>

</div>
@endsection