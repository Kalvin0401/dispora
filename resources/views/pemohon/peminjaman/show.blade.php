@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">Detail Peminjaman</h1>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">Fasilitas</p>
                <p class="font-semibold text-lg">
                    {{ $peminjaman->fasilitas->nama }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Bagian</p>
                <p class="font-semibold">
                    {{ $peminjaman->bagian->nama_bagian ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal</p>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Durasi</p>
                <p class="font-semibold">
                    {{ $peminjaman->durasi }}
                    {{ $peminjaman->bagian->satuan ?? 'hari' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total Biaya</p>
                <p class="font-bold text-indigo-600 text-lg">
                    Rp {{ number_format($peminjaman->total_biaya,0,',','.') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    @if($peminjaman->status == 'menunggu') bg-yellow-100 text-yellow-700
                    @elseif($peminjaman->status == 'disetujui') bg-green-100 text-green-700
                    @elseif($peminjaman->status == 'ditolak') bg-red-100 text-red-700
                    @elseif($peminjaman->status == 'selesai') bg-indigo-100 text-indigo-700
                    @endif
                ">
                    {{ ucfirst($peminjaman->status) }}
                </span>
            </div>

        </div>

        <div class="mt-6">
            <a href="{{ route('pemohon.peminjaman.index') }}"
               class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
                ← Kembali
            </a>
        </div>

    </div>

</div>
@endsection