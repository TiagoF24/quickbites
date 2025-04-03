<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{


    public function toggle(Request $request, $receitaId)
    {
        $receita = Receita::findOrFail($receitaId);
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('receita_id', $receita->id)
            ->first();

        if ($favorite) {
            // If already favorited, remove favorite
            $favorite->delete();
            $isFavorited = false;
        } else {
            // If not favorited, add favorite
            Favorite::create([
                'user_id' => $user->id,
                'receita_id' => $receita->id
            ]);
            $isFavorited = true;
        }

        if ($request->ajax()) {
            return response()->json([
                'favorited' => $isFavorited,
                'count' => $receita->favorites()->count()
            ]);
        }

        return redirect()->back()->with('success', $isFavorited ?
            'Receita adicionada aos favoritos!' :
            'Receita removida dos favoritos!');
    }

    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favoriteReceitas()->paginate(12);

        return view('favorites.index', compact('favorites'));
    }
}