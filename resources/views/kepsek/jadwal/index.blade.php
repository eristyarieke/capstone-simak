@extends('layouts.app')
@section('content')

<h2 class="content-header">JADWAL PELAJARAN</h2>

{{-- Validasi & Notifikasi --}}
@if ($errors->any())
<div class="alert alert-danger" style="margin-top:15px;">
    <strong>Terjadi kesalahan:</strong>
    <ul style="margin:0;">
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success" style="margin-top:15px;">
    {{ session('success') }}
</div>
@endif

<div class="card">

    {{-- Form Pencarian --}}
    <form class="d-flex" method="GET" action="{{ route('jadwal.admin') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Jadwal Pelajaran" class="search-box">
        <button class="btn btn-primary">Cari</button>
    </form>

    <div class="table-wrapper" style="margin-top:20px;">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru Pengampu</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Ruang</th>
                </tr>
            </thead>

            <tbody>
                @forelse($jadwal as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->kelas->nama_kelas }}</td>
                    <td>{{ $j->mapel->nama_mapel }}</td>
                    <td>{{ $j->guru->nama_guru }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam_mulai }}</td>
                    <td>{{ $j->jam_selesai }}</td>
                    <td>{{ $j->ruang }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
