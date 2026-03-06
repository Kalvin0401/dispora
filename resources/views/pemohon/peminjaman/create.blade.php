@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="bg-white shadow-xl rounded-2xl p-8">

        <h1 class="text-center text-xl font-bold mb-8">
            FORM PEMAKAIAN FASILITAS DISPORA JAMBI
        </h1>
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
        <form action="{{ route('pemohon.peminjaman.store') }}" method="POST">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">

        {{-- NAMA FASILITAS --}}
{{-- NAMA FASILITAS --}}
<div>
    <label class="block text-sm font-medium mb-1">
        Nama Fasilitas*
    </label>

    <input type="text"
        value="{{ $selectedFasilitas?->nama }}"
        class="w-full border rounded-lg px-3 py-2 bg-gray-100"
        readonly>
</div>

{{-- Hidden fasilitas_id --}}
<input type="hidden"
       name="fasilitas_id"
       value="{{ $selectedFasilitas?->id }}">


{{-- FASILITAS --}}


<div>
    <label class="block text-sm font-medium mb-1">
        Pilih Bagian*
    </label>

    <select name="bagian_id"
            id="bagian_select"
            class="w-full border rounded-lg px-3 py-2"
            required>

        <option value="">-- Pilih Bagian --</option>

        @foreach($selectedFasilitas->bagian as $bagian)
    <option value="{{ $bagian->id }}"
            data-harga="{{ $bagian->harga }}"
            data-satuan="{{ $bagian->satuan }}">
        {{ $bagian->nama_bagian }}
    </option>
@endforeach



    </select>
</div>



                

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Acara / Kegiatan*
                    </label>
                    <input type="text" name="acara"
                        class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Organisasi
                    </label>
                    <input type="text" name="organisasi"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Jumlah Peserta*
                    </label>
                    <input type="number" name="jumlah_peserta"
                        class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Peminjam*
                    </label>
                    <input type="text" name="nama_peminjam"
                        value="{{ auth()->user()->name }}"
                        class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        No HP*
                    </label>
                    <input type="text" name="no_hp"
                        class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Hari & Tanggal Peminjaman*
                    </label>
                    <input type="date" name="tanggal_pinjam"
                        class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
    <label id="label_durasi" class="block text-sm font-medium mb-1">
        Durasi
    </label>

    <input type="number"
        name="durasi"
        id="durasi"
        min="1"
        class="w-full border rounded-lg px-3 py-2"
        required>
</div>


<div>
    <label class="block text-sm font-medium mb-1">
        Total Biaya
    </label>
    <input type="text"
        id="total_biaya_display"
        class="w-full border rounded-lg px-3 py-2 bg-gray-100"
        readonly>
</div>

<input type="hidden" name="total_biaya" id="total_biaya">


            </div>

            <div class="mt-8">
                <label class="block text-sm font-medium mb-1">
                    Catatan
                </label>
                <textarea name="catatan"
                    class="w-full border rounded-lg px-3 py-2"
                    rows="4"></textarea>
            </div>

            <div class="mt-8 text-right">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                    Kirim Pengajuan
                </button>
            </div>

        </form>

    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const bagianSelect = document.getElementById('bagian_select');
    const durasiInput = document.getElementById('durasi');
    const labelDurasi = document.getElementById('label_durasi');
    const biayaDisplay = document.getElementById('total_biaya_display');
    const biayaHidden = document.getElementById('total_biaya');

    if (!bagianSelect || !durasiInput) return;

    function updateForm() {

        const selectedOption = bagianSelect.options[bagianSelect.selectedIndex];

        const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
        const satuan = selectedOption.getAttribute('data-satuan') || '';

        const jumlah = parseInt(durasiInput.value) || 0;

        // Ubah label sesuai satuan
        if (satuan === 'hari') {
            labelDurasi.textContent = 'Durasi (Hari)';
        } 
        else if (satuan === 'jam') {
            labelDurasi.textContent = 'Durasi (Jam)';
        } 
        else if (satuan === 'orang') {
            labelDurasi.textContent = 'Jumlah Orang';
        } 
        else {
            labelDurasi.textContent = 'Jumlah';
        }

        // Hitung total
        const total = harga * jumlah;

        biayaDisplay.value = total.toLocaleString('id-ID');
        biayaHidden.value = total;
    }

    bagianSelect.addEventListener('change', function() {
        durasiInput.value = '';
        updateForm();
    });

    durasiInput.addEventListener('input', updateForm);

});
</script>
@endpush


</div>

@endsection
