@extends('layouts.app')

@section('content')

<div class="p-6 space-y-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-indigo-700 to-purple-600 
                text-white rounded-2xl p-8 shadow-xl">

        <h1 class="text-3xl font-bold">
            👋 Halo, {{ auth()->user()->name }}
        </h1>

        <p class="mt-2 opacity-90">
            Selamat datang di Sistem Informasi Peminjaman Sarana dan Prasarana DISPORA
        </p>

    </div>

    {{-- STATISTIK MINI --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-indigo-600">
            <p class="text-sm text-gray-500">Total Pengajuan</p>
            <p class="text-3xl font-bold text-indigo-700 mt-2">
                {{ auth()->user()->peminjaman->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Disetujui</p>
            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ auth()->user()->peminjaman->where('status','disetujui')->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Ditolak</p>
            <p class="text-3xl font-bold text-red-600 mt-2">
                {{ auth()->user()->peminjaman->where('status','ditolak')->count() }}
            </p>
        </div>

    </div>

    {{-- CARD ALUR PEMINJAMAN --}}
   {{-- PROSES PEMINJAMAN INTERAKTIF --}}
<div x-data="{ activeStep: {{ $step }} }"
     class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">

    <div class="flex items-center justify-between mb-10">
        <h2 class="text-xl font-bold text-gray-800">
            🚀 Proses Peminjaman Anda
        </h2>

        <a href="{{ route('pemohon.fasilitas') }}"
           class="bg-gradient-to-r from-indigo-600 to-purple-600 
                  hover:from-indigo-700 hover:to-purple-700
                  text-white px-5 py-2 rounded-xl text-sm shadow-md transition">
            + Ajukan Peminjaman
        </a>
    </div>

    @php
        $steps = [
            1 => ['Ajukan', 'Menunggu verifikasi petugas'],
            2 => ['Disetujui', 'Silakan lakukan pembayaran'],
            3 => ['Pembayaran', 'Menunggu verifikasi pembayaran'],
            4 => ['Dipinjam', 'Fasilitas sedang digunakan'],
            5 => ['Selesai', 'Proses peminjaman selesai']
        ];
    @endphp

    {{-- STEP BAR --}}
    <div class="grid md:grid-cols-5 gap-6 text-center mb-10">

        @foreach($steps as $number => $data)

        <div @click="activeStep = {{ $number }}"
             class="cursor-pointer transition-all duration-300">

            <div class="mx-auto w-16 h-16 flex items-center justify-center
                rounded-full text-lg font-bold shadow-md
                transition-all duration-300"

                :class="{
                    'bg-gradient-to-r from-indigo-600 to-purple-600 text-white scale-110': activeStep == {{ $number }},
                    'bg-green-500 text-white': {{ $step }} > {{ $number }},
                    'bg-gray-200 text-gray-500': activeStep != {{ $number }} && {{ $step }} <= {{ $number }}
                }">

                <template x-if="{{ $step }} > {{ $number }}">
                    <span>✓</span>
                </template>

                <template x-if="{{ $step }} <= {{ $number }}">
                    <span>{{ $number }}</span>
                </template>

            </div>

            <p class="mt-3 text-sm font-semibold"
               :class="activeStep == {{ $number }} ? 'text-indigo-600' : 'text-gray-700'">
                {{ $data[0] }}
            </p>

        </div>

        @endforeach

    </div>

    {{-- DETAIL PROSES --}}
    <div class="bg-gradient-to-r from-gray-50 to-white border rounded-xl p-6 shadow-inner">

        @foreach($steps as $number => $data)

        <div x-show="activeStep == {{ $number }}" x-transition>

            <h3 class="text-lg font-bold text-indigo-600 mb-2">
                {{ $data[0] }}
            </h3>

            <p class="text-gray-600 mb-4">
                {{ $data[1] }}
            </p>

            {{-- Aksi berdasarkan status --}}
            @if($number == 2 && $step == 2)
                <a href="{{ route('pemohon.pembayaran.index') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                    Lanjut ke Pembayaran
                </a>
            @endif

            @if($number == 4 && $step == 4)
                <a href="{{ route('pemohon.pengembalian.index') }}"
                   class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm">
                    Ajukan Pengembalian
                </a>
            @endif

            @if($number == 5 && $step == 5)
                <div class="text-green-600 font-semibold">
                    ✔ Peminjaman telah selesai
                </div>
            @endif

        </div>

        @endforeach

    </div>

</div>

{{-- AlpineJS --}}
<script src="//unpkg.com/alpinejs" defer></script>



</div>

@endsection
