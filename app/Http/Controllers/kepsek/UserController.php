<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Mengelola Pengguna',
            'sidebar' => 'layouts.sidebar-kepsek',
            'users' => User::all()
        ];

        return view('kepsek.users.index', $data);
    }

    public function create()
    {
        return view('kepsek.users.create', [
            'title' => 'Tambah User',
            'sidebar' => 'layouts.sidebar-kepsek'
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
           // 'username' => 'required|unique:users',
           // 'password' => 'required|min:6',
           // 'role' => 'required',
           // 'status' => 'required'
        //])

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status
        ]);

        return redirect()->route('kepsek.users.index')
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

        // Jika password diisi, update password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('kepsek.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('kepsek.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
