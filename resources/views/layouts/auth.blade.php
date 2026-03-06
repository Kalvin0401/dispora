<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIP DISPORA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <!-- Tombol Back -->
    <div class="absolute top-6 left-6">
        <a href="{{ url('/') }}"
           class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg shadow transition">
            ← Kembali
        </a>
    </div>

    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8">
        @yield('content')
    </div>

</body>
</html>
