@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-1">Manajemen Data Mapel</h2>
    <h4 class="mb-4">Edit Data Mapel</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mapel.update', $mapel->id_mapel) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kode Mapel</label>
            <input type="text" name="kode_mapel" class="form-control"
                   value="{{ old('kode_mapel', $mapel->kode_mapel) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control"
                   value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran" class="form-control" required>
                <option value="">- Pilih Tahun Ajaran -</option>
                <option value="2024/2025" {{ old('tahun_ajaran', $mapel->tahun_ajaran) == '2024/2025' ? 'selected' : '' }}>
                    2024/2025
                </option>
                <option value="2025/2026" {{ old('tahun_ajaran', $mapel->tahun_ajaran) == '2025/2026' ? 'selected' : '' }}>
                    2025/2026
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Guru Pengampu</label>
            <select name="id_guru" class="form-control">
                <option value="">- Pilih Guru -</option>
                @foreach ($guru as $g)
                    <option value="{{ $g->id_guru }}"
                        {{ old('id_guru', $mapel->id_guru) == $g->id_guru ? 'selected' : '' }}>
                        {{ $g->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
