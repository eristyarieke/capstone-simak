@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Data Mata Pelajaran
</h2>

<div class="bg-white rounded-lg shadow p-6">

    {{-- FILTER --}}
    <form method="GET" class="flex items-center gap-3 mb-6">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari kode atau nama mapel..."
            class="input w-64"
        >

        <button class="btn-primary">Cari</button>

        <a href="{{ route('admin.mapel') }}" class="btn-light">
            Reset
        </a>

        <div class="ml-auto">
            <a href="{{ route('admin.mapel.create') }}" class="btn-success">
                + Tambah Mapel
            </a>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mapel as $m)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->kode_mapel }}</td>
                        <td>{{ $m->nama_mapel }}</td>
                        <td class="flex gap-3">
                            <a href="{{ route('admin.mapel.edit', $m->id_mapel) }}"
                               class="text-blue-600 hover:text-blue-800">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form
                                action="{{ route('admin.mapel.destroy', $m->id_mapel) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus mapel ini?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">
                            Data mata pelajaran belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
