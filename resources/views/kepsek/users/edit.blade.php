@extends('layouts.app')

@section('content')
<h3>Edit User</h3>

<form action="{{ route('kepsek.users.update', $user->id_user) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Username</label>
    <input type="text" name="username" value="{{ $user->username }}" class="form-control">

    <label>Password (Opsional)</label>
    <input type="password" name="password" class="form-control">

    <label>Role</label>
    <select name="role" class="form-control">
        <option value="kepala_sekolah" {{ $user->role=='kepala_sekolah'?'selected':'' }}>Kepala Sekolah</option>
        <option value="guru" {{ $user->role=='guru'?'selected':'' }}>Guru</option>
        <option value="siswa" {{ $user->role=='siswa'?'selected':'' }}>Siswa</option>
    </select>

    <label>Status</label>
    <select name="status" class="form-control">
        <option value="aktif" {{ $user->status=='aktif'?'selected':'' }}>Aktif</option>
        <option value="nonaktif" {{ $user->status=='nonaktif'?'selected':'' }}>Nonaktif</option>
    </select>

    <br>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
