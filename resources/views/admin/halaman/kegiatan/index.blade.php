@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Daftar Kegiatan Sekolah
</h2>

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="text-gray-500 text-sm">
            Kelola dokumentasi kegiatan sekolah di sini.
        </div>
        <a href="{{ route('admin.kelola-halaman.kegiatan.create') }}" class="btn-success">
            + Tambah Kegiatan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul & Tanggal</th>
                    <th>Deskripsi Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kegiatan as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($k->foto)
                                <img src="{{ asset('storage/' . $k->foto) }}" 
                                     class="h-16 w-24 object-cover rounded border border-gray-200" 
                                     alt="Foto Kegiatan">
                            @else
                                <span class="text-gray-400 text-xs">No Image</span>
                            @endif
                        </td>
                        <td>
                            <div class="font-bold text-gray-800">{{ $k->judul }}</div>
                            <div class="text-sm text-gray-500 flex gap-2">
                                <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($k->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 rounded-full">{{ $k->tahun }}</span>
                            </div>
                        </td>
                        <td class="text-gray-600 text-sm max-w-xs truncate">
                            {{ Str::limit($k->deskripsi, 80) }}
                        </td>
                        <td class="flex gap-3 items-center mt-4">
                            <a href="{{ route('admin.kelola-halaman.kegiatan.edit', $k->id) }}" 
                               class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.kelola-halaman.kegiatan.destroy', $k->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus kegiatan ini?')">
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
                            Data kegiatan belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection