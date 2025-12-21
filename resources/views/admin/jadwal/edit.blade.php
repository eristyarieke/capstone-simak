@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-semibold mb-1">Edit Jadwal Pelajaran</h2>
    <p class="text-sm text-gray-500 mb-6">Perbarui data jadwal pelajaran</p>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 border border-red-300 p-4 text-sm text-red-700">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc ml-5 mt-2">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded shadow p-6">

        <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Kelas --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Kelas</label>
                    <select name="id_kelas" class="input w-full">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}"
                                {{ old('id_kelas', $jadwal->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Hari --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Hari</label>
                    <select name="hari" class="input w-full">
                        <option value="">Pilih Hari</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                            <option value="{{ $h }}"
                                {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>
                                {{ $h }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Mapel --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Mata Pelajaran</label>
                    <select name="id_mapel" class="input w-full">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id_mapel }}"
                                {{ old('id_mapel', $jadwal->id_mapel) == $m->id_mapel ? 'selected' : '' }}>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Guru --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Guru Pengampu</label>
                    <select name="id_guru" class="input w-full">
                        <option value="">Pilih Guru</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id_guru }}"
                                {{ old('id_guru', $jadwal->id_guru) == $g->id_guru ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jam --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Jam Mulai</label>
                    <input type="time"
                           name="jam_mulai"
                           value="{{ old('jam_mulai', $jadwal->jam_mulai) }}"
                           class="input w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jam Selesai</label>
                    <input type="time"
                           name="jam_selesai"
                           value="{{ old('jam_selesai', $jadwal->jam_selesai) }}"
                           class="input w-full">
                </div>

            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit" class="btn-primary">
                    Update
                </button>
                <a href="{{ route('admin.jadwal') }}" class="btn-light">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
