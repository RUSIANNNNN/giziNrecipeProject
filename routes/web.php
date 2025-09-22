<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;

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
    if (!Auth::check()) return redirect('/login');

    $user = Auth::user();
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'customer') return redirect()->route('customer.dashboard');
    return redirect()->route('dashboard');
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
    Route::resource('recipes', CustomerController::class)->only(['index', 'show']);
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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
