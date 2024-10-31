<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccueilController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $events = Calendrier::all();

        $countInfo1 = DB::table('permissions')
            ->where('Validation', 'En attente...')
            ->count();
        $countInfo2 = DB::table('conges')
            ->where('Validation', 'En attente...')
            ->count();
        
        return view('admin.accueil.index', compact('events', 'countInfo1', 'countInfo2'));
    }
}
