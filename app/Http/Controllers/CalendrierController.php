<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CalendrieFormRequest;

class CalendrierController extends Controller
{
    // Afficher tous les événements
    public function index()
    {
        $events = Calendrier::all();
        return view('admin.calendrier.pivotCal', compact('events'));
    }

    // Ajouter un nouvel événement
    public function store(CalendrieFormRequest $request)
    {
        try {
            // Récupérez les données validées
            $calendrierData = $request->validated();

            // Insertion des données dans la table calendriers
            Calendrier::create($calendrierData);  // Utilisation du modèle pour l'insertion

            // return response()->json(['success' => true, 'message' => 'Événement ajouté avec succès']);
            return redirect()->route('admin.calendrier.index')->with('success', 'Événement ajouté avec succès !');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    // Supprimer un événement
    public function destroy($id)
    {
        Calendrier::destroy($id);
        return redirect()->back()->with('success', 'Événement supprimé avec succès !');
    }
}
