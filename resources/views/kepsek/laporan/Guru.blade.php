@extends('layouts.app')

@section('content')

{{-- HEADER & TOMBOL CETAK --}}
<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <h2 class="text-xl font-bold text-gray-800">
        {{ $title }}
    </h2>

    <a href="{{ route('kepsek.laporan.guru.pdf', request()->all()) }}" 
       target="_blank"
       class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded shadow flex items-center gap-2 transition">
        <i class="fa fa-file-pdf"></i> 
        Download Laporan PDF
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    
    {{-- FORM FILTER --}}
    <form action="{{ route('kepsek.laporan.guru') }}" method="GET" class="mb-6 border-b pb-6">
        <div class="flex flex-col md:flex-row gap-4 items-end">
            
            {{-- Filter Jabatan --}}
            <div class="w-full md:w-1/4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Jabatan</label>
                <select name="jabatan" class="w-full border-gray-300 rounded p-2 text-sm border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">- Semua Jabatan -</option>
                    @foreach($jabatan_list as $jab)
                        <option value="{{ $jab }}" {{ request('jabatan') == $jab ? 'selected' : '' }}>
                            {{ $jab }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Tahun Ajaran --}}
            <div class="w-full md:w-1/4">
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

            {{-- Tombol Filter --}}
            <div class="w-full md:w-auto">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm font-medium transition w-full md:w-auto">
                    <i class="fa fa-filter"></i> Terapkan
                </button>
                
                {{-- Tombol Reset --}}
                @if(request('jabatan') || request('id_tahun_ajaran'))
                    <a href="{{ route('kepsek.laporan.guru') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm ml-2 transition inline-block text-center">
                        Reset
                    </a>
                @endif
            </div>

        </div>
    </form>

    {{-- TABEL DATA --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="py-3 px-6 border-b">No</th>
                    <th class="py-3 px-6 border-b">Nama Guru</th>
                    <th class="py-3 px-6 border-b">Jabatan</th>
                    <th class="py-3 px-6 border-b">L/P</th>
                    <th class="py-3 px-6 border-b">Agama</th>
                    <th class="py-3 px-6 border-b">Tahun Masuk/Ajaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gurus as $guru)
                <tr class="hover:bg-gray-50 border-b border-gray-200">
                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6 font-medium">{{ $guru->nama }}</td>
                    <td class="py-3 px-6">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $guru->jabatan }}
                        </span>
                    </td>
                    <td class="py-3 px-6">{{ $guru->jenis_kelamin }}</td>
                    <td class="py-3 px-6">{{ $guru->agama }}</td>
                    <td class="py-3 px-6">{{ $guru->tahunAjaran->nama_tahun ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        Data guru tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection