@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Data Pengumuman</h3>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM TAMBAH --}}
        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Isi Pengumuman</label>
                <textarea name="isi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <button class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah
            </button>
        </form>

        <hr>

        {{-- TABEL --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengumuman as $no => $p)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $p->judul }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.pengumuman.edit', $p->id_pengumuman) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.pengumuman.delete', $p->id_pengumuman) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus pengumuman ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
