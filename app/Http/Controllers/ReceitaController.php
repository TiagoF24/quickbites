<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceitaController extends Controller
{
    // ReceitaController.php
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'receita_titulo' => 'required|string|max:255',
            'receita_descricao' => 'required|string',
            'receita_foto' => 'nullable|image|max:10240', // 10MB max
            'receita_duracao' => 'required|integer|min:1',
            'porcoes' => 'required|integer|min:1',
            'nivel_dificuldade' => 'required|string',
            'calorias' => 'nullable|integer',
            'categoria' => 'required|string',
            'ingredientes' => 'required|string',
            'modo_preparo' => 'required|string',
            'dicas' => 'nullable|string',
            'autor' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('receita_foto')) {
            $path = $request->file('receita_foto')->store('receitas', 'public');
            $validated['receita_foto'] = $path;
        }

        // Create the recipe
        $receita = Receita::create($validated);

        return redirect()->route('receitas.show', $receita)->with('success', 'Receita criada com sucesso!');
    }



    /**
        * Mostra uma listagem receitas.
        *
        * @return \Illuminate\Http\Response
        * @return \Illuminate\View\View
        */
    public function index()
    {
        $receitas = DB::table('receitas')
            ->select('id', 'receita_titulo', 'receita_descricao', 'receita_foto', 'receita_duracao', 'categoria', 'autor')
            ->orderBy('id', 'desc')
            ->get();

        return view('receitas.index', compact('receitas'));
    }


    public function create()
    {
        // Buscar todas as categorias do banco de dados
        $categorias = \App\Models\Categorias::orderBy('nome')->get();

        // Passar para a view
        return view('dashboard', compact('categorias'));
    }

    /**
         * Display the specified receita.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         * @return \Illuminate\View\View
         */
    public function show($id)
    {
        $receita = DB::table('receitas')
            ->where('id', $id)
            ->first();

        if (!$receita) {
            abort(404, 'Receita não encontrada');
        }

        $receitasRelacionadas = DB::table('receitas')
            ->where('categoria', $receita->categoria)
            ->where('id', '!=', $id)
            ->limit(3)
            ->get();

        return view('receitas.show', compact('receita', 'receitasRelacionadas'));
    }
}
