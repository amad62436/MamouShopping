<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        // Redirige si déjà connecté
        if (Auth::check()) {
            return redirect($this->redirectTo);
        }
        
        return view('clients.register');
    }

    public function register(Request $request)
    {
        // Redirige si déjà connecté
        if (Auth::check()) {
            return redirect($this->redirectTo);
        }

        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'customer',
        ]);

        // Connexion automatique après inscription
        Auth::login($user);

        return redirect($this->redirectTo)
            ->with('success', 'Inscription réussie ! Bienvenue ' . $user->name);
    }
}