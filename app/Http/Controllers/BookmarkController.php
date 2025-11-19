<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Function untuk Toggle (Simpan/Hapus)
    public function toggle($recipeId)
    {
        $user = Auth::user();
        
        // Cek apakah user sudah bookmark resep ini?
        $bookmark = Bookmark::where('user_id', $user->id)
                            ->where('recipe_id', $recipeId)
                            ->first();

        if ($bookmark) {
            // Jika sudah ada, hapus (Un-bookmark)
            $bookmark->delete();
            return back()->with('success', 'Resep dihapus dari simpanan.');
        } else {
            // Jika belum ada, buat baru (Simpan)
            Bookmark::create([
                'user_id' => $user->id,
                'recipe_id' => $recipeId
            ]);
            return back()->with('success', 'Resep berhasil disimpan!');
        }
    }

    public function index()
    {
        // Ambil bookmark user yg login + data resepnya
        $bookmarks = Bookmark::where('user_id', Auth::id())
                             ->with('recipe.user') // Ambil data resep & pembuatnya
                             ->latest()
                             ->get();

        // Arahkan ke file yang baru kita buat: resources/views/customer/recipes/bookmarks.blade.php
        return view('customer.recipes.bookmarks', compact('bookmarks'));
    }
}