@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
  Data Siswa
</h2>

<div class="bg-white rounded-lg shadow p-6">

  {{-- ================= FILTER ================= --}}
  <form method="GET" class="flex flex-wrap gap-3 items-center mb-6">

    <input
      type="text"
      name="search"
      placeholder="Cari nama siswa atau kelas..."
      value="{{ request('search') }}"
      class="input w-64"
    >

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

    <button type="submit" class="btn-primary">
      Terapkan
    </button>

    {{-- RESET --}}
    <a href="{{ route('admin.siswa') }}" class="btn-light">
      Reset
    </a>

    <div class="ml-auto">
      <a href="{{ route('admin.siswa.create') }}" class="btn-success">
        + Tambah Siswa
      </a>
    </div>

  </form>

  {{-- ================= TABLE ================= --}}
  <div class="overflow-x-auto">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Jenis Kelamin</th>
          <th>Agama</th>
          <th>Kelas</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($siswa as $s)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $s->agama }}</td>
            <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>

            <td class="flex gap-3">
              {{-- EDIT --}}
              <a
                href="#"
                class="text-blue-600 hover:text-blue-800"
              >
                <i class="fa fa-edit"></i>
              </a>

              {{-- DELETE --}}
              <form
                action="{{ route('admin.siswa.destroy', $s->id_siswa) }}"
                method="POST"
                onsubmit="return confirm('Hapus data siswa ini?')"
              >
                @csrf
                @method('DELETE')

                <button class="text-red-600 hover:text-red-800">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-6 text-gray-400">
              Belum ada data siswa
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

@endsection
