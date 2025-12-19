@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Laporan Data Guru</h3>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fa fa-print"></i> Cetak
        </button>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>No. HP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guru as $no => $g)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $g->nip }}</td>
                    <td>{{ $g->nama }}</td>
                    <td>{{ $g->jenis_kelamin }}</td>
                    <td>{{ $g->email }}</td>
                    <td>{{ $g->no_hp }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
