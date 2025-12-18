@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">Jadwal Pelajaran</h2>

<div class="bg-white rounded-lg shadow p-6">

  <!-- Filter -->
  <form method="GET" class="flex flex-wrap gap-3 items-center mb-6">

    <input type="text" name="search" placeholder="Cari kelas, mapel, atau guru..."
      value="{{ request('search') }}" class="input w-64">

    <select name="hari" class="input">
      <option value="">Semua Hari</option>
      @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
        <option value="{{ $h }}" {{ request('hari')==$h?'selected':'' }}>{{ $h }}</option>
      @endforeach
    </select>

    <select name="id_kelas" class="input">
      <option value="">Semua Kelas</option>
      @foreach($kelas as $k)
        <option value="{{ $k->id_kelas }}" {{ request('id_kelas')==$k->id_kelas?'selected':'' }}>
          {{ $k->nama_kelas }}
        </option>
      @endforeach
    </select>

    <select name="id_guru" class="input">
      <option value="">Semua Guru</option>
      @foreach($guru as $g)
        <option value="{{ $g->id_guru }}" {{ request('id_guru')==$g->id_guru?'selected':'' }}>
          {{ $g->nama }}
        </option>
      @endforeach
    </select>

    <button class="btn-primary">Terapkan</button>
    <a href="{{ route('jadwal.admin') }}" class="btn-light">Reset</a>

    <div class="ml-auto">
      <a href="{{ route('jadwal.create') }}" class="btn-success">+ Tambah Jadwal</a>
    </div>

  </form>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="table">
      <thead>
        <tr>
          <th>No</th><th>Kelas</th><th>Mapel</th><th>Guru</th><th>Hari</th><th>Jam</th><th>Aksi</th>
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
          <td class="flex gap-2">
            <a href="{{ route('jadwal.edit',$j->id_jadwal) }}" class="text-blue-600"><i class="fa fa-edit"></i></a>
            <form method="POST" action="{{ route('jadwal.delete',$j->id_jadwal) }}">
              @csrf @method('DELETE')
              <button class="text-red-600" onclick="return confirm('Hapus jadwal ini?')">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-6 text-gray-400">Belum ada jadwal</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

@endsection