@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-4">Daftar Resep</h2>

    @if($recipes->count())
        <ul class="space-y-2">
            @foreach($recipes as $recipe)
                <li class="p-4 bg-gray-100 rounded shadow flex justify-between items-center">
                    <span>{{ $recipe->name }}</span>
                    <a href="{{ route('customer.recipes.show', $recipe->id) }}" 
                       class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">
                       Lihat Detail
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $recipes->links() }}
        </div>
    @else
        <p>Tidak ada resep ditemukan.</p>
    @endif
</div>
@endsection
