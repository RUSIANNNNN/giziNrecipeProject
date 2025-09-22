<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class CustomerController extends Controller
{
    /**
     * Dashboard customer
     */
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    /**
     * Menampilkan daftar semua resep
     */
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $recipes = $query->paginate(10)->withQueryString();

        return view('customer.recipes.index', compact('recipes'));
    }

    /**
     * Menampilkan detail resep
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['ingredients', 'steps' => function($q){
            $q->orderBy('order');
        }, 'nutritions']);

        return view('customer.recipes.show', compact('recipe'));
    }
}
