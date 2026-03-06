@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-indigo-800 to-purple-600 
                text-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-bold">
            Dashboard Admin
        </h1>
        <p class="opacity-90 mt-2">
            Ringkasan aktivitas dan statistik SIP DISPORA
        </p>
    </div>

    {{-- STATISTIK CARD --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-indigo-600">
            <p class="text-gray-500 text-sm">Total Fasilitas</p>
            <p class="text-4xl font-bold text-indigo-700 mt-2">
                {{ \App\Models\Fasilitas::count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-600">
            <p class="text-gray-500 text-sm">Total Peminjaman</p>
            <p class="text-4xl font-bold text-green-600 mt-2">
                {{ \App\Models\Peminjaman::count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-600">
            <p class="text-gray-500 text-sm">Total Pengguna</p>
            <p class="text-4xl font-bold text-purple-600 mt-2">
                {{ \App\Models\User::count() }}
            </p>
        </div>

    </div>

    {{-- STATUS PEMINJAMAN --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-yellow-100 rounded-xl p-5 shadow">
            <p class="text-sm text-yellow-700">Menunggu Verifikasi</p>
            <p class="text-2xl font-bold text-yellow-800 mt-1">
                {{ \App\Models\Peminjaman::where('status','menunggu')->count() }}
            </p>
        </div>

        <div class="bg-green-100 rounded-xl p-5 shadow">
            <p class="text-sm text-green-700">Disetujui</p>
            <p class="text-2xl font-bold text-green-800 mt-1">
                {{ \App\Models\Peminjaman::where('status','disetujui')->count() }}
            </p>
        </div>

        <div class="bg-red-100 rounded-xl p-5 shadow">
            <p class="text-sm text-red-700">Ditolak</p>
            <p class="text-2xl font-bold text-red-800 mt-1">
                {{ \App\Models\Peminjaman::where('status','ditolak')->count() }}
            </p>
        </div>

    </div>

    {{-- PEMINJAMAN TERBARU --}}
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-lg font-semibold text-slate-800 mb-4">
            Peminjaman Terbaru
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Fasilitas</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @foreach(\App\Models\Peminjaman::latest()->take(5)->get() as $item)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3">
                            {{ $item->nama_peminjam }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->fasilitas->nama ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->tanggal_pinjam }}
                        </td>

                        <td class="px-4 py-3">
                            @if($item->status == 'menunggu')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                    Menunggu
                                </span>
                            @elseif($item->status == 'disetujui')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                    Disetujui
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection
