<?php

namespace App\Http\Controllers;

use App\Http\Requests\Receita\Store;
use App\Models\Receita;

class ReceitaController extends Controller
{
    public function store(Store $request)
    {
        Receita::create([
            'nome' => $request['nome'],
            'descricao' => $request['descricao'],
            'imagem' => $request['imagem'],
            'video' => $request['video'],
            'categoria' => $request['categoria'],
            'tempo' => $request['tempo'],
            'ingredientes' => $request['ingredientes'],
        ]);

        return redirect()->route('dashboard');


    }
}
