@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Kelola Visi & Misi Sekolah
</h2>

{{-- Grid Layout: Kiri Visi, Kanan Misi --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    {{-- === KOLOM VISI === --}}
    <div class="flex flex-col gap-6">
        
        {{-- Card Daftar Visi --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Daftar Visi</h3>
            
            @if($visi->isEmpty())
                <p class="text-gray-400 italic text-sm text-center py-4">Belum ada data Visi.</p>
            @else
                <ul class="space-y-3">
                    @foreach($visi as $v)
                        <li class="bg-gray-50 p-3 rounded flex justify-between items-start gap-3 group">
                            <p class="text-gray-800 text-sm font-medium">"{{ $v->isi_visi }}"</p>
                            
                            {{-- Tombol Hapus Visi --}}
                            <form action="{{ route('admin.kelola-halaman.visi.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Hapus visi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Card Tambah Visi --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-bold text-gray-600 mb-3">+ Tambah Visi Baru</h3>
            <form action="{{ route('admin.kelola-halaman.visi.store') }}" method="POST">
                @csrf
                <textarea name="isi_visi" rows="3" class="input w-full p-2 border rounded mb-3 text-sm" placeholder="Masukkan kalimat visi..." required></textarea>
                <button type="submit" class="btn-primary w-full py-2 text-sm">Simpan Visi</button>
            </form>
        </div>

    </div>

    {{-- === KOLOM MISI === --}}
    <div class="flex flex-col gap-6">
        
        {{-- Card Daftar Misi --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Daftar Misi</h3>

            @if($misi->isEmpty())
                <p class="text-gray-400 italic text-sm text-center py-4">Belum ada data Misi.</p>
            @else
                <ul class="space-y-3">
                    @foreach($misi as $m)
                        <li class="bg-gray-50 p-3 rounded flex justify-between items-start gap-3">
                            <div class="flex gap-2">
                                <span class="bg-gray-200 text-gray-700 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold shrink-0">
                                    {{ $loop->iteration }}
                                </span>
                                <p class="text-gray-800 text-sm">{{ $m->isi_misi }}</p>
                            </div>
                            
                            {{-- Tombol Hapus Misi --}}
                            <form action="{{ route('admin.kelola-halaman.misi.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus misi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Card Tambah Misi --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-bold text-gray-600 mb-3">+ Tambah Misi Baru</h3>
            <form action="{{ route('admin.kelola-halaman.misi.store') }}" method="POST">
                @csrf
                <textarea name="isi_misi" rows="3" class="input w-full p-2 border rounded mb-3 text-sm" placeholder="Masukkan poin misi..." required></textarea>
                <button type="submit" class="btn-primary w-full py-2 text-sm">Simpan Misi</button>
            </form>
        </div>

    </div>

</div>

@endsection