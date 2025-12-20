@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">Kelola Banner (Slider)</h2>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-500">Daftar banner yang tampil di halaman utama.</p>
        <a href="{{ route('admin.halaman.banner.create') }}" class="btn-success">
            + Tambah Banner
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full text-left">
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
                <tr class="border-b">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="Banner" class="w-24 h-16 object-cover rounded">
                    </td>
                    <td>
                        <div class="font-bold">{{ $b->judul }}</div>
                        <div class="text-sm text-gray-500">{{ $b->subjudul }}</div>
                    </td>
                    <td>
                        <span class="px-2 py-1 rounded text-xs text-white {{ $b->status == 'aktif' ? 'bg-green-500' : 'bg-gray-400' }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </td>
                    <td class="flex gap-3">
                        <a href="{{ route('admin.halaman.banner.edit', $b->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.halaman.banner.destroy', $b->id) }}" onsubmit="return confirm('Hapus banner ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-400">Belum ada banner</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection