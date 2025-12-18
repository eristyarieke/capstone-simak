@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Manajemen Data Kelas</h2>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah --}}
    <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary mb-3">
        + Tambah Kelas
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th style="width: 60px;">No</th>
                <th>Nama Kelas</th>
                <th>Wali Kelas</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kelas as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>
                        {{ $k->wali ? $k->wali->nama : '-' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.kelas.destroy', $k->id_kelas) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Yakin hapus kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada data kelas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
