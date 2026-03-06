<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIP DISPORA Provinsi Jambi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

<!-- HEADER -->
<header class="bg-slate-900 text-white shadow-lg border-b-4 border-yellow-500">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">

        <div class="flex items-center gap-4">
           <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEipGdZbU9mvE_RYs2GPkq5_PQ6R_JxZCNdfWGaywq5GMkDlt4wgjMoeXy0vppUikPH3n8DXWVN7f_gEJgvGHuIttxlH7JiOohvWkra1I6LUEIc6_BZ6PumjeZOOW2ws9r4MZYWHZHFkG9yvTOGGHfqByimUsS2r3-nNQbRUfhsmsr9dCafmx_KTug/s1404/Logo%20Provinsi%20Jambi.png"
     class="h-10 w-auto object-contain">

            <div>
                <h1 class="text-xl font-bold text-yellow-400">
                    SIP DISPORA
                </h1>
                <p class="text-sm text-gray-300">
                    Sistem Informasi Peminjaman Sarana & Prasarana Olahraga
                </p>
            </div>
        </div>

        <nav class="flex gap-4 text-sm">
            <a href="/login"
               class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded shadow">
                Login
            </a>
            <a href="/register"
               class="bg-yellow-500 hover:bg-yellow-600 px-5 py-2 rounded text-black font-semibold shadow">
                Registrasi
            </a>
        </nav>

    </div>
</header>

<!-- HERO (lebih kecil agar tidak makan tempat) -->
<section class="text-center py-4 bg-white border-b">
    <h2 class="text-lg font-semibold text-gray-800">
        Informasi Ketersediaan Sarana & Prasarana
    </h2>
    <p class="text-xs text-gray-600">
        Data real-time transparansi layanan publik
    </p>
</section>

<!-- TABLE -->
<section class="container mx-auto px-6 py-4 flex-1">

    <div class="bg-white shadow rounded-lg flex flex-col h-[65vh]">

        <!-- WRAPPER SCROLL -->
        <div class="overflow-y-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-800 text-white sticky top-0 z-10">
                    <tr>
                        <th class="p-3 text-left">Fasilitas</th>
                        <th class="p-3 text-left">Lokasi</th>
                        <th class="p-3 text-left">Bagian</th>
                        <th class="p-3 text-center">Status</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($fasilitas as $item)

                    @php
                        $dipinjam = $item->peminjaman
    ->whereIn('status', ['disetujui','dibayar','menunggu_pengembalian'])
    ->count();
                    @endphp

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3 font-semibold">
                            {{ $item->nama }}
                        </td>

                        <td class="p-3">
                            {{ $item->lokasi }}
                        </td>

                     <td class="p-3 align-top space-y-2">

    @forelse($item->bagian as $b)

        @php
            $dipakai = \App\Models\Peminjaman::where('bagian_id', $b->id)
                ->whereIn('status', ['disetujui','','dibayar','dipinjam','menunggu_pengembalian'])
                ->exists();
        @endphp

        <div class="flex justify-between items-center p-2 border rounded-lg bg-gray-50 text-xs">

            <span class="font-medium text-gray-800">
                {{ $b->nama_bagian }}
            </span>

            @if($dipakai)
                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-[10px] font-semibold">
                    Tidak Tersedia
                </span>
            @else
                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-[10px] font-semibold">
                    Tersedia
                </span>
            @endif

        </div>

    @empty
        <span class="text-gray-400 text-xs italic">
            Tidak memiliki bagian
        </span>
    @endforelse

</td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="bg-slate-900 text-white border-t-4 border-yellow-500 mt-auto">

    <div class="container mx-auto px-6 py-8">

        <div class="flex flex-col items-center gap-3 text-center">

            

            <div class="text-sm text-gray-300">
                © {{ date('Y') }} SIP DISPORA
                <br>
                Seluruh Hak Cipta Dilindungi
            </div>

        </div>

    </div>

</footer>
</body>
</html>
