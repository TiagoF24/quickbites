<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannedUserController extends Controller
{
    /**
     * Display the banned user page.
     */
    public function index()
    {
        return view('auth.banned');
    }

    /**
     * Check if the authenticated user is banned.
     */
    public function check()
    {
        if (Auth::user()->is_banned) {
            Auth::logout();
            
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            
            return redirect()->route('login')
                ->withErrors(['email' => 'A sua conta foi suspensa. Por favor, contacte o administrador.']);
        }
        
        return redirect()->intended('/');
    }
}
