@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Foto Resep --}}
    <div class="recipe-header">
        @if($recipe->photo)
            <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->name }}" class="recipe-photo">
        @else
            <img src="https://via.placeholder.com/400x250" alt="No Image" class="recipe-photo">
        @endif

        <div class="recipe-title">
            <h2>{{ $recipe->name }}</h2>
            <p><strong>Pakar Gizi:</strong> {{ $recipe->nutritionist }}</p>
            <p><strong>Durasi:</strong> {{ $recipe->duration }}</p>
        </div>
    </div>

    {{-- Deskripsi --}}
    <div class="section">
        <h3>Deskripsi</h3>
        <p>{{ $recipe->description ?? 'Tidak ada deskripsi.' }}</p>
    </div>

    {{-- Langkah / Cara Buat --}}
    <div class="section">
        <h3>Cara Membuat</h3>
        <ol>
            @forelse($recipe->steps as $step)
                <li>{{ $step->instruction }}</li>
            @empty
                <li>Tidak ada langkah tersedia.</li>
            @endforelse
        </ol>
    </div>

    {{-- Alat dan Bahan --}}
    <div class="section">
        <h3>Alat & Bahan</h3>
        <ul>
            @forelse($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->item }}</li>
            @empty
                <li>Tidak ada data bahan.</li>
            @endforelse
        </ul>
    </div>
    

    {{-- Rating --}}
    <div class="section">
        <h3>Rating</h3>
        <form action="{{ route('ratings.store', $recipe) }}" method="POST">
            @csrf
            <select name="rating" required>
                <option value="">Pilih rating</option>
                <option value="1">⭐</option>
                <option value="2">⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
            <button type="submit">Kirim Rating</button>
        </form>

        <p>Rata-rata rating: {{ number_format($recipe->averageRating(), 1) }} / 5</p>
    </div>

    {{-- Komposisi Gizi --}}
    <div class="section">
        <h3>Komposisi Gizi</h3>
        <ul>
            @forelse($recipe->nutritions as $nutrition)
                <li>{{ $nutrition->name }}: {{ $nutrition->value }}</li>
            @empty
                <li>Tidak ada data gizi.</li>
            @endforelse
        </ul>
    </div>

    <a href="{{ route('customer.recipes.index') }}">
        <button>⬅ Kembali ke Daftar Resep</button>
    </a>
</div>

{{-- CSS sederhana --}}
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .recipe-header {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    .recipe-photo {
        width: 300px;
        height: 200px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }
    .recipe-title h2 {
        margin: 0 0 10px;
    }
    .section {
        margin-bottom: 25px;
    }
    .section h3 {
        margin-bottom: 10px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }
    ul, ol {
        margin: 0;
        padding-left: 20px;
    }
    select, button {
        margin-top: 10px;
        padding: 5px 10px;
    }
    button {
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background: #0056b3;
    }
</style>
@endsection
