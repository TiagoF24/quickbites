<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceitaController;

Route::get('/', function () {
    return view('welcome');
    if (app()->isLocal()) {
        auth()->loginUsingId(1);
        return to_route('dashboard');
    }
});

Route::get('/criar', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');

Route::resource('receita', ReceitaController::class);


Route::get('/receitas/create', [ReceitaController::class, 'create'])->name('receitas.create');

Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
Route::post('/receita/store', [ReceitaController::class, 'store'])->name('receita.store');

// Listagem de todas as receitas
Route::get('/receitas', function () {
    return view('receitas.index');
})->name('receitas.index');

// Visualização de uma receita específica
Route::get('/receitas/{id}', function ($id) {
    return view('receitas.show', ['id' => $id]);
})->name('receitas.show');


// Recipe routes
Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
Route::get('/receitas/{id}', [ReceitaController::class, 'show'])->name('receitas.show');

Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
