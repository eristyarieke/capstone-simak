@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Masukan & Komentar Pengunjung
</h2>

<div class="bg-white rounded-lg shadow p-6">

    <div class="mb-6 bg-blue-50 text-blue-800 p-4 rounded text-sm flex items-start gap-3">
        <i class="fa fa-info-circle mt-1"></i>
        <div>
            <strong>Info:</strong> Halaman ini menampilkan pesan yang dikirim oleh pengunjung melalui formulir kontak/feedback di halaman depan website.
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="w-12 text-center">No</th>
                    <th class="w-1/4">Pengirim & Waktu</th>
                    <th>Isi Pesan</th>
                    <th class="w-24 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($feedback as $f)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="text-center py-4">{{ $loop->iteration }}</td>
                        
                        {{-- Kolom Pengirim --}}
                        <td class="align-top py-4">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                    {{ substr($f->nama, 0, 1) }}
                                </div>
                                <span class="font-bold text-gray-800">{{ $f->nama }}</span>
                            </div>
                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                <i class="far fa-clock"></i>
                                {{ $f->created_at->translatedFormat('d M Y, H:i') }} WIB
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                {{ $f->created_at->diffForHumans() }}
                            </div>
                        </td>

                {{-- Kolom Isi Pesan --}}
                        <td class="align-top py-4">
                            <div class="bg-gray-50 p-3 rounded-tr-xl rounded-br-xl rounded-bl-xl border border-gray-100">
                                {{-- Ikon fa-quote-left SUDAH DIHAPUS --}}
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    {{ $f->komentar }}
                                </p>
                            </div>
                        </td>

                        {{-- Kolom Aksi --}}
                        <td class="text-center align-middle py-4">
                            <form action="{{ route('admin.kelola-halaman.feedback.destroy', $f->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus pesan dari {{ $f->nama }} ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition p-2 rounded-full w-8 h-8 flex items-center justify-center shadow-sm" 
                                        title="Hapus Pesan">
                                    <i class="fa fa-trash text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-12">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="far fa-comment-dots text-4xl mb-3"></i>
                                <span class="text-sm">Belum ada masukan dari pengunjung.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection