@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            🏟️ Daftar Sarana dan Prasarana Olahraga
        </h1>
    </div>

    @if($fasilitas->count() == 0)
        <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
            Belum ada fasilitas tersedia.
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($fasilitas as $item)

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

            {{-- FOTO --}}
            <div class="h-48 bg-gray-100 overflow-hidden">
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            {{-- CONTENT --}}
            <div class="p-5">

                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $item->nama }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    📍 {{ $item->lokasi }}
                </p>

                <p class="text-sm text-gray-500">
                    🏷️ {{ $item->jenis }}
                </p>
 <p class="text-indigo-600 font-semibold">@if($item->bagian->count())
    Mulai Rp {{ number_format($item->harga_mulai,0,',','.') }}
@else
    <span class="text-gray-400">Belum ada tarif</span>
@endif</p>
                


                {{-- STATUS --}}
              

                {{-- BUTTON --}}
                <div class="mt-5 flex gap-2">

                    <a href="{{ route('pemohon.fasilitas.show', $item->id)}}"
                       class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg text-sm">
                        Detail
                    </a>

                    <a href="{{ route('pemohon.peminjaman.create', ['fasilitas_id' => $item->id]) }}"
   class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg text-sm">
    Ajukan
</a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection
