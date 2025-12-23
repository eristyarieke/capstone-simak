<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tambahkan Request $request di parameter
    public function index(Request $request)
    {
        // Mulai query builder
        $query = User::query();

        // Cek apakah ada input pencarian 'search'
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Filter berdasarkan username ATAU role
            $query->where(function($q) use ($search) {
                $q->where('username', 'LIKE', '%' . $search . '%')
                  ->orWhere('role', 'LIKE', '%' . $search . '%');
            });
        }

        $data = [
            'title' => 'Mengelola Pengguna',
            'sidebar' => 'layouts.sidebar-kepsek',
            // Ambil data (gunakan paginate jika data banyak, atau get jika sedikit)
            'users' => $query->latest()->get() 
        ];

        return view('kepsek.users.index', $data);
    }

    // ... method create, store, edit, update, destroy tetap sama ...
    
    public function create()
    {
        return view('kepsek.users.create', [
            'title' => 'Tambah User',
            'sidebar' => 'layouts.sidebar-kepsek'
        ]);
    }

    public function store(Request $request)
    {
        // ... validasi sebaiknya di-uncomment ...

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status
        ]);

        return redirect()->route('kepsek.users')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('kepsek.users.edit', [
            'title' => 'Edit User',
            'sidebar' => 'layouts.sidebar-kepsek',
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        $user = User::findOrFail($id);

        $data = [
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('kepsek.users')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('kepsek.users')
            ->with('success', 'User berhasil dihapus!');
    }
}