@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Profile Sekolah</h3>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Sekolah</label>
                <input type="text" name="nama_sekolah"
                       value="{{ old('nama_sekolah', $profile->nama_sekolah ?? '') }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="telp"
                       value="{{ old('telp', $profile->telp ?? '') }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $profile->email ?? '') }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Visi</label>
                <textarea name="visi" class="form-control">{{ old('visi', $profile->visi ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Misi</label>
                <textarea name="misi" class="form-control">{{ old('misi', $profile->misi ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Logo Sekolah</label><br>
                @if (!empty($profile->logo))
                    <img src="/img/{{ $profile->logo }}" width="80"><br><br>
                @endif
                <input type="file" name="logo">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>

        </form>

    </div>
</div>

@endsection
