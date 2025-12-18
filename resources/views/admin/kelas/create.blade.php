@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-1">Manajemen Data Kelas</h2>
    <h4 class="mb-4">Tambah Data Kelas</h4>
    <p>Silahkan isi formulir berikut!</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control"
                   value="{{ old('nama_kelas') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Wali Kelas</label>
            <select name="wali_kelas" class="form-control">
                <option value="">- Pilih Wali Kelas -</option>
                @foreach ($guru as $g)
                    <option value="{{ $g->id_guru }}"
                        {{ old('wali_kelas') == $g->id_guru ? 'selected' : '' }}>
                        {{ $g->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
