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
    <form class="d-flex align-items-center" method="GET">
    <input type="text" name="search" class="search-box" placeholder="Cari Jadwal Pelajaran">
    
    <button class="btn btn-primary" style="margin-left:10px;">Cari</button>

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
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($jadwal as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->kelas->nama_kelas }}</td>
                    <td>{{ $j->mapel->nama_mapel }}</td>
                    <td>{{ $j->guru->nama }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam_mulai }}</td>
                    <td>{{ $j->jam_selesai }}</td>
                    <td>{{ $j->ruang }}</td>
                   <td>
    <div class="action-buttons">

        <!-- Tombol Edit -->
        <a href="{{ route('jadwal.edit', $j->id_jadwal) }}" 
           class="icon-btn icon-edit">
            <i class="fas fa-edit"></i>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('jadwal.delete', $j->id_jadwal) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
            @csrf
            @method('DELETE')
            <button class="icon-btn icon-delete">
                <i class="fas fa-trash"></i>
            </button>
        </form>

    </div>
</td>


                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:20px;">
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
        + Tambah Jadwal Baru
    </a>
</div>

    </div>

</div>

@endsection
