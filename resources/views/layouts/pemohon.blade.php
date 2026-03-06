<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-slate-900 text-white p-6">
        <h2 class="text-xl font-bold mb-6">SIP DISPORA</h2>

        <ul class="space-y-3">
            <li>
                <a href="{{ route('pemohon.dashboard') }}" class="block hover:text-yellow-400">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('pemohon.fasilitas') }}" class="block hover:text-yellow-400">
                    Lihat Fasilitas
                </a>
            </li>

            <li>
                <a href="{{ route('peminjaman.index') }}" class="block hover:text-yellow-400">
                    Riwayat Peminjaman
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}" class="block hover:text-yellow-400">
                    Profil
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-8">
        @yield('content')
    </div>

</div>

</body>
</html>
