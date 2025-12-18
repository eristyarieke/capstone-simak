@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Data Guru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.guru.update', $guru->id_guru) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NIP --}}
        <div class="mb-3">
            <label class="form-label">NIP :</label>
            <input type="text" name="nip" class="form-control"
                   value="{{ old('nip', $guru->nip) }}">
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <label class="form-label">Nama Lengkap (beserta gelar) :</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $guru->nama) }}">
        </div>

        {{-- Jabatan --}}
        <div class="mb-3">
            <label class="form-label">Jabatan :</label>
            <select name="jabatan" class="form-control">
                <option value="">Pilih Jabatan</option>
                @foreach ($jabatan as $j)
                    <option value="{{ $j }}"
                        {{ old('jabatan', $guru->jabatan) == $j ? 'selected' : '' }}>
                        {{ $j }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status Kepegawaian --}}
        <div class="mb-3">
            <label class="form-label">Status Kepegawaian :</label>
            <select name="status_kepegawaian" class="form-control">
                <option value="">Pilih Status</option>
                @foreach ($statusKepegawaian as $s)
                    <option value="{{ $s }}"
                        {{ old('status', $guru->status_kepegawaian) == $s ? 'selected' : '' }}>
                        {{ $s }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tugas Tambahan --}}
        <div class="mb-3">
            <label class="form-label">Tugas Tambahan :</label>
            <input type="text" name="tugas_tambahan" class="form-control"
                   value="{{ old('tugas_tambahan', $guru->tugas_tambahan) }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
