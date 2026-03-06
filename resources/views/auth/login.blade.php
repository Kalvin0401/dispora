@extends('layouts.auth')

@section('title', 'Login - SIP DISPORA')

@section('content')

 @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="text-center mb-6">
        <img src="{{ asset('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEipGdZbU9mvE_RYs2GPkq5_PQ6R_JxZCNdfWGaywq5GMkDlt4wgjMoeXy0vppUikPH3n8DXWVN7f_gEJgvGHuIttxlH7JiOohvWkra1I6LUEIc6_BZ6PumjeZOOW2ws9r4MZYWHZHFkG9yvTOGGHfqByimUsS2r3-nNQbRUfhsmsr9dCafmx_KTug/s1404/Logo%20Provinsi%20Jambi.png') }}"
             class="h-16 mx-auto mb-3">

        <h2 class="text-2xl font-bold text-slate-800">
            SIP DISPORA
        </h2>

        <p class="text-gray-500 text-sm">
            Sistem Informasi Peminjaman Sarana & Prasarana Olahraga
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-slate-700 focus:outline-none">
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">
                Password
            </label>
            <input type="password"
                   name="password"
                   required
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-slate-700 focus:outline-none">
        </div>

        <div class="flex items-center justify-between mt-4 text-sm">
            <label class="flex items-center">
                <input type="checkbox" name="remember"
                       class="rounded border-gray-300 text-slate-700 focus:ring-slate-700">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>

            <a href="#" class="text-slate-700 hover:underline">
                Lupa Password?
            </a>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white py-2 rounded-lg transition">
                Masuk Sistem
            </button>
        </div>

        <div class="text-center mt-4 text-sm">
            <span class="text-gray-600">
                Belum memiliki akun?
            </span>
            <a href="{{ route('register') }}"
               class="text-yellow-500 font-semibold hover:underline">
                Registrasi
            </a>
        </div>

    </form>

@endsection
