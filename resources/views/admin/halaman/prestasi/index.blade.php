@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Daftar Prestasi Siswa
</h2>

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="text-gray-500 text-sm">
            Daftar kejuaraan dan penghargaan yang diraih siswa.
        </div>
        <a href="{{ route('admin.kelola-halaman.prestasi.create') }}" class="btn-success">
            + Tambah Prestasi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul Prestasi & Siswa</th>
                    <th>Tingkat / Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prestasi as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" 
                                     class="h-16 w-16 object-cover rounded border border-gray-200" 
                                     alt="Foto">
                            @else
                                <span class="text-gray-400 text-xs">No Image</span>
                            @endif
                        </td>
                        <td>
                            <div class="font-bold text-gray-800">{{ $p->judul }}</div>
                            <div class="text-sm text-gray-600">
                                <i class="fa fa-user mr-1 text-gray-400"></i> {{ $p->nama_siswa }}
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-1">
                                <span class="badge bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded w-fit">
                                    {{ $p->tingkat }}
                                </span>
                                <span class="text-gray-500 text-sm font-semibold">
                                    {{ $p->tahun }}
                                </span>
                            </div>
                        </td>
                        <td class="flex gap-3 items-center mt-4">
                            <a href="{{ route('admin.kelola-halaman.prestasi.edit', $p->id) }}" 
                               class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.kelola-halaman.prestasi.destroy', $p->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus data prestasi ini?')">
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
                            Belum ada data prestasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection