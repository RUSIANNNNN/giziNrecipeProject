<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-blue-200 rounded shadow">
            <h2 class="text-lg font-semibold">Total Resep</h2>
            <p class="text-2xl font-bold">{{ $recipeCount ?? '-' }}</p>
        </div>
            {{-- <div class="p-4 bg-green-200 rounded shadow">
                <h2 class="text-lg font-semibold">Total Bahan</h2>
                <p class="text-2xl font-bold">{{ $ingredientsCount ?? '-' }}</p>
            </div>
            <div class="p-4 bg-yellow-200 rounded shadow">
                <h2 class="text-lg font-semibold">Total Langkah</h2>
                <p class="text-2xl font-bold">{{ $stepsCount ?? '-' }}</p>
            </div>
            <div class="p-4 bg-red-200 rounded shadow">
                <h2 class="text-lg font-semibold">Total Kandungan Gizi</h2>
                <p class="text-2xl font-bold">{{ $nutritionsCount ?? '-' }}</p>
            </div> --}}
    </div>

    <!-- Tombol Tambah Resep -->
    <div class="mb-4">
        <a href="{{ route('admin.recipes.create') }}" 
           class="px-6 py-3 bg-green-500 text-black font-semibold rounded hover:bg-green-700">
           Tambah Resep Baru
        </a>
    </div>

    <!-- Tombol Kelola Resep -->
    <div class="mb-4">
        <a href="{{ route('admin.recipes.index') }}" 
           class="px-6 py-3 bg-blue-500 text-black font-semibold rounded hover:bg-blue-700">
           Kelola Semua Resep
        </a>
    </div>
</div>
@endsection
