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
        <form action="{{ route('kepsek.users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input type="text" name="username" id="username" value="{{ $user->username }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border">
            </div>

            {{-- Password (Optional) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password Baru
                </label>
                <input type="password" name="password" id="password"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border"
                    placeholder="Kosongkan jika tidak ingin mengganti password">
                <p class="text-xs text-gray-500 mt-1">*Hanya isi jika ingin mengubah password user.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Role --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                        Role
                    </label>
                    <select name="role" id="role" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border bg-white">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="kepsek" {{ $user->role == 'kepsek' ? 'selected' : '' }}>Kepsek</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select name="status" id="status" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border bg-white">
                        <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ $user->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
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
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection