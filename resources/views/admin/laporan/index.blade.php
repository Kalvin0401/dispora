@extends('layouts.dashboard')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-indigo-800 to-purple-600 
                text-white rounded-2xl shadow-xl p-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">📊 Laporan Peminjaman</h1>
            <p class="text-sm opacity-90">
                Data peminjaman 1 bulan terakhir.
            </p>
        </div>

        <a href="{{ route('admin.laporan.download') }}"
           class="bg-white text-indigo-700 px-4 py-2 rounded-lg text-sm font-semibold shadow">
            Download PDF
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Fasilitas</th>
                    <th class="p-4">Durasi</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>

            <tbody>

            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>
                    <td class="p-4">{{ $item->nama_peminjam }}</td>
                    <td class="p-4">{{ $item->fasilitas->nama }}</td>
                    <td class="p-4">
                        {{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}
                    </td>
                    <td class="p-4">
                        {{ ucfirst(str_replace('_',' ',$item->status)) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Tidak ada data.
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection