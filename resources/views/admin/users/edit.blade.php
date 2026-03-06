@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    <h1 class="text-xl font-bold mb-6">Edit Role Pengguna</h1>

    <div class="bg-white p-6 rounded-xl shadow max-w-md">

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium">Nama</label>
                <input type="text"
                       value="{{ $user->name }}"
                       disabled
                       class="w-full border rounded px-3 py-2 bg-gray-100">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium">Role</label>
                <select name="role"
                        class="w-full border rounded px-3 py-2">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6">
    <label class="block font-semibold mb-2">Permissions</label>

    <div class="grid grid-cols-3 gap-3">

        @foreach($permissions as $permission)
            <label class="flex items-center gap-2">
                <input type="checkbox"
                       name="permissions[]"
                       value="{{ $permission->name }}"
                       {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                {{ $permission->name }}
            </label>
        @endforeach

    </div>
</div>

            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

@endsection
