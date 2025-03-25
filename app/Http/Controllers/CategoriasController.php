<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Doctrine\Inflector\InflectorFactory;

class CategoriasController extends Controller
{
    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('categorias.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Criar um objeto Inflector para manipular singular/plural
        $inflector = InflectorFactory::create()->build();
        $nome = strtolower($request->nome);
        $singular = strtolower($inflector->singularize($nome));
        $plural = strtolower($inflector->pluralize($nome));

        // Validação personalizada para verificar duplicatas
        $request->validate([
            'nome' => [
                'required',
                'string',
                'min:3',
                'max:255',
                function ($attribute, $value, $error) use ($singular, $plural) {
                    // Verifica se já existe uma categoria com o nome no singular ou plural
                    $existingCategory = Categorias::whereRaw('LOWER(nome) = ?', [$singular])
                        ->orWhereRaw('LOWER(nome) = ?', [$plural])
                        ->first();

                    if ($existingCategory) {
                        $error('❌ Esta categoria já existe.');
                    }
                },
            ],
        ]);

        // Criar a categoria
        Categorias::create([
            'nome' => $request->nome,

        ]);

        return redirect()->back()->with('success', '✔ Categoria criada com sucesso!');
    }
}
