<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Doctrine\Inflector\InflectorFactory;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }

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
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }
        
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
                        ->exists(); // Verifica a existência

                    if ($existingCategory) {
                        $error($attribute, '❌ Esta categoria já existe.');
                    }
                },
            ],
        ]);

        // Criar a categoria
        Categorias::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Categoria criada com sucesso!');
    }

    public function index()
    {
        $categorias = Categorias::all();
        return view('categorias.index', compact('categorias'));
    }
    
    /**
     * Delete a category
     * 
     * @param Categorias $categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Categorias $categoria)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }
        
        $categoria->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Categoria eliminada com sucesso!');
    }
}
