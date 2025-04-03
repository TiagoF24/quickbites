<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/criar', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');

Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');



// Receitas

Route::get('/receitas/create', [ReceitaController::class, 'create'])->name('receitas.create');

Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
Route::post('/receitas', [ReceitaController::class, 'store'])->name('receita.store');

// Listagem de todas as receitas
Route::get('/receitas', function () {
    return view('receitas.index');
})->name('receitas.index');

// Visualização de uma receita específica
Route::get('/receitas/{id}', function ($id) {
    return view('receitas.show', ['id' => $id]);
})->name('receitas.show');

Route::resource('receita', ReceitaController::class);

Route::get('/test', function () {
    return view('test');
});


Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
Route::get('/receitas/{id}', [ReceitaController::class, 'show'])->name('receitas.show');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/perfil/{user}', [ProfileController::class, 'show'])
    ->name('profile.show');
});


Route::get('/admin', [AdminController::class, 'index']);


// Favorite routes
Route::middleware(['auth'])->group(function () {
    Route::post('/receitas/{receita}/favorite', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('receitas.favorite');
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');

    // Rating routes
    Route::post('/receitas/{receita}/rate', [App\Http\Controllers\RatingController::class, 'store'])->name('receitas.rate');
});

// User favorites (public)
Route::get('/profile/{user}/favorites', [App\Http\Controllers\ReceitaController::class, 'userFavorites'])->name('profile.favorites');


require __DIR__.'/auth.php';