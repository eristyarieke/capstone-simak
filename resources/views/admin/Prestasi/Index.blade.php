@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Data Prestasi</h3>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM TAMBAH --}}
        <form action="{{ route('admin.prestasi.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <select name="id_siswa" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $s)
                            <option value="{{ $s->id_siswa }}">{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="nama_prestasi" class="form-control" placeholder="Nama Prestasi" required>
                </div>
                <div class="col">
                    <input type="text" name="tingkat" class="form-control" placeholder="Tingkat" required>
                </div>
                <div class="col">
                    <input type="number" name="tahun" class="form-control" placeholder="Tahun" required>
                </div>
                <div class="col">
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                </div>
                <div class="col">
                    <button class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </div>
            </div>
        </form>

        <hr>

        {{-- TABEL --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Prestasi</th>
                    <th>Tingkat</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestasi as $no => $p)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $p->siswa->nama ?? '-' }}</td>
                    <td>{{ $p->nama_prestasi }}</td>
                    <td>{{ $p->tingkat }}</td>
                    <td>{{ $p->tahun }}</td>
                    <td>
                        <a href="{{ route('admin.prestasi.edit', $p->id_prestasi) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.prestasi.delete', $p->id_prestasi) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">
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
