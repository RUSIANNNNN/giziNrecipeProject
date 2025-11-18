@extends('layouts.app')

@section('content')
<h1>INI FILE YANG BENAR WOY</h1>
<div class="py-6">
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
<h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
Edit Resep Kamu
</h2>

    {{-- Arahkan form ke route 'customer.recipes.update' --}}
    <form action="{{ route('customer.recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Method untuk update --}}
        
        <!-- Nama Makanan -->
        <div class="mb-4">
            <label class="block font-medium">Nama Makanan:</label>
            <input type="text" name="name" class="w-full border rounded px-2 py-1" value="{{ old('name', $recipe->name) }}" required>
        </div>

        <!-- Durasi -->
        <div class="mb-4">
            <label class="block font-medium">Durasi:</label>
            <input type="text" name="duration" class="w-full border rounded px-2 py-1" value="{{ old('duration', $recipe->duration) }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block font-medium">Deskripsi Singkat:</label>
            <textarea name="description" class="w-full border rounded px-2 py-1" rows="3" required>{{ old('description', $recipe->description) }}</textarea>
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label class="block font-medium">Foto (Ganti jika perlu):</label>
            @if($recipe->photo)
                <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->name }}" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="photo" class="w-full">
        </div>

        <!-- Bahan / Alat -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Alat & Bahan:</label>
            <div id="ingredients-wrapper">
                @foreach($recipe->ingredients as $ingredient)
                <div class="flex mb-2">
                    <input type="text" name="ingredients[]" class="w-full border rounded px-2 py-1" value="{{ $ingredient->item }}" required>
                    <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addIngredient()" class="px-4 py-1 bg-green-600 text-white rounded">Tambah Bahan</button>
        </div>

        <!-- Langkah / Cara -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Langkah Cara Membuat:</label>
            <div id="steps-wrapper">
                @foreach($recipe->steps as $step)
                <div class="flex mb-2">
                    <input type="text" name="steps[]" class="w-full border rounded px-2 py-1" value="{{ $step->instruction }}" required>
                    <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addStep()" class="px-4 py-1 bg-green-600 text-white rounded">Tambah Langkah</button>
        </div>

        <!-- Kandungan Gizi -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Kandungan Gizi (Opsional):</label>
            <div id="nutrition-wrapper">
                @foreach($recipe->nutritions as $index => $nutrition)
                <div class="flex mb-2 space-x-2">
                    <input type="text" name="nutritions[{{ $index }}][name]" class="border rounded px-2 py-1" value="{{ $nutrition->name }}">
                    <input type="text" name="nutritions[{{ $index }}][amount]" class="border rounded px-2 py-1" value="{{ $nutrition->value }}">
                    <button type="button" onclick="removeInput(this)" class="px-2 bg-red-500 text-white rounded">Hapus</button>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addNutrition()" class="px-4 py-1 bg-green-600 text-white rounded">Tambah Gizi</button>
        </div>

        <!-- Submit -->
        <div class="mt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Resep</button>
        </div>
    </form>
</div>


</div>

{{-- Script ini sama persis --}}

<script>
function removeInput(btn) {
    btn.parentElement.remove();
}

function addIngredient() {
    const wrapper = document.getElementById('ingredients-wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'mb-2');
    // PASTIKAN DI SINI MENGGUNAKAN 'text-white'
    div.innerHTML = `<input type="text" name="ingredients[]" class="w-full border rounded px-2 py-1" placeholder="Nama bahan/alat" required>
                     <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>`;
    wrapper.appendChild(div);
}

function addStep() {
    const wrapper = document.getElementById('steps-wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'mb-2');
    // PASTIKAN DI SINI MENGGUNAKAN 'text-white'
    div.innerHTML = `<input type="text" name="steps[]" class="w-full border rounded px-2 py-1" placeholder="Langkah pembuatan" required>
                     <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>`;
    wrapper.appendChild(div);
}

let nutritionIndex = 0;
function addNutrition() {
    const wrapper = document.getElementById('nutrition-wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'mb-2', 'space-x-2');
    // PASTIKAN DI SINI MENGGUNAKAN 'text-white'
    div.innerHTML = `<input type="text" name="nutritions[${nutritionIndex}][name]" class="border rounded px-2 py-1" placeholder="Nama gizi (e.g. Kalori)">
                     <input type="text" name="nutritions[${nutritionIndex}][amount]" class="border rounded px-2 py-1" placeholder="Jumlah (e.g. 150 kcal)">
                     <button type="button" onclick="removeInput(this)" class="px-2 bg-red-500 text-white rounded">Hapus</button>`;
    wrapper.appendChild(div);
    nutritionIndex++;
}
</script>

@endsection