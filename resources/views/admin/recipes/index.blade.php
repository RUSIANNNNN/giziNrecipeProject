@extends('layouts.app')

@section('content')
    <h2>Daftar Resep</h2>
    <a href="{{ route('admin.recipes.create') }}">Tambah Resep</a>

    <ul>
        @foreach($recipes as $recipe)
            <li>
                {{ $recipe->name }}
                <a href="{{ route('admin.recipes.show', $recipe->id) }}">Lihat</a>
                <a href="{{ route('admin.recipes.edit', $recipe->id) }}">Edit</a>
                <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
