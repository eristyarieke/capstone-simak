@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">{{ $title }}</h2>
        <a href="{{ route('kepsek.users') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('kepsek.users.store') }}" method="POST">
            @csrf

            {{-- Username --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input type="text" name="username" id="username" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border"
                    placeholder="Masukkan username">
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border"
                    placeholder="Masukkan password minimal 6 karakter">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Role --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                        Role
                    </label>
                    <select name="role" id="role" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border bg-white">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="kepsek">Kepsek</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select name="status" id="status" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border bg-white">
                        <option value="aktif">Aktif</option>
                        <option value="non-aktif">Non-Aktif</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('kepsek.users') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection