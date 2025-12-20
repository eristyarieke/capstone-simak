@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-2">
    Pembagian & Mutasi Siswa
</h2>
<p class="text-sm text-gray-500 mb-6">
    Penempatan awal siswa dan mutasi antar kelas
</p>

@if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 p-3 rounded">
        {{ session('success') }}
    </div>
@endif

{{-- ================= FILTER ================= --}}
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <select name="mode" class="input">
        <option value="belum" {{ request('mode') === 'belum' ? 'selected' : '' }}>
            Siswa Belum Punya Kelas
        </option>
        <option value="mutasi" {{ request('mode') === 'mutasi' ? 'selected' : '' }}>
            Mutasi Siswa (Sudah Punya Kelas)
        </option>
    </select>

    @if (request('mode') === 'mutasi')
        <select name="kelas_asal" class="input">
            <option value="">Semua Kelas</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id_kelas }}"
                    {{ request('kelas_asal') == $k->id_kelas ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    @endif

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama siswa..."
        class="input w-64"
    >

    <button class="btn-light">
        Terapkan
    </button>
</form>

{{-- ================= FORM PEMBAGIAN ================= --}}
<form method="POST" action="{{ route('admin.pembagian-kelas.store') }}">
@csrf

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ================= LIST SISWA ================= --}}
    <div class="lg:col-span-2 bg-white rounded shadow p-6">

        <h3 class="text-lg font-semibold mb-4">
            Daftar Siswa
        </h3>

        <div class="overflow-x-auto border rounded">
            <table class="w-full text-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3 w-10">
                            <input type="checkbox"
                                onclick="document.querySelectorAll('.cb').forEach(c => c.checked = this.checked)">
                        </th>
                        <th class="px-4 py-3 text-left">Nama Siswa</th>
                        <th class="px-4 py-3 text-left">Kelas Asal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $s)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <input type="checkbox"
                                    name="id_siswa[]"
                                    value="{{ $s->id_siswa }}"
                                    class="cb">
                            </td>
                            <td class="px-4 py-3">
                                {{ $s->nama }}
                            </td>
                            <td class="px-4 py-3 text-gray-500">
                                {{ $s->kelas->nama_kelas ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-400">
                                Data siswa tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= KELAS TUJUAN ================= --}}
    <div class="bg-white rounded shadow p-6">
        <h3 class="text-lg font-semibold mb-4">
            Kelas Tujuan
        </h3>

        <label class="block text-sm font-medium mb-2">
            Pilih Kelas
        </label>

        <select name="id_kelas" class="input w-full mb-6" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id_kelas }}">
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>

        <button class="btn-primary w-full">
            {{ request('mode') === 'mutasi' ? 'Pindahkan Siswa' : 'Simpan Pembagian' }}
        </button>
    </div>

</div>

</form>
@endsection
