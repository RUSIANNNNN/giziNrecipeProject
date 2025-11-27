@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Tambah Resep Baru
        </h2>

        <form action="{{ route('admin.recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama Makanan -->
            <div class="mb-4">
                <label class="block font-medium">Nama Makanan:</label>
                <input type="text" name="name" class="w-full border rounded px-2 py-1" required>
            </div>

            <!-- Pakar Gizi -->
            <div class="mb-4">
                <label class="block font-medium">Pakar Gizi:</label>
                <input type="text" name="nutritionist" class="w-full border rounded px-2 py-1" required>
            </div>

            <!-- Durasi -->
            <div class="mb-4">
                <label class="block font-medium">Durasi:</label>
                <input type="text" name="duration" class="w-full border rounded px-2 py-1" placeholder="Contoh: 30 menit" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block font-medium">Deskripsi:</label>
                <textarea name="description" class="w-full border rounded px-2 py-1" rows="3" required></textarea>
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label class="block font-medium">Foto:</label>
                <input type="file" name="photo" class="w-full">
            </div>

            <!-- Bahan / Alat -->
            <div class="mb-4">
                <label class="block font-medium mb-2">Alat & Bahan:</label>
                <div id="ingredients-wrapper">
                    <div class="flex mb-2">
                        <input type="text" name="ingredients[]" class="w-full border rounded px-2 py-1" placeholder="Nama bahan/alat" required>
                        <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-black rounded">Hapus</button>
                    </div>
                </div>
                <button type="button" onclick="addIngredient()" class="px-4 py-1 bg-green-600 text-black rounded">Tambah Bahan</button>
            </div>

            <!-- Langkah / Cara -->
            <div class="mb-4">
                <label class="block font-medium mb-2">Langkah Cara Membuat:</label>
                <div id="steps-wrapper">
                    <div class="flex mb-2">
                        <input type="text" name="steps[]" class="w-full border rounded px-2 py-1" placeholder="Langkah pembuatan" required>
                        <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-black rounded">Hapus</button>
                    </div>
                </div>
                <button type="button" onclick="addStep()" class="px-4 py-1 bg-green-600 text-black rounded">Tambah Langkah</button>
            </div>

            <!-- Kandungan Gizi -->
            <div class="mb-4">
                <label class="block font-medium mb-2">Kandungan Gizi:</label>
                <div id="nutrition-wrapper">
                    <div class="flex mb-2 space-x-2">
                        <input type="text" name="nutritions[0][name]" class="border rounded px-2 py-1" placeholder="Nama gizi" required>
                        <input type="text" name="nutritions[0][amount]" class="border rounded px-2 py-1" placeholder="Jumlah, contoh: 10g" required>
                        <button type="button" onclick="removeInput(this)" class="px-2 bg-red-500 text-black rounded">Hapus</button>
                    </div>
                </div>
                <button type="button" onclick="addNutrition()" class="px-4 py-1 bg-green-600 text-black rounded">Tambah Gizi</button>
            </div>

            <!-- Submit -->
            <div class="mt-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Simpan Resep</button>
            </div>
        </form>
    </div>
</div>

<script>
    function removeInput(btn) {
        btn.parentElement.remove();
    }

    function addIngredient() {
        const wrapper = document.getElementById('ingredients-wrapper');
        const div = document.createElement('div');
        div.classList.add('flex', 'mb-2');
        div.innerHTML = `<input type="text" name="ingredients[]" class="w-full border rounded px-2 py-1" placeholder="Nama bahan/alat" required>
                         <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>`;
        wrapper.appendChild(div);
    }

    function addStep() {
        const wrapper = document.getElementById('steps-wrapper');
        const div = document.createElement('div');
        div.classList.add('flex', 'mb-2');
        div.innerHTML = `<input type="text" name="steps[]" class="w-full border rounded px-2 py-1" placeholder="Langkah pembuatan" required>
                         <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>`;
        wrapper.appendChild(div);
    }

    let nutritionIndex = 1;
    function addNutrition() {
        const wrapper = document.getElementById('nutrition-wrapper');
        const div = document.createElement('div');
        div.classList.add('flex', 'mb-2', 'space-x-2');
        div.innerHTML = `<input type="text" name="nutritions[${nutritionIndex}][name]" class="border rounded px-2 py-1" placeholder="Nama gizi" required>
                         <input type="text" name="nutritions[${nutritionIndex}][amount]" class="border rounded px-2 py-1" placeholder="Jumlah, contoh: 10g" required>
                         <button type="button" onclick="removeInput(this)" class="px-2 bg-red-500 text-white rounded">Hapus</button>`;
        wrapper.appendChild(div);
        nutritionIndex++;
    }
</script>
@endsection
