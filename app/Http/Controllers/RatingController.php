<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    public function store(Request $request, $receitaId)
    {
        // Validação básica
        $validated = $request->validate([
            'rating' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        try {
            // Encontrar a receita
            $receita = Receita::findOrFail($receitaId);

            // Criar ou atualizar a avaliação
            $rating = Rating::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'receita_id' => $receitaId
                ],
                [
                    'rating' => $request->rating,
                    'comment' => $request->comment
                ]
            );

            return redirect()->back()->with('success', 'Avaliação enviada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar avaliação: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao enviar sua avaliação.');
        }
    }
}