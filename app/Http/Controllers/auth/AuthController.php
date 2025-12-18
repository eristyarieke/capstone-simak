<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Cek jika user tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan.');
        }

        // Cek password (hash)
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.');
        }

        // Cek status user
        if ($user->status === 'nonaktif') {
            return back()->with('error', 'Akun ini dinonaktifkan.');
        }

        // ✅ LOGIN PAKAI LARAVEL AUTH, BUKAN SESSION MANUAL
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect ke dashboard sesuai role
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'guru') {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('siswa.dashboard');
        }
    }

    public function logout(Request $request)
    {
        // ✅ LOGOUT PAKAI AUTH
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
