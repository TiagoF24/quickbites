<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\AdminController;


// Add this at the top of your routes/web.php file
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/criar', function () {
    if (auth()->user()->is_banned) {
        return redirect()->route('banned');
    }
    
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');



// Receitas

Route::get('/receitas/create', [ReceitaController::class, 'create'])->name('receitas.create');
Route::get('/receitas/{id}', [ReceitaController::class, 'show'])->name('receitas.show');
Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
Route::post('/receitas', [ReceitaController::class, 'store'])->name('receita.store');
Route::get('/receitas/{receita}/edit', [App\Http\Controllers\ReceitaController::class, 'edit'])->name('receitas.edit');
Route::put('/receitas/{receita}', [App\Http\Controllers\ReceitaController::class, 'update'])->name('receitas.update');
Route::resource('receitas', App\Http\Controllers\ReceitaController::class);


Route::delete('/receitas/{receita}/ratings/{rating}', [App\Http\Controllers\ReceitaController::class, 'deleteRating'])
    ->name('receitas.delete-rating')
    ->middleware('auth');

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



// Favoritos
Route::middleware(['auth'])->group(function () {
    Route::post('/receitas/{receita}/favorite', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('receitas.favorite');
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');

    Route::post('/receitas/{receita}/rate', [ReceitaController::class, 'rate'])->name('receitas.rate');
});


Route::get('/profile/{user}/favorites', [App\Http\Controllers\ReceitaController::class, 'userFavorites'])->name('profile.favorites');

// Route::get('/categorias', function () {
//     $categorias = DB::table('categorias')->select('nome')->orderBy('nome')->get();
//     return response()->json($categorias);
// });

Route::get('/categorias', function () {
    $categorias = DB::table('categorias')
                    ->select('nome')
                    ->orderBy('nome')
                    ->get();
    
    return response()->json($categorias);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::patch('/users/{user}/toggle-ban', [App\Http\Controllers\AdminController::class, 'toggleUserBan'])->name('users.toggle-ban');
    Route::delete('/receitas/{receita}', [App\Http\Controllers\AdminController::class, 'deleteReceita'])->name('receitas.delete');
    Route::delete('/categorias/{categoria}', [App\Http\Controllers\CategoriasController::class, 'destroy'])->name('categorias.delete');
});

// Banned user route
Route::get('/banned', [App\Http\Controllers\Auth\BannedUserController::class, 'index'])
    ->name('banned');


// Check banned status after login
Route::get('/check-banned', [App\Http\Controllers\Auth\BannedUserController::class, 'check'])
    ->middleware('auth')
    ->name('check.banned');



require __DIR__.'/auth.php';