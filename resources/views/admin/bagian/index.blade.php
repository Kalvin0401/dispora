@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Kelola Tarif - {{ $fasilitas->nama }}
</h1>

<a href="{{ route('admin.bagian.create', $fasilitas->id) }}"
   class="bg-slate-900 text-white px-4 py-2 rounded mb-4 inline-block">
   + Tambah Tarif
</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-slate-900 text-white">
        <tr>
            <th class="p-3">Nama Bagian</th>
            <th class="p-3">Harga</th>
            <th class="p-3">Satuan</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bagian as $item)
        <tr class="border-b">
            <td class="p-3">{{ $item->nama_bagian }}</td>
            <td class="p-3">
                Rp {{ number_format($item->harga,0,',','.') }}
            </td>
            <td class="p-3">{{ $item->satuan }}</td>
            <td class="p-3">
                <a href="{{ route('admin.bagian.edit',$item->id) }}"
                   class="bg-yellow-400 px-3 py-1 rounded text-sm">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
