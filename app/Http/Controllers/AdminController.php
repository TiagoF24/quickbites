<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receita;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Constructor to check admin access
     */
    public function __construct()
    {
        // Don't use middleware() here - it's causing the error
        // Instead, we'll check admin status directly in each method
    }
    
    /**
     * Check if the current user is an admin
     */
    private function checkAdmin()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }
    }
    
    /**
     * Display admin dashboard
     */
    public function index(Request $request)
    {
        $this->checkAdmin();
        
        $search = $request->input('search');
        
        $users = User::when($search, function($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);
        
        $receitas = Receita::with('user')
            ->when($search, function($query) use ($search) {
                return $query->where('receita_titulo', 'like', "%{$search}%")
                             ->orWhere('categoria', 'like', "%{$search}%");
            })->paginate(10);
        
        $categorias = Categorias::when($search, function($query) use ($search) {
            return $query->where('nome', 'like', "%{$search}%");
        })->paginate(10);
        
        return view('admin.dashboard', compact('users', 'receitas', 'categorias', 'search'));
    }
    
    /**
     * Ban/unban a user
     */
    public function toggleUserBan(Request $request, User $user)
    {
        $this->checkAdmin();
        
        $user->is_banned = !$user->is_banned;
        $user->save();
        
        $status = $user->is_banned ? 'banido' : 'desbanido';
        return redirect()->route('admin.dashboard')->with('success', "Utilizador {$status} com sucesso!");
    }
    
    /**
     * Delete a recipe
     */
    public function deleteReceita(Receita $receita)
    {
        $this->checkAdmin();
        
        // Delete the recipe image if exists
        if ($receita->receita_foto && file_exists(storage_path('app/public/' . $receita->receita_foto))) {
            unlink(storage_path('app/public/' . $receita->receita_foto));
        }
        
        $receita->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Receita eliminada com sucesso!');
    }
}
