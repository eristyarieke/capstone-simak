@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-1">Manajemen Data Guru</h2>
    <h4 class="mb-4">Tambah Data Guru</h4>
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

    <form action="{{ route('admin.guru.store') }}" method="POST">
        @csrf

       

        {{-- Nama Lengkap --}}
        <div class="mb-3">
            <label class="form-label">Nama Lengkap (beserta gelar) :</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
        </div>

        {{-- Jabatan --}}
        <div class="mb-3">
            <label class="form-label">Jabatan :</label>
            <select name="jabatan" class="form-control">
                <option value="">Pilih Jabatan</option>
                @foreach ($jabatan as $j)
                    <option value="{{ $j }}" {{ old('jabatan') == $j ? 'selected' : '' }}>
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
                    <option value="{{ $s }}" {{ old('status_kepegawaian') == $s ? 'selected' : '' }}>
                        {{ $s }}
                    </option>
                @endforeach
            </select>
        </div>

        

        <button type="submit" class="btn btn-primary">Tambahkan Data</button>
        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
