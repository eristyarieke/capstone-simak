@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Daftar Artikel & Berita
</h2>

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="text-gray-500 text-sm">
            Kelola konten artikel dan berita sekolah.
        </div>
        <a href="{{ route('admin.kelola-halaman.artikel.create') }}" class="btn-success">
            + Tulis Artikel Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Penulis / Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artikel as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($a->thumbnail)
                                <img src="{{ asset('storage/' . $a->thumbnail) }}" 
                                     class="h-16 w-24 object-cover rounded shadow-sm border border-gray-200" 
                                     alt="Thumb">
                            @else
                                <div class="h-16 w-24 bg-gray-100 flex items-center justify-center text-xs text-gray-400 rounded">No Image</div>
                            @endif
                        </td>
                        <td class="max-w-xs font-bold text-gray-800">
                            {{ $a->judul }}
                        </td>
                        <td>
                            <div class="text-sm font-semibold text-gray-700">{{ $a->penulis }}</div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($a->tanggal_publish)->translatedFormat('d M Y') }}
                            </div>
                        </td>
                        <td>
                            @if($a->status == 'publish')
                                <span class="badge bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">Publish</span>
                            @else
                                <span class="badge bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="flex gap-3 items-center mt-4">
                            <a href="{{ route('admin.kelola-halaman.artikel.edit', $a->id) }}" 
                               class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.kelola-halaman.artikel.destroy', $a->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus artikel ini?')">
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
                        <td colspan="6" class="text-center py-8 text-gray-400">
                            Belum ada artikel yang ditulis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection