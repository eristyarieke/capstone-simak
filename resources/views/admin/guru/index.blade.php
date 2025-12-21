@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
  Data Guru
</h2>

<div class="bg-white rounded-lg shadow p-6">

  {{-- FILTER --}}
  <form method="GET" class="flex items-center gap-3 mb-6">
    <input
      type="text"
      name="search"
      placeholder="Cari nama atau jabatan..."
      value="{{ request('search') }}"
      class="input w-64"
    >

    <button class="btn-primary">Cari</button>

    <a href="{{ route('admin.guru') }}" class="btn-light">
      Reset
    </a>

    <div class="ml-auto">
      <a href="{{ route('admin.guru.create') }}" class="btn-success">
        + Tambah Guru
      </a>
    </div>
  </form>

  {{-- TABLE --}}
  <div class="overflow-x-auto">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Jabatan</th>
          <th>JK</th>
          <th>Agama</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($guru as $g)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->jabatan }}</td>
            <td>{{ $g->jenis_kelamin }}</td>
            <td>{{ $g->agama }}</td>

            <td class="flex gap-3">
              <a
                href="{{ route('admin.guru.edit', $g->id_guru) }}"
                class="text-blue-600 hover:text-blue-800"
              >
                <i class="fa fa-edit"></i>
              </a>

              <form
                method="POST"
                action="{{ route('admin.guru.destroy', $g->id_guru) }}"
              >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-delete text-red-600 hover:text-red-800" >
        <i class="fa fa-trash"></i>
    </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-6 text-gray-400">
              Belum ada data guru
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

@endsection
