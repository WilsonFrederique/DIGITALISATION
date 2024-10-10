<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Calendrier;
use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function index()
    {
        // Compter le nombre de pointages pour aujourd'hui
        $totalPointageAujourdhui = Pointage::whereDate('created_at', now()->today())->count();

        // Récupérer les pointages d'aujourd'hui
        $pointages = Pointage::whereDate('created_at', now()->today())->get();

        // Récupérer les numEmp qui ont pointé aujourd'hui
        $pointagesB = Pointage::whereDate('created_at', now()->today())->pluck('numEmp');

        // Compter les employés qui n'ont pas pointé aujourd'hui
        $countEmployesSansPointagesAujourdhuit = Employe::whereNotIn('numEmp', $pointagesB)->count();

        // Récupérer les employés qui n'ont pas pointé aujourd'hui
        $employesSansPointages = Employe::whereNotIn('numEmp', $pointagesB)->get();

        // Récupérer tous les événements et entreprises
        $events = Calendrier::all();
        $entreprises = Entreprise::all();

        // Passer les données à la vue
        return view('admin.pointage.index', [
            'totalPointageAujourdhui' => $totalPointageAujourdhui,
            'countEmployesSansPointagesAujourdhuit' => $countEmployesSansPointagesAujourdhuit,
            'pointages' => $pointages,
            'entreprises' => $entreprises,
            'employesSansPointages' => $employesSansPointages,
            'events' => $events
        ]);
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'numEmp' => 'required|string'
        ]);

        Pointage::create([
            'numEmp' => $request->numEmp
        ]);

        return response()->json(['message' => 'Données ajoutées avec succès']);
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
