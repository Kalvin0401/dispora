@extends('layouts.petugas')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">💳 Verifikasi Pembayaran</h1>
        <p class="text-sm opacity-90 mt-1">
            Pembayaran yang menunggu konfirmasi petugas.
        </p>
    </div>

    @forelse($data as $item)

    <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- SUMMARY -->
        <div class="p-6 flex justify-between items-center cursor-pointer"
             @click="open = !open">

            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    {{ $item->peminjaman->fasilitas->nama }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ $item->peminjaman->nama_peminjam }}
                </p>

                <p class="mt-2 text-indigo-600 font-bold text-xl">
                    Rp {{ number_format($item->jumlah,0,',','.') }}
                </p>
            </div>

            <div class="text-right">
                <span class="px-4 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                    Menunggu Verifikasi
                </span>

                <p class="text-xs text-gray-400 mt-2">
                    Klik untuk detail
                </p>
            </div>
        </div>

        <!-- DETAIL SECTION -->
        <div x-show="open" x-transition class="border-t bg-gray-50 p-6 space-y-6">

            <!-- DETAIL PEMINJAMAN -->
            <div class="grid md:grid-cols-2 gap-6 text-sm">

                <div>
                    <p class="text-gray-500">Nama Peminjam</p>
                    <p class="font-semibold">
                        {{ $item->peminjaman->nama_peminjam }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">No HP</p>
                    <p class="font-semibold">
                        {{ $item->peminjaman->no_hp }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal Pinjam</p>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Durasi</p>
                    <p class="font-semibold">
                        {{ $item->peminjaman->durasi }}
                        {{ $item->peminjaman->bagian->satuan ?? 'hari' }}
                    </p>
                </div>

            </div>

           <div x-data="{ showImage: false }">

    <p class="text-gray-600 font-semibold mb-2">Bukti Transfer</p>

    @if(!empty($item->bukti_bayar))
        <!-- Thumbnail -->
        <img src="{{ asset('storage/'.$item->bukti_bayar) }}"
             @click="showImage = true"
             class="w-64 rounded-xl shadow-lg border cursor-pointer hover:scale-105 transition duration-200">
    @else
        <p class="text-red-500 text-sm">Bukti tidak ditemukan</p>
    @endif

    <!-- Modal -->
    <div x-show="showImage"
         x-transition
         class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
         @click.self="showImage = false">

        <div class="relative">
            <img src="{{ asset('storage/'.$item->bukti_bayar) }}"
                 class="max-w-4xl max-h-[90vh] rounded-xl shadow-2xl border">

            <button @click="showImage = false"
                    class="absolute top-2 right-2 bg-red-600 text-white w-8 h-8 rounded-full">
                ✕
            </button>
        </div>
    </div>

</div>

            <!-- ACTION BUTTON -->
            <div class="flex gap-4 pt-4">

                <form action="{{ route('petugas.verifikasi.valid', $item->id) }}" method="POST">
                    @csrf
                    <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow text-sm">
                        ✔ Validasi Pembayaran
                    </button>
                </form>

                <form action="{{ route('petugas.verifikasi.tolak', $item->id) }}" method="POST">
                    @csrf
                    <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow text-sm">
                        ✖ Tolak Pembayaran
                    </button>
                </form>

            </div>

        </div>

    </div>

    @empty

    <div class="bg-white p-10 text-center rounded-2xl shadow text-gray-500">
        Tidak ada pembayaran yang perlu diverifikasi.
    </div>

    @endforelse

</div>

<!-- AlpineJS (untuk toggle) -->
<script src="//unpkg.com/alpinejs" defer></script>

@endsection