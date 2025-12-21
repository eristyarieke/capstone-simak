@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Kelola Pengumuman
</h2>

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="text-gray-500 text-sm">
            Daftar pengumuman penting untuk siswa dan guru.
        </div>
        <a href="{{ route('admin.kelola-halaman.pengumuman.create') }}" class="btn-success">
            + Buat Pengumuman
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th class="w-12">No</th>
                    <th>Judul & Isi Singkat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengumuman as $p)
                    <tr class="hover:bg-gray-50 transition">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="font-bold text-gray-800 text-base mb-1">
                                {{ $p->judul }}
                            </div>
                            <div class="text-sm text-gray-500 line-clamp-2 max-w-lg">
                                {{ $p->isi }}
                            </div>
                        </td>
                        <td class="whitespace-nowrap text-gray-600 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d M Y') }}
                        </td>
                        <td>
                            @if($p->status == 'tampil')
                                <span class="badge bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                    Aktif
                                </span>
                            @else
                                <span class="badge bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.kelola-halaman.pengumuman.edit', $p->id) }}" 
                                   class="btn-sm bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded px-2 py-1 transition" 
                                   title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.kelola-halaman.pengumuman.destroy', $p->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded px-2 py-1 transition" 
                                            title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400 italic">
                            Belum ada pengumuman yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection