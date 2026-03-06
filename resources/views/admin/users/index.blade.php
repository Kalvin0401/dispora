@extends('layouts.dashboard')

@section('content')

<div class="min-h-screen p-6 
            bg-gradient-to-br 
            from-slate-50 
            via-indigo-50 
            to-blue-100">

    {{-- HEADER --}}
    <div class="mb-6 p-6 rounded-2xl 
                bg-gradient-to-r 
                from-[#0f172a] 
                to-indigo-600 
                text-white shadow-xl">

        <h2 class="text-xl font-semibold">
            Manajemen Pengguna Sistem
        </h2>

        <p class="text-sm opacity-80 mt-1">
            Kelola role dan hak akses pengguna SIP DISPORA
        </p>
    </div>

    {{-- SEARCH --}}
    <div class="mb-4 flex justify-between items-center">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama / email..."
                   class="px-4 py-2 rounded-lg border 
                          focus:ring-2 focus:ring-indigo-400 outline-none">
            <button class="px-4 py-2 bg-indigo-500 text-white 
                           rounded-lg hover:bg-indigo-600 transition">
                Search
            </button>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="bg-white/70 backdrop-blur-xl 
                rounded-2xl shadow-2xl 
                border border-indigo-100 overflow-hidden">

        <table class="min-w-full text-sm">

            <thead class="bg-gradient-to-r 
                           from-[#0f172a] 
                           to-[#1e293b] 
                           text-white uppercase tracking-wide text-xs">

                <tr>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Permission</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>

            </thead>

            <tbody class="divide-y divide-indigo-100">

                @foreach($users as $user)
                <tr class="hover:bg-indigo-100/60 transition-all duration-300">

                    <td class="px-6 py-4 font-medium">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>

                    <td class="px-6 py-4">
                        @foreach($user->roles as $role)
                            <span class="px-3 py-1 text-xs font-semibold 
                                         bg-indigo-100 text-indigo-600 
                                         rounded-full">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($user->permissions as $permission)
                                <span class="px-2 py-1 text-xs 
                                             bg-emerald-100 
                                             text-emerald-600 
                                             rounded-full">
                                    {{ $permission->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center">

                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="px-3 py-1 text-xs font-semibold 
                                  bg-indigo-500 hover:bg-indigo-600 
                                  text-white rounded-lg shadow-md transition">
                            Edit
                        </a>

                        @if(!$user->hasRole('admin'))
                        <form action="{{ route('admin.users.destroy',$user->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus user ini?')"
                                    class="px-3 py-1 text-xs font-semibold 
                                           bg-rose-500 hover:bg-rose-600 
                                           text-white rounded-lg shadow-md transition">
                                Hapus
                            </button>
                        </form>
                        @endif

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>

@endsection
