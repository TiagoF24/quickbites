<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;




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
        try {
            // Buscar a receita com relacionamentos
            $receita = Receita::with(['ratings', 'autorRelation'])->findOrFail($id);

            // Buscar receitas relacionadas (mesma categoria)
            $receitasRelacionadas = Receita::where('categoria', $receita->categoria)
                ->where('id', '!=', $receita->id)
                ->take(3)
                ->get();

            // Verificar se o usuário atual já avaliou esta receita
            $userRating = null;
            if (Auth::check()) {
                $userRating = $receita->ratings()->where('user_id', Auth::id())->first();
            }

            return view('receitas.show', compact('receita', 'receitasRelacionadas', 'userRating'));
        } catch (\Exception $e) {
            Log::error('Erro ao mostrar receita: ' . $e->getMessage());
            return redirect()->route('receitas.index')->with('error', 'Receita não encontrada.');
        }
    }

    public function edit(Receita $receita)
    {
        // Verificar se o usuário atual é o autor da receita
        if (Auth::id() != $receita->autor_id) {
            return redirect()->route('receitas.show', $receita->id)
                ->with('error', 'Tu não tens permissão para editar esta receita.');
        }

        return view('receitas.edit', compact('receita'));
    }

    public function update(Request $request, Receita $receita)
    {
        // Verificar se o usuário atual é o autor da receita
        if (Auth::id() != $receita->autor_id) {
            return redirect()->route('receitas.show', $receita->id)
                ->with('error', 'Tu não tens permissão para editar esta receita.');
        }

        // Validar os dados do formulário
        $validated = $request->validate([
            'receita_titulo' => 'required|max:255',
            'receita_descricao' => 'required',
            'receita_duracao' => 'required|integer|min:1',
            'porcoes' => 'required|integer|min:1',
            'nivel_dificuldade' => 'required',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'modo_preparo' => 'required',
            'calorias' => 'nullable|integer|min:0',
            'dicas' => 'nullable',
            'receita_foto' => 'nullable|image|max:2048',
        ]);

        // Atualizar os dados da receita
        $receita->receita_titulo = $validated['receita_titulo'];
        $receita->receita_descricao = $validated['receita_descricao'];
        $receita->receita_duracao = $validated['receita_duracao'];
        $receita->porcoes = $validated['porcoes'];
        $receita->nivel_dificuldade = $validated['nivel_dificuldade'];
        $receita->categoria = $validated['categoria'];
        $receita->ingredientes = $validated['ingredientes'];
        $receita->modo_preparo = $validated['modo_preparo'];
        $receita->calorias = $validated['calorias'];
        $receita->dicas = $validated['dicas'];

        // Processar a imagem se foi enviada
        if ($request->hasFile('receita_foto')) {
            // Excluir a imagem antiga se existir
            if ($receita->receita_foto && Storage::exists('public/' . $receita->receita_foto)) {
                Storage::delete('public/' . $receita->receita_foto);
            }

            // Armazenar a nova imagem
            $path = $request->file('receita_foto')->store('receitas', 'public');
            $receita->receita_foto = $path;
        }

        $receita->save();

        return redirect()->route('receitas.show', $receita->id)
            ->with('success', 'Receita atualizada com sucesso!');
    }


    public function userFavorites($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $favorites = $user->favoriteReceitas()->paginate(12);

        return view('receitas.favorites', compact('user', 'favorites'));
    }

    public function destroy(Receita $receita)
    {
        // Check if the current user is the author of the recipe
        if (Auth::id() != $receita->autor_id) {
            return redirect()->route('receitas.show', $receita->id)
                ->with('error', 'Tu não tens permissão para excluir esta receita.');
        }

        // Delete the associated image
        if ($receita->receita_foto && Storage::exists('public/' . $receita->receita_foto)) {
            Storage::delete('public/' . $receita->receita_foto);
        }

        // Delete related ratings and favorites
        DB::table('ratings')->where('receita_id', $receita->id)->delete();
        DB::table('favorites')->where('receita_id', $receita->id)->delete();

        // Delete the recipe
        $receita->delete();

        return redirect()->route('receitas.index')
            ->with('success', 'Receita excluída com sucesso!');
    }


    /**
     * Remove uma avaliação de uma receita.
     *
     * @param \App\Models\Receita $receita
     * @param int $rating
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function deleteRating(Receita $receita, $rating)
    {
        // Encontrar a avaliação
        $ratingModel = \App\Models\Rating::findOrFail($rating);

        // Verificar se o usuário atual é o dono da avaliação
        if ($ratingModel->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Tu não tens permissão para excluir esta avaliação.');
        }

        // Verificar se a avaliação pertence à receita especificada
        if ($ratingModel->receita_id !== $receita->id) {
            return redirect()->back()->with('error', 'Avaliação não encontrada para esta receita.');
        }

        // Excluir a avaliação
        $ratingModel->delete();

        return redirect()->back()->with('success', 'Avaliação excluída com sucesso.');
    }

    public function rate(Request $request, Receita $receita)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    // Verificar se o usuário já avaliou esta receita
    $existingRating = $receita->ratings()->where('user_id', auth()->id())->first();

    if ($existingRating) {
        // Atualizar avaliação existente
        $existingRating->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back()->with('success', 'Sua avaliação foi atualizada com sucesso!');
    } else {
        // Criar nova avaliação
        $receita->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back()->with('success', 'Sua avaliação foi enviada com sucesso!');
    }
}



}