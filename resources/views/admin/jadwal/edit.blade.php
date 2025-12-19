@extends('layouts.app')
@section('content')

<h2 class="content-header">Edit Jadwal Pelajaran</h2>
<p class="form-subtitle">Perbarui data jadwal berikut</p>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Terjadi kesalahan:</strong>
    <ul>
        @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-card">

<form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
@csrf
@method('PUT')

<div class="form-grid">

    {{-- Kelas --}}
    <div class="form-group">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control">
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}"
                    {{ $jadwal->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Hari --}}
    <div class="form-group">
        <label>Hari</label>
        <select name="hari" class="form-control">
            <option value="">Pilih Hari</option>
            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                <option value="{{ $h }}"
                    {{ $jadwal->hari == $h ? 'selected' : '' }}>
                    {{ $h }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Mapel --}}
    <div class="form-group full">
        <label>Mata Pelajaran</label>
        <select name="id_mapel" class="form-control">
            <option value="">Pilih Mata Pelajaran</option>
            @foreach($mapel as $m)
                <option value="{{ $m->id_mapel }}"
                    {{ $jadwal->id_mapel == $m->id_mapel ? 'selected' : '' }}>
                    {{ $m->nama_mapel }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Guru --}}
    <div class="form-group full">
        <label>Guru Pengampu</label>
        <select name="id_guru" class="form-control">
            <option value="">Pilih Guru</option>
            @foreach($guru as $g)
                <option value="{{ $g->id_guru }}"
                    {{ $jadwal->id_guru == $g->id_guru ? 'selected' : '' }}>
                    {{ $g->nama }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Jam Mulai --}}
    <div class="form-group">
        <label>Jam Mulai</label>
        <input type="time" name="jam_mulai"
               value="{{ $jadwal->jam_mulai }}"
               class="form-control">
    </div>

    {{-- Jam Selesai --}}
    <div class="form-group">
        <label>Jam Selesai</label>
        <input type="time" name="jam_selesai"
               value="{{ $jadwal->jam_selesai }}"
               class="form-control">
    </div>

</div>

<div class="form-buttons">
    <button type="submit" class="btn-custom btn-blue">
        Perbarui
    </button>
    <a href="{{ route('jadwal.admin') }}" class="btn-custom btn-gray">
        Kembali
    </a>
</div>

</form>
</div>

@endsection
