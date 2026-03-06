@extends('layouts.petugas')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">📊 Laporan Peminjaman Sarana</h1>
        <p class="text-sm opacity-90 mt-1">
            Data seluruh peminjaman fasilitas olahraga.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Nama Peminjam</th>
                    <th class="p-4">Kegiatan</th>
                    <th class="p-4">Jadwal Pemakaian</th>
                    <th class="p-4">Keterangan</th>
                </tr>
            </thead>

            <tbody>

            @forelse($data as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="p-4 font-medium">
                        {{ $item->nama_peminjam }}
                    </td>

                    <td class="p-4">
                        {{ $item->fasilitas->nama }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        ({{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }})
                    </td>

                    <td class="p-4">
                        {{ ucfirst(str_replace('_',' ',$item->status)) }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Belum ada data laporan.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection