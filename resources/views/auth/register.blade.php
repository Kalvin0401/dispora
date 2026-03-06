@extends('layouts.auth')

@section('title', 'Registrasi - SIP DISPORA')

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


    <!-- Logo -->
    <div class="text-center mb-6">
        <img src="{{ asset('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEipGdZbU9mvE_RYs2GPkq5_PQ6R_JxZCNdfWGaywq5GMkDlt4wgjMoeXy0vppUikPH3n8DXWVN7f_gEJgvGHuIttxlH7JiOohvWkra1I6LUEIc6_BZ6PumjeZOOW2ws9r4MZYWHZHFkG9yvTOGGHfqByimUsS2r3-nNQbRUfhsmsr9dCafmx_KTug/s1404/Logo%20Provinsi%20Jambi.png') }}"
             class="h-16 mx-auto mb-3">

        <h2 class="text-2xl font-bold text-slate-800">
            Registrasi Akun
        </h2>

        <p class="text-gray-500 text-sm">
            Sistem Informasi Peminjaman Sarana & Prasarana Olahraga
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Nama Lengkap
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-slate-700 focus:outline-none">
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-slate-700 focus:outline-none">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">
                Password
            </label>
            <input type="password"
                   name="password"
                   required
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-slate-700 focus:outline-none">
        </div>

        <!-- Konfirmasi Password -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">
                Konfirmasi Password
            </label>
            <input type="password"
                   name="password_confirmation"
                   required
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-slate-700 focus:outline-none">
        </div>

        <!-- Button -->
        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white py-2 rounded-lg transition">
                Daftar Sekarang
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-4 text-sm">
            <span class="text-gray-600">
                Sudah memiliki akun?
            </span>
            <a href="{{ route('login') }}"
               class="text-yellow-500 font-semibold hover:underline">
                Login
            </a>
        </div>

    </form>

@endsection
