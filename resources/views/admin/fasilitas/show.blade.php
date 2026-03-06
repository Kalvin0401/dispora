@extends('layouts.dashboard')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">

    <div class="bg-white shadow-xl rounded-2xl p-8 border">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Detail Fasilitas
            </h1>

            <a href="{{ route('admin.fasilitas.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                ← Kembali
            </a>
        </div>

        <div class="grid grid-cols-2 gap-6">

    @if($fasilitas->foto)
    <img src="{{ asset('storage/'.$fasilitas->foto) }}"
         class="w-full h-64 object-cover rounded-xl mb-6">
@else
    <div class="w-full h-64 bg-gray-200 rounded-xl mb-6 flex items-center justify-center">
        <span class="text-gray-500">Tidak ada foto</span>
    </div>
@endif


            <div>
                <p class="text-sm text-gray-500">Nama Fasilitas</p>
                <p class="text-lg font-semibold">{{ $fasilitas->nama }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jenis</p>
                <p class="text-lg font-semibold">{{ $fasilitas->jenis }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Lokasi</p>
                <p class="text-lg font-semibold">{{ $fasilitas->lokasi }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tarif</p>
                <p class="text-lg font-semibold">
                      Rp {{ number_format($bagian_fasilitas->harga,0,',','.') }}
                        / {{ $bagian_fasilitas->satuan }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>

                @if($fasilitas->status == 'tersedia')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Tersedia
                    </span>
                @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                        Sedang Dipinjam
                    </span>
                @endif
            </div>

            <div>
                <p class="text-sm text-gray-500">Dibuat Pada</p>
                <p class="text-lg font-semibold">
                    {{ optional($fasilitas->created_at)->format('d M Y') }}
                </p>
            </div>

        </div>

        <div class="mt-8 border-t pt-6 flex gap-3">

            <a href="{{ route('admin.fasilitas.edit', $fasilitas->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                Edit
            </a>

            <form action="{{ route('admin.fasilitas.destroy', $fasilitas->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                    Hapus
                </button>
            </form>

        </div>

    </div>

</div>
@endsection

