@extends('layouts.app')

@section('content')

{{-- HEADER & TOMBOL CETAK --}}
<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <h2 class="text-xl font-bold text-gray-800">
        {{ $title }}
    </h2>

    <a href="{{ route('kepsek.laporan.jadwal.pdf', request()->all()) }}" 
       target="_blank"
       class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded shadow flex items-center gap-2 transition">
        <i class="fa fa-file-pdf"></i> 
        Download Laporan PDF
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    
    {{-- FORM FILTER --}}
    <form action="{{ route('kepsek.laporan.jadwal') }}" method="GET" class="mb-6 border-b pb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            
            {{-- Filter Tahun Ajaran --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tahun Ajaran</label>
                <select name="id_tahun_ajaran" class="w-full border-gray-300 rounded p-2 text-sm border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">- Semua Tahun -</option>
                    @foreach($tahun_ajaran as $t)
                        <option value="{{ $t->id_tahun_ajaran }}" {{ request('id_tahun_ajaran') == $t->id_tahun_ajaran ? 'selected' : '' }}>
                            {{ $t->nama_tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Kelas --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kelas</label>
                <select name="id_kelas" class="w-full border-gray-300 rounded p-2 text-sm border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">- Semua Kelas -</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Hari --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Hari</label>
                <select name="hari" class="w-full border-gray-300 rounded p-2 text-sm border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">- Semua Hari -</option>
                    @foreach($hari_list as $h)
                        <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>
                            {{ $h }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Filter --}}
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm font-medium transition w-full">
                    <i class="fa fa-filter"></i> Terapkan
                </button>
            </div>

        </div>
        {{-- Tombol Reset terpisah sedikit di bawah jika diperlukan --}}
        @if(request()->hasAny(['id_kelas', 'id_tahun_ajaran', 'hari']))
            <div class="mt-2">
                <a href="{{ route('kepsek.laporan.jadwal') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">
                    Reset Filter
                </a>
            </div>
        @endif
    </form>

    {{-- TABEL DATA --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="py-3 px-6 border-b">Hari</th>
                    <th class="py-3 px-6 border-b">Jam</th>
                    <th class="py-3 px-6 border-b">Kelas</th>
                    <th class="py-3 px-6 border-b">Mata Pelajaran</th>
                    <th class="py-3 px-6 border-b">Guru Pengampu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                <tr class="hover:bg-gray-50 border-b border-gray-200">
                    <td class="py-3 px-6 font-bold text-gray-700">{{ $jadwal->hari }}</td>
                    <td class="py-3 px-6 text-sm">
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                    </td>
                    <td class="py-3 px-6">
                        <span class="bg-gray-200 text-gray-800 text-xs font-semibold px-2 py-0.5 rounded">
                            {{ $jadwal->kelas->nama_kelas ?? '-' }}
                        </span>
                    </td>
                    <td class="py-3 px-6 font-medium text-blue-600">
                        {{ $jadwal->mapel->nama_mapel ?? '-' }}
                    </td>
                    <td class="py-3 px-6">{{ $jadwal->guru->nama ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-400">
                        Jadwal pelajaran tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection