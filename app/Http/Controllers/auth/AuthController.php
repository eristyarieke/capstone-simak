<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* =====================
       FORM LOGIN
    ===================== */
    public function showLogin()
    {
        return view('auth.login');
    }

    /* =====================
       PROSES LOGIN
    ===================== */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // hanya user aktif yang boleh login
        $credentials['status'] = 'aktif';

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ]);
        }

        $request->session()->regenerate();

        $role = Auth::user()->role;

        return match ($role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'guru'   => redirect()->route('guru.dashboard'),
            'kepsek' => redirect()->route('kepsek.dashboard'),
            default  => $this->logoutAndFail($request),
        };
    }

    /* =====================
       LOGOUT
    ===================== */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function logoutAndFail(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('login')
            ->withErrors(['role' => 'Role tidak valid']);
    }
}
