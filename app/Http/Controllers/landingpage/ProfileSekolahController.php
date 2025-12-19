<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
use App\Models\ProfileSekolah;
use Illuminate\Http\Request;

class ProfileSekolahController extends Controller
{
    public function index()
    {
        $title = 'Kelola Profile Sekolah';
        $sidebar = 'layouts.sidebar-admin';

        // Ambil 1 data profile (biasanya hanya 1)
        $profile = ProfileSekolah::first();

        return view('admin.profile.index', compact(
            'title',
            'sidebar',
            'profile'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'email'        => 'required|email',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $profile = ProfileSekolah::first();

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $logo = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('img'), $logo);
            $data['logo'] = $logo;
        }

        $profile
            ? $profile->update($data)
            : ProfileSekolah::create($data);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profile sekolah berhasil diperbarui');
    }
}
