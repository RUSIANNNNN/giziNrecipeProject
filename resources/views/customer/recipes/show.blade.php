@extends('layouts.app')

@section('content')
    <h2>{{ $recipe->name }}</h2>
    <p>Pakar Gizi: {{ $recipe->nutritionist }}</p>
    <p>Durasi: {{ $recipe->duration }}</p>
    <p>{{ $recipe->description }}</p>

    <h3>Bahan</h3>
    <ul>
        @foreach($recipe->ingredients as $ingredient)
            <li>{{ $ingredient->name }}</li>
        @endforeach
    </ul>

    <h3>Langkah</h3>
    <ol>
        @foreach($recipe->steps as $step)
            <li>{{ $step->instruction }}</li>
        @endforeach
    </ol>

    <h3>Kandungan Gizi</h3>
    <ul>
        @foreach($recipe->nutritions as $nutrition)
            <li>{{ $nutrition->name }}: {{ $nutrition->value }}</li>
        @endforeach
    </ul>

    <h3>Rating</h3>
    <form action="{{ route('ratings.store', $recipe->id) }}" method="POST">
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
@endsection
