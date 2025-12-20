@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-semibold mb-1">Tambah Mata Pelajaran</h2>
    <p class="text-sm text-gray-500 mb-6">Isi data mata pelajaran</p>

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
        <form action="{{ route('admin.mapel.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-1">Kode Mapel</label>
                    <input type="text" name="kode_mapel"
                           value="{{ old('kode_mapel') }}"
                           class="input w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel"
                           value="{{ old('nama_mapel') }}"
                           class="input w-full">
                </div>

            </div>

            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Simpan</button>
                <a href="{{ route('admin.mapel') }}" class="btn-light">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
