<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DISPORA</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div x-data="{ open: true }" class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside :class="open ? 'w-64' : 'w-20'"
           class="bg-slate-900 text-white transition-all duration-300 flex flex-col">

        <!-- Logo -->
        <div class="p-4 flex items-center justify-between">
            <span x-show="open" class="text-lg font-bold">DISPORA</span>
            <button @click="open = !open"
                class="text-white focus:outline-none">
                ☰
            </button>
        </div>

        <!-- Menu -->
       <nav class="mt-6 flex-1 space-y-1">

    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}"
       class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition
              {{ request()->routeIs('*.dashboard') ? 'bg-slate-800' : '' }}">
        
        <span x-show="open" class="ml-3">Dashboard</span>
    </a>

    <!-- Lihat Fasilitas -->
    <a href="{{ route('pemohon.fasilitas') }}"
       class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition
              {{ request()->routeIs('pemohon.fasilitas*') ? 'bg-slate-800' : '' }}">
       
        <span x-show="open" class="ml-3">Lihat Sarana & Prasarana</span>
    </a>

    <!-- Status Peminjaman -->
    <a href="{{ route('pemohon.peminjaman.index') }}"
       class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition
              {{ request()->routeIs('pemohon.peminjaman.*') ? 'bg-slate-800' : '' }}">
       
        <span x-show="open" class="ml-3">Status Peminjaman</span>
    </a>

    <!-- Pembayaran -->
    <a href="{{ route('pemohon.pembayaran.index') }}"
       class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition
              {{ request()->routeIs('pemohon.pembayaran.*') ? 'bg-slate-800' : '' }}">
       
        <span x-show="open" class="ml-3">Pembayaran</span>
    </a>

    <!-- Pengembalian -->
    <a href="{{ route('pemohon.pengembalian.index') }}"
       class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition
              {{ request()->routeIs('pemohon.pengembalian.*') ? 'bg-slate-800' : '' }}">
       
        <span x-show="open" class="ml-3">Pengembalian</span>
    </a>


     <a href="{{ route('pemohon.riwayat.index') }}"
               class="flex items-center px-4 py-3 hover:bg-slate-800 transition">
                
                <span x-show="open" class="ml-3">Riwayat</span>
            </a>
</nav>

           


        <!-- Logout -->
        <div class="p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded transition">
                    <span x-show="open">Logout</span>
                    <span x-show="!open">🚪</span>
                </button>
            </form>
        </div>

    </aside>


    <!-- CONTENT -->
    <main class="flex-1 overflow-y-auto p-6 transition-all duration-300">
        @yield('content')
    </main>

</div>

<!-- AlpineJS (wajib untuk toggle) -->
<script src="//unpkg.com/alpinejs" defer></script>
@stack('scripts')

</body>
</html>
