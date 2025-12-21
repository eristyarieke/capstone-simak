@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Data Kelas
</h2>

<div class="bg-white rounded-lg shadow p-6">

    {{-- FILTER --}}
    <form method="GET" class="flex items-center gap-3 mb-6">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari kelas atau wali kelas..."
            class="input w-64"
        >

        <button class="btn-primary">Cari</button>

        <a href="{{ route('admin.kelas') }}" class="btn-light">
            Reset
        </a>

        <div class="ml-auto">
            <a href="{{ route('admin.kelas.create') }}" class="btn-success">
                + Tambah Kelas
            </a>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelas as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_kelas }}</td>
                        <td>{{ $k->waliKelas->nama ?? '-' }}</td>
                        <td class="flex gap-3">
                            <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}"
                               class="text-blue-600 hover:text-blue-800">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form
                                action="{{ route('admin.kelas.destroy', $k->id_kelas) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete text-red-600 hover:text-red-800">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">
                            Data kelas belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
