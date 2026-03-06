@extends('layouts.petugas')

@section('content')

<div class="max-w-7xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Verifikasi Permohonan</h1>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Fasilitas</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">
                    @if($data->count() && $data->first()->bagian)
                        {{ ucfirst($data->first()->bagian->satuan) }}
                    @else
                        Durasi
                    @endif
                   </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Total</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">

                @forelse($data as $item)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $item->nama_peminjam }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
    <div class="font-medium">
        {{ $item->fasilitas->nama }}
    </div>
    <div class="text-xs text-gray-400">
        {{ $item->bagian->nama_bagian ?? '-' }}
        ({{ $item->bagian->satuan ?? '-' }})
    </div>
</td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                            @if($item->bagian)
                                {{ $item->durasi }} {{ $item->bagian->satuan }}
                            @else
                                {{ $item->durasi }} hari
                            @endif
                    </td>

                    <td class="px-6 py-4 font-semibold text-blue-700">
                        Rp {{ number_format($item->total_biaya,0,',','.') }}
                    </td>

                    <td class="px-6 py-4 text-center">

                        <div class="flex justify-center gap-2">

                            <!-- Setujui -->
                            <form action="{{ route('petugas.setujui',$item->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    Setujui
                                </button>
                            </form>

                            <!-- Tolak -->
                            <form action="{{ route('petugas.tolak',$item->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    Tolak
                                </button>
                            </form>

                            <a href="{{ route('petugas.download',$item->id) }}"
   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow transition">
    Download PDF
</a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        Tidak ada permohonan yang menunggu verifikasi.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
