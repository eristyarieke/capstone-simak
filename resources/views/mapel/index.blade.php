@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Data Mata Pelajaran</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary mb-3">
        + Tambah Mapel
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Mapel</th>
                <th>Tahun Ajaran</th>
                <th>Guru</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mapel as $m)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $m->kode_mapel }}</td>
                    <td>{{ $m->nama_mapel }}</td>
                    <td>{{ $m->tahun_ajaran }}</td>
                    <td>{{ $m->guru?->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.mapel.edit', $m->id_mapel) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.mapel.destroy', $m->id_mapel) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Yakin hapus mapel ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data mapel.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
