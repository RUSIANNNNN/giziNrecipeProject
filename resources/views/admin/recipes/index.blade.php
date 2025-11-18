@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Resep</h2>

    {{-- Tombol tambah resep --}}
    <div class="actions">
        <a href="{{ route('admin.recipes.create') }}" class="btn btn-add">+ Tambah Resep</a>
    </div>

    {{-- Daftar resep --}}
    @if($recipes->isEmpty())
        <p><em>Tidak ada resep tersedia.</em></p>
    @else
        <div class="recipe-grid">
            @foreach($recipes as $recipe)
                <div class="recipe-card">
                    {{-- Foto resep --}}
                    @if($recipe->photo)
                        <img src="{{ asset('storage/'.$recipe->photo) }}" alt="{{ $recipe->name }}" class="recipe-photo">
                    @else
                        <div class="recipe-photo placeholder">Tidak ada foto</div>
                    @endif

                    {{-- Informasi resep --}}
                    <h3>{{ $recipe->name }}</h3>
                    <p class="description">{{ Str::limit($recipe->description, 100) }}</p>
                    <p><strong>Pakar Gizi:</strong> {{ $recipe->nutritionist }}</p>
                    <p><strong>Durasi:</strong> {{ $recipe->duration }}</p>

                    {{-- Tombol aksi --}}
                    <div class="actions">
                        <a href="{{ route('admin.recipes.show', $recipe->id) }}" class="btn btn-view">Lihat</a>
                        <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus resep ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
