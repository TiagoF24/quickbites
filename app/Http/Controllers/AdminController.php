<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Adicionar a importação de Auth

class AdminController extends Controller
{
    public function index()
    {
        // Verificando se o usuário está autenticado e se é um administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return view('admin.index');
        }

        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
}