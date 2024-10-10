<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Genererqr;
use App\Models\Calendrier;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\GenererQrFormRequest;

class GenererQrController extends Controller
{

    // public function index(Request $request)
    // {
    //     // Requête pour les QR codes générés
    //     $genererqrs = Genererqr::query()
    //     ->with('employes'); // Charger la relation employes

    //     $entreprises = Entreprise::all();

    //     $events = Calendrier::all();

    //     // Pour les employes pas en code QR
    //     $numEmpAvecQR = Genererqr::pluck('numEmp');
    //     $employes = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();

    //     // Si une recherche est effectuée
    //     if ($recherche = $request->input('Rechercher')) {
    //         $genererqrs->whereHas('employes', function ($query) use ($recherche) {
    //             $query->where('Nom', 'LIKE', '%' . $recherche . '%')
    //                 ->orWhere('Prenom', 'LIKE', '%' . $recherche . '%')
    //                 ->orWhere('Poste', 'LIKE', '%' . $recherche . '%');
    //         });
    //     }

    //     // Récupérer les résultats
    //     return view('admin.genererqr.index', [
    //         'genererqrs' => $genererqrs->get(),
    //         'employes' => $employes,
    //         'entreprises' => $entreprises,
    //         'events' => $events
    //     ]);
    // }

    public function index(Request $request)
    {
        $genererqrs = Genererqr::query()->with('employes');

        $entreprises = Entreprise::all();
        $events = Calendrier::all();

        // Obtenir les numEmp présents dans la table genererqrs
        $numEmpAvecQR = Genererqr::pluck('numEmp');

        // Récupérer les employés dont le numEmp n'est pas dans la liste
        $employes = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();

        // Si une recherche est effectuée
        if ($recherche = $request->input('Rechercher')) {
            $genererqrs->whereHas('employes', function ($query) use ($recherche) {
                $query->where('Nom', 'LIKE', '%' . $recherche . '%')
                    ->orWhere('Prenom', 'LIKE', '%' . $recherche . '%')
                    ->orWhere('Poste', 'LIKE', '%' . $recherche . '%');
            });
        }

        // Récupérer les résultats
        return view('admin.genererqr.index', [
            'genererqrs' => $genererqrs->get(),
            'employes' => $employes, // Assurez-vous que cette ligne est présente
            'entreprises' => $entreprises,
            'events' => $events,
        ]);
    }

    public function scanner(Request $request)
    {
        // Obtenir les numEmp présents dans la table genererqrs
        $numEmpAvecQR = Genererqr::pluck('numEmp');

        // Récupérer les employés dont le numEmp n'est pas dans la liste
        $employespasQRs = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();

        // Debug : afficher les employés (facultatif, à retirer une fois testé)
        dd($employespasQRs);

        // Retourner la vue avec la liste des employés
        return view('admin.genererqr.scanner', [
            'employespasQRs' => $employespasQRs,
        ]);
    }

    public function listeEmployeNonCodeQR(Request $request)
    {
        // Obtenir les numEmp présents dans la table genererqrs
        $numEmpAvecQR = Genererqr::pluck('numEmp');

        $entreprises = Entreprise::all();

        $events = Calendrier::all();

        // Récupérer les employés dont le numEmp n'est pas dans la liste
        $employes = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();

        // Retourner la vue avec la liste des employés
        return view('admin.genererqr.index', [
            'employes' => $employes,
            'entreprises' => $entreprises,
            'events' => $events
        ]);
    }

    public function telechargerBadge($id)
    {
        $badge = Genererqr::findOrFail($id);

        $events = Calendrier::all();

        $pdf = PDF::loadView('admin.badje.pdfBadge', compact('badge', 'events'));
        return $pdf->download('Badge_pour_' . $badge->id . '.pdf');
    }

    public function pageScannerQR()
    {        
        $events = Calendrier::all();

        return view('admin.genererqr.scanner', [
            'events' => $events
        ]);
    }

    public function create()
    {
        //
    }

    public function store(GenererQrFormRequest $request)
    {
        try {
            $qrData = $request->validated();

            DB::table('genererqrs')->insert($qrData);

            return to_route('admin.genereqrs.index')->with('success', 'QR Code généré et enregistré avec succès.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Erreur: ' . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        // Récupérer tous les événements
        $events = Calendrier::all();

        // Récupérer les données de 'genererqr' associées à l'employé avec l'id donné
        $genererqr = Genererqr::with('employes')
                                ->where('id', $id)
                                ->firstOrFail();

        // Passer à la vue à la fois $genererqr et $events
        return view('admin.badje.index', [
            'genererqr' => $genererqr,
            'events' => $events 
        ]);
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
        $deleted = DB::table('genererqrs')
                ->where('id', $id)
                ->delete();

        if ($deleted) {
            // Si la suppression a réussi
            return redirect()->back()->with('success', 'Employé supprimé avec succès.');
        } else {
            // Si la suppression a échoué
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé.');
        }
    }
}
