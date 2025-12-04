@extends('layouts.app')
@section('content')

<h2 class="content-header">Tambah Jadwal Baru</h2>
<p class="form-subtitle">Silahkan isi formulir berikut!</p>

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

<form action="{{ route('jadwal.store') }}" method="POST">
@csrf

<div class="form-grid">

    <div class="form-group">
        <label>Kelas :</label>
        <select class="form-control" name="id_kelas">
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Ruang :</label>
        <input type="text" name="ruang" class="form-control">
    </div>

    <div class="form-group full">
        <label>Mata Pelajaran :</label>
        <select class="form-control" name="id_mapel">
            <option value="">Pilih Mapel</option>
            @foreach($mapel as $m)
                <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group full">
        <label>Guru :</label>
        <select class="form-control" name="id_guru">
            <option value="">Pilih Guru</option>
            @foreach($guru as $g)
                <option value="{{ $g->id_guru }}">{{ $g->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Jam Mulai :</label>
        <input type="time" name="jam_mulai" class="form-control">
    </div>

    <div class="form-group">
        <label>Jam Selesai :</label>
        <input type="time" name="jam_selesai" class="form-control">
    </div>

    <div class="form-group full">
        <label>Hari :</label>
        <select class="form-control" name="hari">
            <option>Pilih Hari</option>
            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
            <option>{{ $h }}</option>
            @endforeach
        </select>
    </div>

</div>

<div class="form-buttons">
    <button class="btn-custom btn-blue" type="submit">Tambahkan Data</button>
    <a href="{{ route('jadwal.admin') }}" class="btn-custom btn-gray">Kembali</a>
</div>

</form>

</div>

@endsection
