<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col">

        <!-- Logo -->
        <div class="p-6 text-center border-b border-slate-700">
            <img src="{{ asset('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEipGdZbU9mvE_RYs2GPkq5_PQ6R_JxZCNdfWGaywq5GMkDlt4wgjMoeXy0vppUikPH3n8DXWVN7f_gEJgvGHuIttxlH7JiOohvWkra1I6LUEIc6_BZ6PumjeZOOW2ws9r4MZYWHZHFkG9yvTOGGHfqByimUsS2r3-nNQbRUfhsmsr9dCafmx_KTug/s1404/Logo%20Provinsi%20Jambi.png') }}"
                 class="h-14 mx-auto mb-2">
            <h2 class="font-bold text-yellow-400">
                SIP DISPORA
            </h2>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                 Dashboard
            </a>

            <a href="{{ route('admin.fasilitas.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                 Kelola Fasilitas
            </a>

            <a href="{{ route('admin.peminjaman.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                 Data Peminjaman
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                 Data Pengguna
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                Laporan
            </a>

        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-slate-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
