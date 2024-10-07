<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $events = Calendrier::all();
        return view('admin.accueil.index', compact('entreprises', 'events'));
    }
}
