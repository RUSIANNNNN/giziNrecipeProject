<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController; 
>>>>>>> Stashed changes

/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome'); // Homepage bisa diubah sesuai kebutuhan
});

/*
|--------------------------------------------------------------------------
| Redirect setelah login
|--------------------------------------------------------------------------
*/
Route::get('/redirect', function () {
    // Jika karena suatu hal user tidak login, lempar ke halaman login
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // Jika role-nya admin, arahkan ke dashboard admin
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Jika role-nya customer, arahkan ke dashboard customer
    if ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }

    // Jika tidak punya role (sebagai cadangan), arahkan ke halaman login
    return redirect('/login');
    
})->name('redirect');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD resep
    Route::resource('recipes', AdminController::class);
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    // Dashboard user
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');

    // List & detail resep
    // Hapus ->only() agar semua 7 fungsi (index, create, store, show, edit, update, destroy) bisa diakses
    Route::resource('recipes', CustomerController::class);
});




/*
|--------------------------------------------------------------------------
| RATING ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Simpan rating user untuk resep
    Route::post('/recipes/{recipe}/rating', [RatingController::class, 'store'])->name('ratings.store');

    // Optional: jika ingin admin/author kelola rating
    // Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
    // Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');
});

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD UMUM
|--------------------------------------------------------------------------
*/
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

<<<<<<< Updated upstream
=======

// Pastikan ini ada di dalam group middleware 'auth'(karena cuma user login yang boleh simpan)
Route::middleware(['auth'])->group(function () {
    
    // Rute untuk simpan/hapus bookmark
    Route::post('/recipes/{recipe}/bookmark', [BookmarkController::class, 'toggle'])->name('recipes.bookmark');
    // Rute Halaman Daftar Favorit 
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    // Rute Komentar
    Route::post('/recipes/{recipe}/comments', [CommentController::class, 'store'])->name('comments.store');
});

>>>>>>> Stashed changes
require __DIR__ . '/auth.php';
