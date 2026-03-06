<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Petugas Layanan - Dispora</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col shadow-2xl">

    <!-- Header -->
    <div class="p-6 border-b border-blue-700">
        <h2 class="text-2xl font-bold tracking-wide">DISPORA</h2>
        <p class="text-sm text-blue-300">Petugas Layanan</p>
    </div>

    <!-- User -->
    <div class="p-6 border-b border-blue-700">
        <p class="text-sm text-blue-300">Login sebagai:</p>
        <p class="font-semibold">{{ auth()->user()->name }}</p>
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4 space-y-2">

        <a href="{{ route('petugas.dashboard') }}"
           class="block px-4 py-3 rounded-lg transition-all duration-200
           {{ request()->routeIs('petugas.dashboard') 
                ? 'bg-white text-blue-900 font-semibold shadow-md' 
                : 'hover:bg-blue-700' }}">
            Dashboard
        </a>

        <a href="{{ route('petugas.verifikasi') }}"
           class="block px-4 py-3 rounded-lg transition-all duration-200
           {{ request()->routeIs('petugas.verifikasi') 
                ? 'bg-white text-blue-900 font-semibold shadow-md' 
                : 'hover:bg-blue-700' }}">
            Verifikasi Permohonan
        </a>

        <a href="{{ route('petugas.verifikasi.index') }}"
           class="block px-4 py-3 rounded-lg transition-all duration-200
           {{ request()->routeIs('petugas.verifikasi.index') 
                ? 'bg-white text-blue-900 font-semibold shadow-md' 
                : 'hover:bg-blue-700' }}">
            Verifikasi Pembayaran
        </a>

        <a href="{{ route('petugas.pengembalian.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-700 transition">
            Pengembalian Fasilitas
        </a>

        <a href="{{ route('petugas.laporan.index') }}"
   class="block px-4 py-3 rounded-lg transition-all duration-200
   {{ request()->routeIs('petugas.laporan.*') 
        ? 'bg-white text-blue-900 font-semibold shadow-md' 
        : 'hover:bg-blue-700' }}">
    Laporan
</a>

    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg transition">
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
