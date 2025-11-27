@extends('layouts.app')

@section('content')
    <h2>Edit Resep</h2>

    {{-- Form Update Resep --}}
    <form action="{{ route('admin.recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Foto Resep --}}
        <div>
            <label>Foto Resep (opsional)</label><br>
            @if($recipe->photo)
                <img src="{{ asset('storage/' . $recipe->photo) }}" alt="Foto Resep" width="150">
            @endif
            <input type="file" name="photo">
        </div>

        {{-- Nama Resep --}}
        <div>
            <label>Nama Resep</label>
            <input type="text" name="name" value="{{ old('name', $recipe->name) }}">
        </div>

        {{-- Pakar Gizi --}}
        <div>
            <label>Pakar Gizi</label>
            <input type="text" name="nutritionist" value="{{ old('nutritionist', $recipe->nutritionist) }}">
        </div>

        {{-- Durasi --}}
        <div>
            <label>Durasi</label>
            <input type="text" name="duration" value="{{ old('duration', $recipe->duration) }}">
        </div>

        {{-- Deskripsi --}}
        <div>
            <label>Deskripsi</label>
            <textarea name="description">{{ old('description', $recipe->description) }}</textarea>
        </div>

        {{-- Bahan --}}
        <div>
            <label>Bahan</label>
            <ul>
                @foreach($recipe->ingredients as $ingredient)
                    <li>
                        <input type="text" name="ingredients[]" value="{{ $ingredient->item }}">
                    </li>
                @endforeach
                <li><input type="text" name="ingredients[]" placeholder="Tambah bahan baru"></li>
            </ul>
        </div>

        {{-- Langkah --}}
        <div>
            <label>Langkah</label>
            <ol>
                @foreach($recipe->steps as $step)
                    <li>
                        <textarea name="steps[]">{{ $step->instruction }}</textarea>
                    </li>
                @endforeach
                <li><textarea name="steps[]" placeholder="Tambah langkah baru"></textarea></li>
            </ol>
        </div>

        {{-- Kandungan Gizi --}}
        <div>
            <label>Kandungan Gizi</label>
            <ul>
                @foreach($recipe->nutritions as $nutrition)
                    <li>
                        <input type="text" name="nutritions[{{ $loop->index }}][name]" value="{{ $nutrition->name }}">
                        <input type="text" name="nutritions[{{ $loop->index }}][amount]" value="{{ $nutrition->value }}">
                    </li>
                @endforeach
                <li>
                    <input type="text" name="nutritions[new][name]" placeholder="Nama gizi baru">
                    <input type="text" name="nutritions[new][amount]" placeholder="Nilai gizi baru">
                </li>
            </ul>
        </div>

        {{-- Tombol --}}
        <div>
            <button type="submit">Update Resep</button>
            <a href="{{ route('admin.recipes.index') }}">Batal</a>
        </div>
    </form>
@endsection
