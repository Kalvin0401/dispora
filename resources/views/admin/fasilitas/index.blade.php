@extends('layouts.dashboard')

@section('title', 'Kelola Fasilitas')

@section('content')

<div class="space-y-6">

    {{-- HEADER CARD --}}
    <div class="bg-gradient-to-r from-indigo-800 to-purple-600 
                text-white rounded-2xl shadow-xl p-6">
        <h1 class="text-2xl font-bold">
            Manajemen Fasilitas
        </h1>
        <p class="text-sm opacity-90 mt-1">
            Kelola data fasilitas dan tarif SIP DISPORA
        </p>
    </div>

    {{-- SEARCH & BUTTON --}}
    <div class="flex justify-between items-center">

        <form method="GET" class="flex gap-3">
            <input type="text" name="search"
                   placeholder="Cari nama fasilitas..."
                   class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none w-64">

            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition">
                Search
            </button>
        </form>

        <a href="{{ route('admin.fasilitas.create') }}"
           class="bg-slate-900 hover:bg-slate-700 text-white px-5 py-2 rounded-lg shadow transition">
            + Tambah Fasilitas
        </a>

    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full text-sm text-left">

            <thead class="bg-gradient-to-r from-slate-900 to-slate-700 text-white">
                <tr>
                    <th class="px-6 py-4">NAMA</th>
                    <th class="px-6 py-4">LOKASI</th>
                    <th class="px-6 py-4">JENIS</th>
                    <th class="px-6 py-4">TARIF</th>
                    <th class="px-6 py-4">STATUS</th>
                    <th class="px-6 py-4 text-center">AKSI</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

            @foreach($fasilitas as $item)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-semibold text-slate-700">
                        {{ $item->nama }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->lokasi }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->jenis }}
                    </td>

                    <td class="px-6 py-4">
                        @if($item->bagian->count())
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold">
                                Mulai Rp {{ number_format($item->harga_mulai,0,',','.') }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs italic">
                                Belum ada tarif
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        @if($item->status == 'tersedia')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                Tersedia
                            </span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                Dipinjam
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.bagian.index', $item->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs shadow transition">
                                Tarif
                            </a>

                            <a href="{{ route('admin.fasilitas.edit', $item->id) }}"
                               class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded-lg text-xs shadow transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.fasilitas.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs shadow transition">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
