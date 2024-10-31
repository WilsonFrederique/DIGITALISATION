<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;

class AuthentificationController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function verification(Request $request) {
        // Valider les champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Récupérer les informations de l'employé connecté
            $user = Auth::user();
            $employe = $user->employe;
    
            // Redirection vers la vue personnelle avec les données de l'employé
            return redirect()->intended(route('users.personnel.index'))
                             ->with('employe', $employe);
        }
    
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }    

    public function logout() {
        Auth::logout();

        return to_route('app_public');
    }

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Valider les champs
        $request->validate([
            'numEmp' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Hacher le mot de passe
        $user = User::create([
            'numEmp' => $request->numEmp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('auth.login')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
    }

}
