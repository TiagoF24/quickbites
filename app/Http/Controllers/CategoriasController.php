<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Http\Requests\Categorias\StoreRequest;

class CategoriasController extends Controller
{
    public function store(StoreRequest $request)
    {

        Categorias::create([
            'nome' => $request->nome,
        ]);
        return redirect()->route('dashboard');



    }

}
