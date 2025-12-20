@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-semibold mb-1">Tambah Guru</h2>
    <p class="text-sm text-gray-500 mb-6">Silakan isi formulir berikut</p>

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

        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Guru</label>
                    <input name="nama" value="{{ old('nama') }}" class="input w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jabatan</label>
                    <input name="jabatan" value="{{ old('jabatan') }}" class="input w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="input w-full">
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Agama</label>
                    <select name="agama" class="input w-full">
                        <option value="">Pilih</option>
                        @foreach($agama as $a)
                            <option value="{{ $a }}">{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Simpan</button>
                <a href="{{ route('admin.guru') }}" class="btn-light">Kembali</a>
            </div>

        </form>
    </div>
</div>
@endsection
