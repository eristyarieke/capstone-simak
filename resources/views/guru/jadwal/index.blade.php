@extends('layouts.app')

@section('content')

<h2 class="content-header">JADWAL PELAJARAN</h2>

{{-- ALERT --}}
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Terjadi kesalahan:</strong>
    <ul style="margin:0;">
        @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <form method="GET" class="filter-bar">
    <div class="filter-group">

        {{-- Search --}}
        <input type="text"
               name="search"
               class="search-box"
               placeholder="Cari kelas, mapel, atau guru..."
               value="{{ request('search') }}">

        {{-- Filter Hari --}}
        <select name="hari" class="filter-select">
            <option value="">Semua Hari</option>
            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>
                    {{ $h }}
                </option>
            @endforeach
        </select>

        {{-- Filter Kelas --}}
        <select name="id_kelas" class="filter-select">
            <option value="">Semua Kelas</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}"
                    {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>

        {{-- Filter Guru --}}
        <select name="id_guru" class="filter-select">
            <option value="">Semua Guru</option>
            @foreach($guru as $g)
                <option value="{{ $g->id_guru }}"
                    {{ request('id_guru') == $g->id_guru ? 'selected' : '' }}>
                    {{ $g->nama }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">Terapkan</button>

        <a href="{{ route('jadwal.guru') }}" class="btn btn-light">
            Reset
        </a>
    </div>

    {{-- TABLE --}}
    <div class="table-wrapper" style="margin-top:20px;">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Hari</th>
                    <th>Jam</th>
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
                    <td>
                        {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('jadwal.edit', $j->id_jadwal) }}"
                               class="icon-btn icon-edit"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('jadwal.delete', $j->id_jadwal) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus jadwal ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="icon-btn icon-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">
                        Belum ada jadwal.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
