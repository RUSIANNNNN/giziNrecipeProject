@extends('layouts.app')

@section('content')
    <h2>{{ $recipe->name }}</h2>
    <p><strong>Pakar Gizi:</strong> {{ $recipe->nutritionist }}</p>
    <p><strong>Durasi:</strong> {{ $recipe->duration }}</p>
    <p>{{ $recipe->description }}</p>

    <h3>Bahan</h3>
    <ul>
        @foreach($recipe->ingredients as $ingredient)
            <li>{{ $ingredient->item }}</li>
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
@endsection
