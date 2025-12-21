@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
  Jadwal Pelajaran
</h2>

<div class="bg-white rounded-lg shadow p-6">

  {{-- ================= FILTER ================= --}}
  <form method="GET" class="flex flex-wrap gap-3 items-center mb-6">

    <input
      type="text"
      name="search"
      placeholder="Cari kelas, mapel, atau guru..."
      value="{{ request('search') }}"
      class="input w-64"
    >

    <select name="hari" class="input">
      <option value="">Semua Hari</option>
      @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
        <option value="{{ $h }}" {{ request('hari') === $h ? 'selected' : '' }}>
          {{ $h }}
        </option>
      @endforeach
    </select>

    <select name="id_kelas" class="input">
      <option value="">Semua Kelas</option>
      @foreach ($kelas as $k)
        <option
          value="{{ $k->id_kelas }}"
          {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}
        >
          {{ $k->nama_kelas }}
        </option>
      @endforeach
    </select>

    <select name="id_guru" class="input">
      <option value="">Semua Guru</option>
      @foreach ($guru as $g)
        <option
          value="{{ $g->id_guru }}"
          {{ request('id_guru') == $g->id_guru ? 'selected' : '' }}
        >
          {{ $g->nama }}
        </option>
      @endforeach
    </select>

    <button type="submit" class="btn-primary">
      Terapkan
    </button>

    {{-- RESET = kembali ke entry point --}}
    <a href="{{ route('admin.jadwal') }}" class="btn-light">
      Reset
    </a>

    {{-- CREATE --}}
    <div class="ml-auto">
      <a href="{{ route('admin.jadwal.create') }}" class="btn-success">
        + Tambah Jadwal
      </a>
    </div>

  </form>

  {{-- ================= TABLE ================= --}}
  <div class="overflow-x-auto">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kelas</th>
          <th>Mapel</th>
          <th>Guru</th>
          <th>Hari</th>
          <th>Jam</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($jadwal as $j)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $j->kelas->nama_kelas }}</td>
            <td>{{ $j->mapel->nama_mapel }}</td>
            <td>{{ $j->guru->nama }}</td>
            <td>{{ $j->hari }}</td>
            <td>{{ $j->jam_mulai }} – {{ $j->jam_selesai }}</td>

            <td class="flex gap-3">
              {{-- EDIT --}}
              <a
                href="{{ route('admin.jadwal.edit', $j->id_jadwal) }}"
                class="text-blue-600 hover:text-blue-800"
              >
                <i class="fa fa-edit"></i>
              </a>

              {{-- DELETE --}}
              <form
                action="{{ route('admin.jadwal.destroy', $j->id_jadwal) }}"
                method="POST"
              >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-delete text-red-600 hover:text-red-800">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-6 text-gray-400">
              Belum ada jadwal
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

@endsection
