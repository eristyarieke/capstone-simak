@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-semibold mb-1">Edit Siswa</h2>
    <p class="text-sm text-gray-500 mb-6">Perbarui data siswa</p>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 border border-red-300 p-4 text-sm text-red-700">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded shadow p-6">

        <form action="{{ route('admin.siswa.update',$siswa->id_siswa) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Siswa</label>
                    <input name="nama" value="{{ $siswa->nama }}" class="input w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="input w-full">
                        <option value="Laki-laki" {{ $siswa->jenis_kelamin=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $siswa->jenis_kelamin=='Perempuan'?'selected':'' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Agama</label>
                    <select name="agama" class="input w-full">
                        @foreach($agama as $a)
                            <option value="{{ $a }}" {{ $siswa->agama==$a?'selected':'' }}>
                                {{ $a }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Kelas</label>
                    <select name="id_kelas" class="input w-full">
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}"
                                {{ $siswa->id_kelas==$k->id_kelas?'selected':'' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Update</button>
                <a href="{{ route('admin.siswa') }}" class="btn-light">Kembali</a>
            </div>

        </form>
    </div>
</div>
@endsection
