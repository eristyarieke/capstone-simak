@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')

{{-- ================= SAMBUTAN KEPALA SEKOLAH ================= --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-800">Sambutan Kepala Sekolah</h2>
            <div class="h-1 w-16 bg-gray-800 mx-auto mt-2"></div>
        </div>

        <div class="bg-gray-50 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 shadow-sm border border-gray-100">
            {{-- Foto Kepsek (Dinamis dari Settings) --}}
            <div class="w-48 h-48 flex-shrink-0 relative">
                @if(!empty($foto_kepsek))
                    <img src="{{ asset('storage/' . $foto_kepsek) }}" 
                         class="w-full h-full object-cover rounded-full border-4 border-white shadow-lg" 
                         alt="Kepala Sekolah">
                @else
                    {{-- Placeholder jika foto belum diupload --}}
                    <div class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center border-4 border-white shadow-lg">
                        <i class="fas fa-user text-4xl text-gray-500"></i>
                    </div>
                @endif
            </div>
            
            <div class="text-center md:text-left flex-1">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    Kepala Sekolah
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4 text-justify">
                    {{-- Mengambil teks sambutan dari variabel $sambutan --}}
                    {{ Str::limit($sambutan ?? 'Assalamualaikum Wr. Wb. Website ini adalah media komunikasi resmi sekolah kami...', 450) }}
                </p>
                <a href="{{ route('profil') }}" class="text-primary font-semibold hover:underline">Baca Selengkapnya &rarr;</a>
            </div>
        </div>
    </div>
</section>

{{-- ================= PENGUMUMAN ================= --}}
<section class="py-12 bg-blue-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 uppercase tracking-wide">Pengumuman Terbaru</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($pengumuman as $info)
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-primary text-left hover:-translate-y-1 transition duration-300">
                    <span class="text-xs text-gray-500 font-bold uppercase">{{ \Carbon\Carbon::parse($info->tanggal)->format('d M Y') }}</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-1 mb-2">{{ $info->judul }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($info->isi, 120) }}</p>
                </div>
            @empty
                <div class="col-span-2 bg-white p-8 rounded-lg text-gray-500 shadow-sm">
                    <i class="far fa-clipboard mb-2 text-2xl"></i>
                    <p>Belum ada pengumuman saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= STATISTIK & TAHUN AJARAN ================= --}}
<section class="py-16 bg-white text-black relative overflow-hidden">
    {{-- Background Pattern (Opsional) --}}
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <i class="fas fa-shapes absolute top-10 left-10 text-9xl"></i>
        <i class="fas fa-graduation-cap absolute bottom-10 right-10 text-9xl"></i>
    </div>

    <div class="container mx-auto px-4 text-center relative z-10">
        {{-- Tahun Ajaran Dinamis --}}
        <h2 class="text-2xl md:text-3xl font-bold mb-2 ">
            Tahun Ajaran <span class="text-secondary">{{ $tahun_ajaran ?? date('Y').'/'.(date('Y')+1) }}</span>
        </h2>
        <div class="h-1 w-20 bg-secondary mx-auto mt-3 mb-12 rounded"></div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            {{-- Statistik Siswa --}}
            <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20 transform hover:-translate-y-2 transition duration-300">
                <i class="fas fa-user-graduate text-4xl mb-3 text-secondary"></i>
                <h3 class="text-4xl font-bold">{{ $total_siswa ?? 0 }}</h3>
                <p class="text-sm opacity-80 mt-1 uppercase tracking-wider">Siswa</p>
            </div>
            
            {{-- Statistik Guru --}}
            <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-primary/20 transform hover:-translate-y-2 transition duration-300">
                <i class="fas fa-chalkboard-teacher text-4xl mb-3 text-secondary"></i>
                <h3 class="text-4xl font-bold">{{ $total_guru ?? 0 }}</h3>
                <p class="text-sm opacity-80 mt-1 uppercase tracking-wider">Guru & Staf</p>
            </div>

            {{-- Statistik Kelas --}}
            <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-primary/20 transform hover:-translate-y-2 transition duration-300">
                <i class="fas fa-school text-4xl mb-3 text-secondary"></i>
                <h3 class="text-4xl font-bold">{{ $total_kelas ?? 0 }}</h3>
                <p class="text-sm opacity-80 mt-1 uppercase tracking-wider">Jumlah Kelas</p>
            </div>

            {{-- Statistik Mapel/Ekstra (Hardcode atau Buat Variable Baru) --}}
            <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-primary/20 transform hover:-translate-y-2 transition duration-300">
                <i class="fas fa-trophy text-4xl mb-3 text-secondary"></i>
                <h3 class="text-4xl font-bold">{{ $total_mapel ?? 0 }}</h3>
                <p class="text-sm opacity-80 mt-1 uppercase tracking-wider">Jumlah Mata Pelajaran</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= KEGIATAN / ARTIKEL TERBARU ================= --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div class="text-center md:text-left w-full">
                <h2 class="text-2xl font-bold text-gray-800">Kabar Sekolah Terbaru</h2>
                <div class="h-1 w-16 bg-primary mt-2 mx-auto md:mx-0"></div>
            </div>
            <a href="{{ route('artikel') }}" class="text-primary font-semibold hover:underline whitespace-nowrap hidden md:block">
                Lihat Semua Berita &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($artikelTerbaru as $artikel)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 group border border-gray-100 h-full flex flex-col">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-0 right-0 bg-secondary text-gray-900 text-xs font-bold px-3 py-1 m-3 rounded">
                        {{ $artikel->kategori ?? 'Berita' }}
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <span class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                        <i class="far fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($artikel->tanggal_publish)->translatedFormat('d F Y') }}
                    </span>
                    <h3 class="text-lg font-bold text-gray-800 mb-3 leading-tight group-hover:text-primary transition">
                        <a href="{{ route('artikel.detail', $artikel->slug ?? $artikel->id) }}">
                            {{ Str::limit($artikel->judul, 60) }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($artikel->isi), 100) }}
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('artikel.detail', $artikel->slug ?? $artikel->id) }}" class="text-primary font-semibold text-sm hover:underline">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('artikel') }}" class="btn-primary inline-block">Lihat Semua Berita</a>
        </div>
    </div>
</section>

@endsection