@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Data Banner / Slider
</h2>

<div class="bg-white rounded-lg shadow p-6">

    {{-- FILTER & ACTION --}}
    <div class="flex items-center gap-3 mb-6">
        {{-- Jika ingin fitur search --}}
        {{-- 
        <form method="GET" class="flex items-center gap-3">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Cari judul banner..." 
                class="input w-64"
            >
            <button class="btn-primary">Cari</button>
        </form> 
        --}}

        <div class="ml-auto">
            <a href="{{ route('admin.kelola-halaman.banner.create') }}" class="btn-success">
                + Tambah Banner
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul & Subjudul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($banners as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($b->gambar)
                                <img src="{{ asset('storage/' . $b->gambar) }}" 
                                     alt="Banner" 
                                     class="h-16 w-24 object-cover rounded shadow-sm">
                            @else
                                <span class="text-gray-400 text-xs">No Image</span>
                            @endif
                        </td>
                        <td>
                            <div class="font-bold text-gray-800">{{ $b->judul }}</div>
                            <div class="text-sm text-gray-500">{{ $b->subjudul ?? '-' }}</div>
                        </td>
                        <td>
                            @if($b->status == 'aktif')
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-semibold">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="flex gap-3 items-center mt-4">
                            {{-- Edit --}}
                            <a href="{{ route('admin.kelola-halaman.banner.edit', $b->id) }}" 
                               class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.kelola-halaman.banner.destroy', $b->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus banner ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">
                            Data banner belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection