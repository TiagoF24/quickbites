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

Route::post('/receita', [ReceitaController::class, 'store'])->name('receita.store');



Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
