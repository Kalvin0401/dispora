@extends('layouts.dashboard')

@section('title','Edit Tarif')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 text-slate-800">
        Edit Tarif Bagian
    </h1>

    <div class="bg-white shadow-lg rounded-xl p-6">

        <form action="{{ route('admin.bagian.update',$bagian->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Bagian --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">
                    Nama Bagian
                </label>
                <input type="text"
                       name="nama_bagian"
                       value="{{ $bagian->nama_bagian }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            {{-- Harga --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">
                    Harga
                </label>
                <input type="number"
                       name="harga"
                       value="{{ $bagian->harga }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            {{-- Satuan --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2">
                    Satuan
                </label>
                <select name="satuan"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        required>

                    <option value="jam" {{ $bagian->satuan == 'jam' ? 'selected' : '' }}>Jam</option>
                    <option value="hari" {{ $bagian->satuan == 'hari' ? 'selected' : '' }}>Hari</option>
                    <option value="orang" {{ $bagian->satuan == 'orang' ? 'selected' : '' }}>Orang</option>

                </select>
            </div>

            <div class="flex justify-between">

                <a href="{{ route('admin.bagian.index',$bagian->fasilitas_id) }}"
                   class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Kembali
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update Tarif
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
