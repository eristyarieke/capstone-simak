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

<div class="card">

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="filter-bar">
        <div class="filter-group">

            {{-- Search --}}
            <input type="text"
                   name="search"
                   class="search-box"
                   placeholder="Cari kelas, mapel, atau guru..."
                   value="{{ request('search') }}">

            {{-- Hari --}}
            <select name="hari" class="filter-select">
                <option value="">Semua Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                    <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>
                        {{ $h }}
                    </option>
                @endforeach
            </select>

            {{-- Kelas --}}
            <select name="id_kelas" class="filter-select">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}"
                        {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>

            {{-- Guru --}}
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

            <a href="{{ route('kepsek.jadwal') }}" class="btn btn-light">
                Reset
            </a>
        </div>

        {{-- EXPORT --}}
        <div class="filter-action">
            <a href="{{ route('kepsek.jadwal.pdf', request()->query()) }}"
               class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </form>

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
                    <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">
                        Tidak ada jadwal ditemukan.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
