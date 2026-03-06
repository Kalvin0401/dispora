@extends('layouts.dashboard')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-indigo-800 to-purple-600 
                text-white rounded-2xl shadow-xl p-8 ">
        <h1 class="text-2xl font-bold">📂 Data Peminjaman</h1>
        <p class="text-sm opacity-90">
            Monitoring seluruh proses peminjaman.
        </p>
    </div>

    <!-- FILTER -->
    <form method="GET" class="bg-white p-4 rounded-xl shadow flex gap-3 items-center">
        <select name="status" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="menunggu">Menunggu</option>
            <option value="disetujui">Disetujui</option>
            <option value="dibayar">Dibayar</option>
            <option value="selesai">Selesai</option>
            <option value="selesai">Final</option>
        </select>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">
            Filter
        </button>
    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Fasilitas</th>
                    <th class="p-4">Durasi</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="p-4">
                        {{ $item->nama_peminjam }}
                    </td>

                    <td class="p-4">
                        {{ $item->fasilitas->nama }}
                    </td>

                    <td class="p-4">
                        {{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}
                    </td>

                    <td class="p-4 text-indigo-600 font-semibold">
                        Rp {{ number_format($item->total_biaya,0,',','.') }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs bg-gray-100">
                            {{ ucfirst(str_replace('_',' ',$item->status)) }}
                        </span>
                    </td>

                    <td class="p-4">
                        <a href="{{ route('admin.peminjaman.show',$item->id) }}"
                           class="text-indigo-600 hover:underline text-xs">
                           Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">
                        Tidak ada data.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>

</div>
@endsection