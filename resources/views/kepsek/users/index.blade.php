@extends('layouts.app')

@section('content')
<h3>Daftar User</h3>

<a href="{{ route('kepsek.users.create') }}" class="btn btn-primary mb-3">
    + Tambah User
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->id_user }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->role }}</td>
            <td>{{ $u->status }}</td>
            <td>
                <a href="{{ route('kepsek.users.edit', $u->id_user) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <form action="{{ route('kepsek.users.destroy', $u->id_user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus user?')" class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
