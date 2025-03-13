<?php

namespace App\Http\Controllers;

use App\Http\Requests\Receita\Store;
use App\Models\Receita;

class ReceitaController extends Controller
{
    public function store(Store $request)
    {
        Receita::create([
            'receita_titulo' => $request['receita_titulo'],
            'receita_descricao' => $request['receita_descricao'],
            'receita_foto' => $request['receita_foto'],
            'categoria' => $request['categoria'],
            'receita_duracao' => $request['receita_duracao'],
        ]);

        return redirect()->route('dashboard');
    }
}
