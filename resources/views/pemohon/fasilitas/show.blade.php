@extends('layouts.app')

@section('content')

<div class="p-6 max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        {{-- FOTO --}}
        <div class="relative">
            @if($fasilitas->foto)
                <img src="{{ asset('storage/'.$fasilitas->foto) }}"
                     class="w-full h-80 object-cover">
            @else
                <div class="w-full h-80 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">Tidak ada foto</span>
                </div>
            @endif

            <div class="absolute top-4 right-4">
                <span class="px-4 py-1 rounded-full text-sm font-semibold
                    {{ $fasilitas->status == 'tersedia'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($fasilitas->status) }}
                </span>
            </div>
        </div>

        {{-- DETAIL --}}
        <div class="p-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                {{ $fasilitas->nama }}
            </h1>

            <div class="grid md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p class="text-sm text-gray-500">Jenis Fasilitas</p>
                    <p class="font-semibold text-lg">
                        {{ $fasilitas->jenis }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Lokasi</p>
                    <p class="font-semibold text-lg">
                        {{ $fasilitas->lokasi }}
                    </p>
                </div>

                <div>
    <p class="text-sm text-gray-500 mb-2">Daftar Tarif</p>

    @foreach($fasilitas->bagian as $bagian)
        <div class="mb-2">
            <p class="font-medium">
                {{ $bagian->nama_bagian }}
            </p>
            <p class="text-indigo-600 font-semibold">
                Rp {{ number_format($bagian->harga,0,',','.') }}
                / {{ $bagian->satuan }}
            </p>
        </div>
    @endforeach
</div>


            </div>

            {{-- BUTTON --}}
            <div class="mt-8 flex gap-4">

                @if($fasilitas->status == 'tersedia')
                    <a href="{{ route('pemohon.peminjaman.create', ['fasilitas_id' => $fasilitas->id]) }}">
                        Ajukan Peminjaman
                    </a>

                @else
                    <button disabled
                        class="px-6 py-3 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                        Sedang Dipinjam
                    </button>
                @endif

                <a href="{{ route('pemohon.fasilitas') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Kembali
                </a>

            </div>

        </div>

    </div>

</div>

@endsection
