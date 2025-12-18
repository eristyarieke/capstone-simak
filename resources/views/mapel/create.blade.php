@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-1">Manajemen Data Mapel</h2>
    <h4 class="mb-4">Tambah Data Mapel</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('admin.mapel.store') }}" method="POST">
        @csrf

        {{-- KODE MAPEL --}}
        <div class="mb-3">
            <label class="form-label">Kode Mapel</label>
            <input type="text" name="kode_mapel" class="form-control"
                value="{{ old('kode_mapel') }}" required>
        </div>

        {{-- NAMA MAPEL --}}
        <div class="mb-3">
            <label class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control"
                value="{{ old('nama_mapel') }}" required>
        </div>

        {{-- TAHUN AJARAN --}}
        <div class="mb-3">
            <label class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran" class="form-control" required>
                <option value="">- Pilih Tahun Ajaran -</option>
                <option value="2024/2025" {{ old('tahun_ajaran')=='2024/2025'?'selected':'' }}>
                    2024/2025
                </option>
                <option value="2025/2026" {{ old('tahun_ajaran')=='2025/2026'?'selected':'' }}>
                    2025/2026
                </option>
            </select>
        </div>

        {{-- GURU --}}
        <div class="mb-3">
            <label class="form-label">Guru Pengampu</label>
            <select name="id_guru" class="form-control" required>
                <option value="">- Pilih Guru -</option>
                @foreach ($guru as $g)
                    <option value="{{ $g->id_guru }}"
                        {{ old('id_guru') == $g->id_guru ? 'selected' : '' }}>
                        {{ $g->nama }} ({{ $g->nip ?? '-' }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>


</div>
@endsection
