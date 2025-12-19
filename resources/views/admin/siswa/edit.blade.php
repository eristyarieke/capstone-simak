@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Siswa</h3>

    <form method="POST" action="{{ route('admin.siswa.update', $siswa->id_siswa) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <select name="agama" class="form-control">
                @foreach ($agama as $ag)
                    <option value="{{ $ag }}" {{ $siswa->agama == $ag ? 'selected' : '' }}>
                        {{ $ag }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control">
                @foreach ($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ $k->id_kelas == $siswa->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tahun Masuk</label>
            <input type="text" name="tahun_masuk" class="form-control" value="{{ $siswa->tahun_masuk }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
