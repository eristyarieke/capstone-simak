@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    {{ $title }}
</h2>

<div class="bg-white rounded-lg shadow p-6">

    {{-- BAGIAN FILTER & SEARCH --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        
        {{-- Form Pencarian --}}
        <form action="{{ route('kepsek.users') }}" method="GET" class="flex items-center gap-2 w-full md:w-auto">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari username atau role..." 
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64"
            >
            
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('kepsek.users') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm transition">
                    Reset
                </a>
            @endif
        </form>

        {{-- Tombol Tambah --}}
        <a href="{{ route('kepsek.users.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition text-sm">
            + Tambah User
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Username</th>
                    <th class="py-3 px-6">Role</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6 font-medium">{{ $user->username }}</td>
                        <td class="py-3 px-6">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-3 px-6">
                            @if($user->status == 'aktif')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Aktif
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Non-Aktif
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-6 flex gap-3">
                            <a href="{{ route('kepsek.users.edit', $user->id_user) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('kepsek.users.destroy', $user->id_user) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete" class="text-red-600 hover:text-red-800">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400 bg-gray-50">
                            @if(request('search'))
                                Tidak ada user ditemukan dengan kata kunci "<strong>{{ request('search') }}</strong>".
                            @else
                                Data user belum tersedia.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection