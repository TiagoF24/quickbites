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
        // Validação dos dados
        $request->validate([
            'receita_titulo' => 'required|string|max:255',
            'receita_descricao' => 'required|string',
            'receita_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'receita_duracao' => 'required|integer',
            'porcoes' => 'required|integer',
            'nivel_dificuldade' => 'required|string',
            'calorias' => 'nullable|integer',
            'categoria' => 'required|string',
            'ingredientes' => 'required|string',
            'modo_preparo' => 'required|string',
            'dicas' => 'nullable|string',
            'autor' => 'required|string',
            'autor_id' => 'required|integer',
        ]);

        // Salvar a receita
        $receita = new Receita();
        $receita->receita_titulo = $request->receita_titulo;
        $receita->receita_descricao = $request->receita_descricao;
        // Lógica para salvar a imagem, se necessário
        if ($request->hasFile('receita_foto')) {
            $path = $request->file('receita_foto')->store('fotos_receitas', 'public');
            $receita->receita_foto = $path;
        }
        $receita->receita_duracao = $request->receita_duracao;
        $receita->porcoes = $request->porcoes;
        $receita->nivel_dificuldade = $request->nivel_dificuldade;
        $receita->calorias = $request->calorias;
        $receita->categoria = $request->categoria;
        $receita->ingredientes = $request->ingredientes;
        $receita->modo_preparo = $request->modo_preparo;
        $receita->dicas = $request->dicas;
        $receita->autor = $request->autor;
        $receita->autor_id = $request->autor_id;

        $receita->save();

        return redirect()->route('receitas.index')->with('success', 'Receita criada com sucesso!');
    }



    /**
     * Mostra uma listagem receitas.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Cria a query base
        $query = Receita::query();

        // Filtro por nome da receita
        if ($request->has('search') && !empty($request->get('search'))) {
            $query->where('receita_titulo', 'like', '%' . $request->get('search') . '%');
        }

        // Filtro por categoria
        if ($request->has('category') && !empty($request->get('category'))) {
            $query->where('categoria', $request->get('category'));
        }

        // Filtro por duração (maior ou menor que)
        if ($request->has('duracao') && !empty($request->get('duracao'))) {
            $duracao = $request->get('duracao');
            $operador = substr($duracao, 0, 1);
            $valor = (int) substr($duracao, 1);
            if ($operador == '>' || $operador == '<') {
                $query->where('receita_duracao', $operador, $valor);
            }
        }

        // Filtro por nível de dificuldade
        if ($request->has('dificuldade') && !empty($request->get('dificuldade'))) {
            $query->where('nivel_dificuldade', $request->get('dificuldade'));
        }

        // Filtro por calorias (maior ou menor que)
        if ($request->has('calorias') && !empty($request->get('calorias'))) {
            $calorias = $request->get('calorias');
            $operador = substr($calorias, 0, 1);
            $valor = (int) substr($calorias, 1);
            if ($operador == '>' || $operador == '<') {
                $query->where('calorias', $operador, $valor);
            }
        }

        // Recupera as receitas filtradas ou todas
        $receitas = $query->orderBy('id', 'desc')->get();

        // Buscar todas as categorias do banco de dados
        $categorias = \App\Models\Categorias::orderBy('nome')->get();

        // Filtros de Dificuldade
        $dificuldades = ['Fácil', 'Médio', 'Difícil'];

        return view('receitas.index', compact('receitas', 'categorias', 'dificuldades'));
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
