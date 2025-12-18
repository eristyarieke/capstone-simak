@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Data Guru</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.guru.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text"
                name="q"
                class="form-control"
                placeholder="Cari nama / jabatan / status..."
                value="{{ $q ?? request('q') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
            <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <a href="{{ route('admin.guru.create') }}" class="btn btn-primary mb-3 mt-2">
        + Tambah Data Guru
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guru as $g)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $g->nama }}</td>
                    <td>{{ $g->jabatan }}</td>
                    <td>{{ $g->status_kepegawaian }}</td>
                    <td>
                        <a href="{{ route('admin.guru.edit', $g->id_guru) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.guru.destroy', $g->id_guru) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data guru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
