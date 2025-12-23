@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- HEADER & INFO TAHUN AJARAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
            <p class="text-gray-600 text-sm">Berikut adalah jadwal mengajar Anda.</p>
        </div>
        <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg border border-blue-200 text-sm font-medium">
            <i class="fas fa-calendar-alt mr-2"></i> 
            Tahun Ajaran: {{ $tahunAktif->nama_tahun }}
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        
        {{-- FORM FILTER --}}
        <form action="{{ route('guru.jadwal') }}" method="GET" class="mb-6 border-b pb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                
                {{-- Search --}}
                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Cari Mapel/Kelas</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Contoh: Matematika..." 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>

                {{-- Filter Hari --}}
                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                    <select name="hari" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">- Semua Hari -</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>
                                {{ $hari }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Kelas --}}
                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                    <select name="id_kelas" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">- Semua Kelas -</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Action --}}
                <div class="col-span-1 flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition w-full shadow">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    
                    @if(request()->hasAny(['search', 'hari', 'id_kelas']))
                        <a href="{{ route('guru.jadwal') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-md text-sm font-medium transition text-center">
                            Reset
                        </a>
                    @endif
                </div>

            </div>
        </form>

        {{-- TABEL JADWAL --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                        <th class="py-3 px-4 font-semibold border-b">Hari</th>
                        <th class="py-3 px-4 font-semibold border-b">Jam Pelajaran</th>
                        <th class="py-3 px-4 font-semibold border-b">Kelas</th>
                        <th class="py-3 px-4 font-semibold border-b">Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse($jadwal as $j)
                    <tr class="hover:bg-blue-50 border-b border-gray-100 transition duration-150">
                        
                        {{-- HARI --}}
                        <td class="py-3 px-4">
                            @php
                                $color = match($j->hari) {
                                    'Senin' => 'bg-red-100 text-red-700',
                                    'Selasa' => 'bg-yellow-100 text-yellow-700',
                                    'Rabu' => 'bg-green-100 text-green-700',
                                    'Kamis' => 'bg-blue-100 text-blue-700',
                                    'Jumat' => 'bg-purple-100 text-purple-700',
                                    'Sabtu' => 'bg-gray-100 text-gray-700',
                                    default => 'bg-gray-100'
                                };
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-bold {{ $color }}">
                                {{ $j->hari }}
                            </span>
                        </td>

                        {{-- JAM --}}
                        <td class="py-3 px-4 font-mono">
                            <span class="bg-gray-100 px-2 py-1 rounded text-gray-800">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </span>
                        </td>

                        {{-- KELAS --}}
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-800">{{ $j->kelas->nama_kelas ?? '-' }}</span>
                        </td>

                        {{-- MAPEL --}}
                        <td class="py-3 px-4">
                            <div class="font-medium text-blue-600">{{ $j->mapel->nama_mapel ?? '-' }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-calendar-times text-4xl mb-3"></i>
                                <p>Tidak ada jadwal mengajar ditemukan.</p>
                                @if(request()->anyFilled(['search', 'hari', 'id_kelas']))
                                    <p class="text-xs mt-1">Coba reset filter Anda.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection