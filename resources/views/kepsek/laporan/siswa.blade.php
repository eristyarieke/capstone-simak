@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Laporan Data Siswa</h3>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fa fa-print"></i> Cetak
        </button>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Tahun Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $no => $s)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->jenis_kelamin }}</td>
                    <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $s->tahun_masuk }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
