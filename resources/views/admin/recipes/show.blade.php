@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Judul Resep --}}
    <div class="header">
        <h1>{{ $recipe->name }}</h1>
        <p class="subtitle">Resep Bergizi & Sehat</p>
    </div>

    {{-- Info dasar --}}
    <div class="card">
        <h2>Informasi Dasar</h2>
        <p><strong>Pakar Gizi:</strong> {{ $recipe->nutritionist }}</p>
        <p><strong>Durasi:</strong> {{ $recipe->duration }}</p>
        <p><strong>Deskripsi:</strong> {{ $recipe->description ?? '-' }}</p>
    </div>

    {{-- Bahan --}}
    <div class="card">
        <h2>Bahan</h2>
        <ul>
            @forelse($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->item }}</li>
            @empty
                <li><em>Tidak ada data bahan.</em></li>
            @endforelse
        </ul>
    </div>

    {{-- Langkah --}}
    <div class="card">
        <h2>Langkah</h2>
        <ol>
            @forelse($recipe->steps as $step)
                <li>{{ $step->instruction }}</li>
            @empty
                <li><em>Tidak ada langkah tersedia.</em></li>
            @endforelse
        </ol>
    </div>

    {{-- Kandungan Gizi --}}
    <div class="card">
        <h2>Kandungan Gizi</h2>
        <ul>
            @forelse($recipe->nutritions as $nutrition)
                <li>{{ $nutrition->name }}: {{ $nutrition->value }}</li>
            @empty
                <li><em>Tidak ada data kandungan gizi.</em></li>
            @endforelse
        </ul>
    </div>

    {{-- Tombol kembali --}}
    <div class="back-button">
        <a href="{{ route('admin.recipes.index') }}">← Kembali ke Daftar Resep</a>
    </div>
</div>
@endsection
