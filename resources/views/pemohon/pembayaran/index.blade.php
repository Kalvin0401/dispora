@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">💳 Pembayaran</h1>
        <p class="text-sm opacity-90 mt-1">
            Lakukan pembayaran dan unggah bukti transfer Anda.
        </p>
    </div>

    @forelse($data as $item)

    <div x-data="{ open:false }" class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $item->fasilitas->nama }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    • {{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}
                </p>

                <p class="mt-2 text-emerald-600 font-bold text-lg">
                    Rp {{ number_format($item->total_biaya,0,',','.') }}
                </p>
            </div>

            <!-- STATUS -->
            <div class="text-right space-y-2">

                @if($item->status == 'disetujui')
    <span class="px-4 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
        💳 Menunggu Pembayaran
    </span>

@elseif($item->status == 'dibayar')
    <span class="px-4 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">
        ⏳ Menunggu Verifikasi Pengembalian
    </span>

@elseif($item->status == 'menunggu_pengembalian')
    <span class="px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
        🔄 Menunggu Verifikasi Pengembalian
    </span>

@elseif($item->status == 'selesai')
    <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
        ✔ Selesai
    </span>
@endif

                <div>
                    <button @click="open = true"
                        class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg">
                        Lihat Detail
                    </button>
                </div>

            </div>

        </div>

        <!-- UPLOAD FORM -->
        @if($item->status == 'disetujui')

        <div class="mt-6 bg-gray-50 p-4 rounded-xl border">
            <h3 class="font-semibold text-gray-700 mb-2">Transfer ke Rekening:</h3>
            <p class="text-sm text-gray-600">
                Bank BRI - 1234567890 <br>
                a.n. DISPORA JAMBI
            </p>
        </div>

        <form action="{{ route('pemohon.pembayaran.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="mt-4">
            @csrf
            <input type="hidden" name="peminjaman_id" value="{{ $item->id }}">

            <div class="flex items-center gap-3">
                <input type="file"
                       name="bukti"
                       required
                       class="border rounded-lg px-3 py-2 text-sm">

                @error('bukti')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror

                <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm">
                    Upload Bukti
                </button>
            </div>
        </form>

        @endif

        <!-- MODAL DETAIL -->
        <div x-show="open"
             x-transition
             class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-xl relative">

                <button @click="open = false"
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                    ✖
                </button>

                <h3 class="text-lg font-semibold mb-4">Detail Pembayaran</h3>

                <div class="space-y-3 text-sm text-gray-700">

                    <div class="flex justify-between">
                        <span>Fasilitas</span>
                        <span class="font-medium">{{ $item->fasilitas->nama }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tanggal</span>
                        <span>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Durasi</span>
                        <span>{{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Total Biaya</span>
                        <span class="font-bold text-emerald-600">
                            Rp {{ number_format($item->total_biaya,0,',','.') }}
                        </span>
                    </div>

                    @if($item->pembayaran)
                    <div class="flex justify-between">
                        <span>Status Verifikasi</span>
                        <span class="font-semibold capitalize">
                            {{ $item->pembayaran->status }}
                        </span>
                    </div>
                    @endif

                </div>

                <!-- PREVIEW BUKTI -->
                @if($item->pembayaran && $item->pembayaran->bukti_bayar)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-2">Bukti Pembayaran:</p>
                    <img src="{{ asset('storage/'.$item->pembayaran->bukti_bayar) }}"
                         class="w-full rounded-lg shadow border">
                </div>
                @endif
    
            </div>
        </div>

    </div>

    @empty

    <div class="bg-white p-10 text-center rounded-xl shadow text-gray-500">
        Belum ada pembayaran.
    </div>

    @endforelse

</div>
@endsection