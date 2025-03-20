<?php

namespace App\Http\Controllers;

use App\Http\Requests\Receita\Store;
use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceitaController extends Controller
{
    // ReceitaController.php
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'receita_titulo' => 'required|string|max:255',
            'receita_descricao' => 'required|string',
            'receita_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
            'receita_duracao' => 'required|integer',
            'categoria' => 'required|string',
            'autor' => 'required|string',
        ]);

        // Processar o upload da imagem
        $path = null; // Default value
        if ($request->hasFile('receita_foto')) {
            $file = $request->file('receita_foto');
            $path = $file->store('receitas', 'public'); // Store image
        }

        // Criar a receita no banco de dados
        Receita::create([
            'receita_titulo' => $request->receita_titulo,
            'receita_descricao' => $request->receita_descricao,
            'receita_foto' => $path, // Salva o caminho da imagem
            'receita_duracao' => $request->receita_duracao,
            'categoria' => $request->categoria,
            'autor' => $request->autor,
        ]);

        return redirect()->route('receitas.index')->with('success', 'Receita criada com sucesso!');
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
