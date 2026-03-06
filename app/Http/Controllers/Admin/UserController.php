<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles','permissions')->latest();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(5)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.edit', compact('user','roles','permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $user->syncRoles([$request->role]);

        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        } else {
            $user->syncPermissions([]);
        }

        return redirect()->route('admin.users.index')
            ->with('success','User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('error', 'Admin tidak bisa dihapus.');
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
