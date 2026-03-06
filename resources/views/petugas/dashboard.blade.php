@extends('layouts.petugas')

@section('content')
<div class="p-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard Petugas 👨‍💼
            </h1>
            <p class="text-gray-500 mt-1">
                Kelola dan verifikasi permohonan peminjaman sarana dan prasarana
            </p>
        </div>

        <a href="{{ route('petugas.verifikasi') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow transition">
            + Verifikasi Sekarang
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-6">

        {{-- MENUNGGU --}}
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Permohonan</p>
            <h2 class="text-lg font-semibold">Menunggu Verifikasi</h2>
            <p class="text-4xl font-bold mt-4">{{ $menunggu }}</p>
        </div>

        {{-- DISETUJUI --}}
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Permohonan</p>
            <h2 class="text-lg font-semibold">Disetujui</h2>
            <p class="text-4xl font-bold mt-4">{{ $disetujui }}</p>
        </div>

        {{-- MENUNGGU VERIFIKASI PEMBAYARAN --}}
<div class="bg-gradient-to-r from-purple-500 to-violet-600 text-white p-6 rounded-2xl shadow-lg">
    <p class="text-sm opacity-80">Pembayaran</p>
    <h2 class="text-lg font-semibold">Menunggu Verifikasi</h2>
    <p class="text-4xl font-bold mt-4">{{ $menungguPembayaran }}</p>
</div>

{{-- MENUNGGU VERIFIKASI PENGEMBALIAN --}}
<div class="bg-gradient-to-r from-orange-500 to-red-500 text-white p-6 rounded-2xl shadow-lg">
    <p class="text-sm opacity-80">Pengembalian</p>
    <h2 class="text-lg font-semibold">Menunggu Verifikasi</h2>
    <p class="text-4xl font-bold mt-4">{{ $menungguPengembalian }}</p>
</div>

        {{-- DITOLAK --}}
        <div class="bg-gradient-to-r from-red-500 to-rose-600 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Permohonan</p>
            <h2 class="text-lg font-semibold">Ditolak</h2>
            <p class="text-4xl font-bold mt-4">{{ $ditolak }}</p>
        </div>

        {{-- DIPINJAM --}}
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Fasilitas</p>
            <h2 class="text-lg font-semibold">Sedang Dipinjam</h2>
            <p class="text-4xl font-bold mt-4">{{ $dipinjam }}</p>
        </div>

    </div>

    {{-- RINGKASAN AKTIVITAS --}}
    <div class="mt-12 grid md:grid-cols-2 gap-8">

        {{-- CARD INFO --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 border">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                📌 Tugas Hari Ini
            </h3>

            <ul class="space-y-3 text-gray-600">
                <li>• Periksa permohonan baru</li>
                <li>• Verifikasi dokumen pemohon</li>
                <li>• Update status fasilitas</li>
                <li>• Pastikan pembayaran sudah valid</li>
            </ul>

            <div class="mt-6">
                <a href="{{ route('petugas.verifikasi') }}"
                   class="text-indigo-600 font-medium hover:underline">
                    Lihat Permohonan →
                </a>
            </div>
        </div>

        {{-- PROGRESS --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 border">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">
                📊 Ringkasan Proses
            </h3>

            <div class="space-y-4">

                {{-- MENUNGGU --}}
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Menunggu</span>
                        <span>{{ $menunggu }}</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-yellow-500 h-2 rounded-full"
                             style="width: {{ $menunggu > 0 ? 80 : 0 }}%"></div>
                    </div>
                </div>

                {{-- DISETUJUI --}}
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Disetujui</span>
                        <span>{{ $disetujui }}</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-green-500 h-2 rounded-full"
                             style="width: {{ $disetujui > 0 ? 70 : 0 }}%"></div>
                    </div>
                </div>

                {{-- DITOLAK --}}
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Ditolak</span>
                        <span>{{ $ditolak }}</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-red-500 h-2 rounded-full"
                             style="width: {{ $ditolak > 0 ? 40 : 0 }}%"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
