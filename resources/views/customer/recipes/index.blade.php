@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Resep</h2>

    @if($recipes->count())
        <div class="recipe-list">
            @foreach($recipes as $recipe)
                <div class="recipe-card">
                    {{-- Foto resep --}}
                    @if($recipe->photo)
                        <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->name }}" class="recipe-photo">
                    @else
                        <img src="https://via.placeholder.com/150" alt="No Image" class="recipe-photo">
                    @endif

                    {{-- Detail resep --}}
                    <div class="recipe-info">
                        <h3>{{ $recipe->name }}</h3>
                        <p>{{ $recipe->description ?? 'Tidak ada deskripsi.' }}</p>
                        <p><strong>Pakar Gizi:</strong> {{ $recipe->nutritionist }}</p>
                        <p><strong>Durasi:</strong> {{ $recipe->duration }}</p>

                        <a href="{{ route('customer.recipes.show', $recipe->id) }}" class="btn-view">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $recipes->links() }}
        </div>
    @else
        <p><em>Tidak ada resep ditemukan.</em></p>
    @endif

</div>

{{-- CSS sederhana agar lebih rapi --}}
<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }
    .recipe-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .recipe-card {
        display: flex;
        gap: 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 15px;
        background: #f9f9f9;
        align-items: flex-start;
    }
    .recipe-photo {
        width: 150px;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    .recipe-info {
        flex: 1;
    }
    .recipe-info h3 {
        margin: 0 0 10px;
    }
    .recipe-info p {
        margin: 4px 0;
    }
    .btn-view {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 12px;
        background: #007bff;
        color: white;
        border-radius: 4px;
        text-decoration: none;
    }
    .btn-view:hover {
        background: #0056b3;
    }
    .pagination {
        margin-top: 20px;
        text-align: center;
    }
</style>
@endsection
