<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        return view('admin.accueil.index', compact('entreprises'));
    }
}
