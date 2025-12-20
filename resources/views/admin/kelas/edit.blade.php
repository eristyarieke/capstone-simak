@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-semibold mb-1">Edit Kelas</h2>
    <p class="text-sm text-gray-500 mb-6">Perbarui data kelas</p>

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
        <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Kelas</label>
                    <input type="text" name="nama_kelas"
                           value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                           class="input w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Wali Kelas</label>
                    <select name="wali_kelas" class="input w-full">
                        <option value="">- Pilih Guru -</option>
                        @foreach ($guru as $g)
                            <option value="{{ $g->id_guru }}"
                                {{ old('wali_kelas', $kelas->wali_kelas) == $g->id_guru ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-6 flex gap-3">
                <button class="btn-primary">Update</button>
                <a href="{{ route('admin.kelas.index') }}" class="btn-light">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
