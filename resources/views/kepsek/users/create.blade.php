@extends('layouts.app')

@section('content')
<h3>Tambah User</h3>

<form action="{{ route('kepsek.users.store') }}" method="POST">
    @csrf

    <label>Username</label>
    <input type="text" name="username" class="form-control" required>

    <label>Password</label>
    <input type="password" name="password" class="form-control" required>

    <label>Role</label>
    <select name="role" class="form-control" required>
        <option value="kepala_sekolah">Kepala Sekolah</option>
        <option value="guru">Guru</option>
        <option value="siswa">Siswa</option>
    </select>

    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>

    <br>
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
