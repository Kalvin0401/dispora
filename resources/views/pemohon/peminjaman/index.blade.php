@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">📊 Status Peminjaman</h1>
        <p class="text-sm opacity-90 mt-1">
            Pantau dan kelola seluruh pengajuan Anda.
        </p>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="bg-white p-4 rounded-xl shadow flex flex-col md:flex-row gap-4 justify-between">

        <form method="GET" class="flex gap-3">

            <select name="status"
                class="border rounded-lg px-3 py-2 text-sm">

                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>

            </select>

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari fasilitas..."
                   class="border rounded-lg px-3 py-2 text-sm">

            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">
                Filter
            </button>

        </form>

    </div>

    <!-- DATA CARD -->
    <div class="space-y-4">

        @forelse($data as $item)

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">

            <div class="flex justify-between items-start">

                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ $item->fasilitas->nama }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        • {{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}
                    </p>

                    <p class="mt-2 text-indigo-600 font-bold">
                        Rp {{ number_format($item->total_biaya,0,',','.') }}
                    </p>
                </div>

                <!-- STATUS BADGE -->
                <div>
                    @if($item->status == 'menunggu')
                        <span class="px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                            ⏳ Menunggu
                        </span>
                    @elseif($item->status == 'disetujui')
                        <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            ✔ Disetujui
                        </span>
                    @elseif($item->status == 'ditolak')
                        <span class="px-4 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                            ✖ Ditolak
                        </span>
                    @elseif($item->status == 'selesai')
                        <span class="px-4 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">
                            ✓ Selesai
                        </span>
                    @endif
                </div>

            </div>

            <!-- MINI PROGRESS -->
            <div class="mt-4 h-2 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-2 bg-indigo-600"
                    style="width:
                    @if($item->status=='menunggu')25%
                    @elseif($item->status=='disetujui')50%
                    @elseif($item->status=='selesai')100%
                    @else 100%
                    @endif">
                </div>
            </div>

            <!-- ACTION -->
            <div class="mt-4 flex gap-2">

                <a href="{{ route('pemohon.peminjaman.show',$item->id) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-xs">
                    Detail
                </a>

                <a href="{{ route('pemohon.peminjaman.download',$item->id) }}"
                   class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-lg text-xs">
                    Download PDF
                </a>

            </div>

        </div>

        @empty

        <div class="bg-white p-10 text-center rounded-xl shadow text-gray-500">
            Belum ada peminjaman.
        </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div>
        {{ $data->withQueryString()->links() }}
    </div>

</div>
@endsection