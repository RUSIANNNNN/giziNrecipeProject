<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient; // <-- TAMBAHKAN INI
use App\Models\Step;       // <-- TAMBAHKAN INI
use App\Models\Nutrition;  // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Storage;  // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Auth;      // <-- TAMBAHKAN INI

class CustomerController extends Controller
{
    /**
     * Dashboard customer
     */
    public function dashboard()
    {
        // === UPDATE FUNGSI INI ===
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Hitung resep yang DI-POST OLEH user ini saja
        $recipeCount = Recipe::where('user_id', $userId)->count();
        
        // Kirim data ke view
        return view('customer.dashboard', compact('recipeCount'));
        // ========================
    }

    /**
     * Menampilkan daftar semua resep
     */
    public function index(Request $request)
    {
        // === UPDATE FUNGSI INI ===
        // Tambahkan with('user') untuk optimasi & menampilkan nama poster
        // Tambahkan latest() agar yang terbaru muncul di atas
        $query = Recipe::with('user')->latest();
        // ========================

        // Logika search-mu sudah bagus, kita pertahankan
        if ($request->has('search') && !empty($request->search)) { 
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $recipes = $query->paginate(10)->withQueryString();

        return view('customer.recipes.index-user', compact('recipes'));
    }

    /**
     * Menampilkan detail resep
     */
    public function show(Recipe $recipe)
    {
        // === UPDATE FUNGSI INI ===
        // Tambahkan 'user' di load() agar kita tahu siapa yang posting
        $recipe->load([
            'ingredients', 
            'steps' => function($q){$q->orderBy('order');}, 
            'nutritions', 
            'user',
            'comments.user' 
        ]);
        // ========================

        return view('customer.recipes.show-user', compact('recipe'));
    }

    // ==========================================================
    // === TAMBAHKAN SEMUA FUNGSI BARU DI BAWAH INI ===
    // ==========================================================

    /**
     * FITUR 2: MENAMPILKAN FORM TAMBAH RESEP
     */
    public function create()
    {
        // Ini akan mengarah ke resources/views/customer/recipes/create-user
        // .blade.php
        return view('customer.recipes.create-user');
    }

    /**
     * FITUR 3: MENYIMPAN RESEP BARU DARI USER (POST)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|string',
            'steps' => 'required|array',
            'steps.*' => 'required|string',
            'nutritions' => 'nullable|array',
            'nutritions.*.name' => 'nullable|string',
            'nutritions.*.amount' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('recipes', 'public');
        }

        // Ini bagian pentingnya
        $data['user_id'] = Auth::id(); // Set pemilik resep
        $data['is_official'] = false;  // Set sebagai resep user biasa

        $recipe = Recipe::create($data); // Simpan resep

        // Simpan ingredients
        if ($request->ingredients) {
            foreach ($request->ingredients as $ingredient) {
                if (!empty($ingredient)) {
                    Ingredient::create([
                        'recipe_id' => $recipe->id,
                        'item' => $ingredient,
                    ]);
                }
            }
        }

        // Simpan steps
        if ($request->steps) {
            foreach ($request->steps as $index => $step) {
                if (!empty($step)) {
                    Step::create([
                        'recipe_id' => $recipe->id,
                        'instruction' => $step,
                        'order' => $index + 1,
                    ]);
                }
            }
        }

        // Simpan nutritions
        if ($request->nutritions) {
            foreach ($request->nutritions as $nutrition) {
                if (!empty($nutrition['name']) && !empty($nutrition['amount'])) {
                    Nutrition::create([
                        'recipe_id' => $recipe->id,
                        'name' => $nutrition['name'],
                        'value' => $nutrition['amount'],
                    ]);
                }
            }
        }
        
        // Arahkan kembali ke dashboard user
        return redirect()->route('customer.dashboard')->with('success', 'Resep kamu berhasil diposting!');
    }

    /**
     * FITUR 5: MENAMPILKAN FORM EDIT RESEP
     */
    public function edit(Recipe $recipe)
    {
        // OTORISASI: Cek apakah user ini pemilik resepnya
        if ($recipe->user_id !== Auth::id()) {
            abort(403, 'ANDA TIDAK BERHAK MENGEDIT RESEP INI');
        }

        $recipe->load(['ingredients', 'steps', 'nutritions']);
        // Ini akan mengarah ke resources/views/customer/recipes/edit.blade.php
        return view('customer.recipes.edit-user', compact('recipe'));
    }

    /**
     * FITUR 6: MENYIMPAN UPDATE RESEP DARI USER (PUT/PATCH)
     */
    public function update(Request $request, Recipe $recipe)
    {
        // OTORISASI: Cek apakah user ini pemilik resepnya
        if ($recipe->user_id !== Auth::id()) {
            abort(403, 'ANDA TIDAK BERHAK MENGUPDATE RESEP INI');
        }

        // Validasi data (sama seperti store)
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|string',
            'steps' => 'required|array',
            'steps.*' => 'required|string',
            'nutritions' => 'nullable|array',
            'nutritions.*.name' => 'nullable|string',
            'nutritions.*.amount' => 'nullable|string',
        ]);

        // Logika update foto (sama seperti AdminController)
        if ($request->hasFile('photo')) {
            if ($recipe->photo && Storage::disk('public')->exists($recipe->photo)) {
                Storage::disk('public')->delete($recipe->photo);
            }
            $data['photo'] = $request->file('photo')->store('recipes', 'public');
        }

        // Update resep utama
        $recipe->update($data);

        // Hapus data relasi lama
        $recipe->ingredients()->delete();
        $recipe->steps()->delete();
        $recipe->nutritions()->delete();

        // Buat ulang data relasi (sama seperti store)
        if ($request->ingredients) {
            foreach ($request->ingredients as $ingredient) {
                if (!empty($ingredient)) { Ingredient::create(['recipe_id' => $recipe->id, 'item' => $ingredient]); }
            }
        }
        if ($request->steps) {
            foreach ($request->steps as $index => $step) {
                if (!empty($step)) { Step::create(['recipe_id' => $recipe->id, 'instruction' => $step, 'order' => $index + 1]); }
            }
        }
        if ($request->nutritions) {
            foreach ($request->nutritions as $nutrition) {
                if (!empty($nutrition['name']) && !empty($nutrition['amount'])) { Nutrition::create(['recipe_id' => $recipe->id, 'name' => $nutrition['name'], 'value' => $nutrition['amount']]); }
            }
        }

        return redirect()->route('customer.dashboard')->with('success', 'Resep berhasil diupdate!');
    }

    /**
     * FITUR 7: MENGHAPUS RESEP MILIK USER
     */
    public function destroy(Recipe $recipe)
    {
        // OTORISASI: Cek apakah user ini pemilik resepnya
        if ($recipe->user_id !== Auth::id()) {
            abort(403, 'ANDA TIDAK BERHAK MENGHAPUS RESEP INI');
        }

        // Logika hapus foto (sama seperti AdminController)
        if ($recipe->photo && Storage::disk('public')->exists($recipe->photo)) {
            Storage::disk('public')->delete($recipe->photo);
        }

        // Hapus resep
        $recipe->delete();

        return redirect()->route('customer.dashboard')->with('success', 'Resep berhasil dihapus!');
    }
}