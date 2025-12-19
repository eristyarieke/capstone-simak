@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Data Siswa</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

     <form method="GET"
      action="{{ route('admin.siswa.index') }}"
      class="mb-3 d-flex align-items-center gap-2 flex-wrap">

    <input type="text"
           name="q"
           value="{{ $q ?? '' }}"
           placeholder="Cari nama / kelas"
           class="form-control"
           style="max-width: 300px;">

    <button class="btn btn-primary">Cari</button>

    <a href="{{ route('admin.siswa.index') }}"
       class="btn btn-secondary">Reset</a>
</form>
    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Tahun Masuk</th>
                <th>Agama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $item)
                <tr>
                    <td>{{ $item->id_siswa }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $item->tahun_masuk }}</td>
                    <td>{{ $item->agama }}</td>
                    <td>
                        <a href="{{ route('admin.siswa.edit', $item->id_siswa) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form method="POST" action="{{ route('admin.siswa.destroy', $item->id_siswa) }}" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data ini?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
