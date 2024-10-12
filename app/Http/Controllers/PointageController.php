<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Pointage;
use App\Models\Calendrier;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    // ========== Verification du Code QR Si employe ici ou pas =========
    public function checkNumEmp(Request $request) {
        $exists = Employe::where('numEmp', $request->input('numEmp'))->exists();
    
        return response()->json(['exists' => $exists]);
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

    public function destroy(string $id)
    {
        $deleted = DB::table('pointages')
                ->where('id', $id)
                ->delete();

        if ($deleted) {
            // Si la suppression a réussi
            return redirect()->back()->with('success', 'Pointages supprimé avec succès.');
        } else {
            // Si la suppression a échoué
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé.');
        }
    }
}
