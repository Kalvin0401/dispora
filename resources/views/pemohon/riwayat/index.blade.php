@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">📄 Riwayat Peminjaman</h1>
        <p class="text-sm opacity-90 mt-1">
            Seluruh histori peminjaman fasilitas Anda.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="p-4">Fasilitas</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Durasi</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-sm">

            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-4 font-medium">
                        {{ $item->fasilitas->nama }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="p-4">
                        {{ $item->durasi }}
                        {{ $item->bagian->satuan ?? 'hari' }}
                    </td>

                    <td class="p-4 font-semibold text-emerald-600">
                        Rp {{ number_format($item->total_biaya,0,',','.') }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($item->status == 'selesai') bg-green-100 text-green-700
                            @elseif($item->status == 'ditolak') bg-red-100 text-red-700
                            @elseif($item->status == 'menunggu_pengembalian') bg-yellow-100 text-yellow-700
                            @else bg-blue-100 text-blue-700
                            @endif
                        ">
                            {{ ucfirst(str_replace('_',' ',$item->status)) }}
                        </span>
                    </td>

                    <td class="p-4 text-center">

                        @if($item->status == 'selesai')
                            <a href="{{ route('pemohon.peminjaman.download',$item->id) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg text-xs">
                                Download Surat
                            </a>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        Belum ada riwayat peminjaman.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>

</div>
@endsection