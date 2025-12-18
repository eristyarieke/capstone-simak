@extends('layouts.web')

@section('title','Beranda')

@section('content')
<h1 class="text-2xl font-bold mb-4">Selamat Datang</h1>

<div class="grid md:grid-cols-3 gap-4">
@foreach($sliders as $slider)
    <div class="bg-white shadow rounded p-4">
        <img src="{{ asset('storage/'.$slider->gambar) }}" class="rounded mb-2">
        <h2 class="font-semibold">{{ $slider->judul }}</h2>
        <p class="text-sm text-gray-600">{{ $slider->subjudul }}</p>
    </div>
@endforeach
</div>
@endsection
