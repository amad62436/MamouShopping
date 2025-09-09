<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function showLoginForm()
    {
        // Redirige si déjà connecté
        if (Auth::check()) {
            return redirect($this->redirectTo);
        }
        
        return view('clients.login');
    }

    public function login(Request $request)
    {
        // Redirige si déjà connecté
        if (Auth::check()) {
            return redirect($this->redirectTo);
        }

        // Validation des données
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo)
                ->with('success', 'Connexion réussie !');
        }

        // Si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }
}