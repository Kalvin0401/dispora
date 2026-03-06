@extends('layouts.dashboard')

@section('content')
<div class="space-y-6">

    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <h2 class="text-xl font-bold text-indigo-600">
            Detail Peminjaman
        </h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500">Nama</p>
                <p class="font-semibold">{{ $item->nama_peminjam }}</p>
            </div>

            <div>
                <p class="text-gray-500">Fasilitas</p>
                <p class="font-semibold">{{ $item->fasilitas->nama }}</p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal</p>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Durasi</p>
                <p class="font-semibold">
                    {{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Total Biaya</p>
                <p class="font-semibold text-indigo-600">
                    Rp {{ number_format($item->total_biaya,0,',','.') }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <p class="font-semibold capitalize">
                    {{ str_replace('_',' ',$item->status) }}
                </p>
            </div>

        </div>

        @if($item->pembayaran)
        <div class="border-t pt-4">
            <h3 class="font-semibold mb-2">Pembayaran</h3>
            <p>Status: {{ $item->pembayaran->status }}</p>
        </div>
        @endif

        @if($item->pengembalian)
        <div class="border-t pt-4">
            <h3 class="font-semibold mb-2">Pengembalian</h3>
            <p>Kondisi: {{ $item->pengembalian->kondisi }}</p>
        </div>
        @endif

    </div>

</div>
@endsection