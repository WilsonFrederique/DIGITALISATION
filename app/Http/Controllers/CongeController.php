<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employe;
use App\Models\Calendrier;
use App\Models\Entreprise;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CongeFormRequest;

class CongeController extends Controller
{

    public function getCongeCount()
    {
        // Compter toutes les permissions dans la base de données
        // $totalConges = Conge::count();
        $totalConges = DB::table('conges')->where('Validation', 'En attente...')->count();

        // Récupérer le dernier nombre de permissions consultées depuis la session
        $lastCongeCount = session('last_conge_count', 0);

        // Calculer le nombre de nouvelles permissions ajoutées depuis la dernière consultation
        $newConge = $totalConges - $lastCongeCount;
       

        // Si de nouvelles permissions sont ajoutées, renvoyer cette différence, sinon afficher 0
        $displayCounte = $newConge > 0 ? $newConge : 0;

        return response()->json(['count' => $displayCounte]);
    }
    
    public function resetCongeCount()
    {
        // Mettre à jour le dernier nombre de permissions consultées dans la session
        session(['last_conge_count' => Conge::count()]);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $entreprises = Entreprise::all();

        $employes = Employe::all();

        $conges = Conge::all();

        $events = Calendrier::all();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

            $employesAttente = Employe::whereIn('numEmp', Conge::where('Validation', 'En attente...')->pluck('numEmp'))
                ->with(['conges' => function ($query) {
                    $query->where('Validation', 'En attente...');
            }])->get();

            $employesValide = Employe::whereIn('numEmp', Conge::where('Validation', 'Acceptée')->pluck('numEmp'))
            ->with(['conges' => function ($query) {
                $query->where('Validation', 'Acceptée');
            }])->get();

            $employesRefuse = Employe::whereIn('numEmp', Conge::where('Validation', 'Refusée')->pluck('numEmp'))
            ->with(['conges' => function ($query) {
                $query->where('Validation', 'Refusée');
            }])->get();

        // Récupérer les employés avec leurs permissions
        $employes = Employe::whereIn('numEmp', Conge::pluck('numEmp'))->with('conges')->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        return view('admin.conge.index', [
            'entreprises' => $entreprises,
            'employes' => $employes,
            'latestImages' => $latestImages,
            'events' => $events,
            'employesAttente' => $employesAttente,
            'conges' => $conges,
            'employesValide' => $employesValide,
            'employesRefuse' => $employesRefuse,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2,
            'superviseurs' => $superviseurs
        ]);
    }

    public function create()
    {
        $conge = new Conge();

        $events = Calendrier::all();

        // Récupérer les entreprises
        $entreprises = Entreprise::all();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        return view('admin.conge.form', compact('conge', 'entreprises', 'events', 'countInfo1', 'countInfo2', 'superviseurs'));
    }

    public function store($conge = null)
    {
        // Si $conge n'est pas fourni, on est en train de créer un nouveau congé
        if (!$conge) {
            // Récupération des informations de la requête
            $numEmp = request()->input('numEmp');
            $joursDemandes = request()->input('NbrJours');
            $dateActuelle = now();
            
            // Logique pour calculer solde, historique, etc.
            $historiqueConge = Conge::where('numEmp', $numEmp)->orderBy('created_at', 'desc')->first();
            $currentYear = $dateActuelle->year;
          
            if (!$historiqueConge || $historiqueConge->Annee < $currentYear) {
                        $solde = 30; // 30 jours par défaut pour la nouvelle année
                        $joursReportes = 0; // Pas de jours reportés
                    } else {
                        // Réutiliser les valeurs du dernier congé
                        $solde = $historiqueConge->Solde ?? 30;
                        $joursReportes = $historiqueConge->CumulAnnuel ?? 0;
                    }

            //     // Vérifier si le solde est suffisant pour les jours demandés
                if ($joursDemandes > ($solde + $joursReportes)) {
                    return response()->json(['error' => 'Solde insuffisant pour ce congé.'], 400);
                }
            
                // Calculer le nouveau solde et ajuster les jours reportés
                if ($joursDemandes <= $joursReportes) {
                    $joursReportes -= $joursDemandes; // Utiliser uniquement les jours reportés
                } else {
                    $joursRestants = $joursDemandes - $joursReportes; // Jours à soustraire du solde
                    $joursReportes = 0; // Réinitialiser les jours reportés
                    $solde -= $joursRestants; // Ajuster le solde
                }
    
            // Créer un nouveau congé avec les informations et soldes calculés
            try {
                Conge::create([
                    'numEmp' => $numEmp,
                    'NbrJours' => $joursDemandes,
                    'Solde' => $solde,
                    'CumulAnnuel' => $joursReportes,
                    'numSup' => request()->input('numSup'),
                    'Annee' => $currentYear,
                    'Mois' => request()->input('Mois'),
                    'FaiLe' => request()->input('FaiLe'),
                    'DateDebut' => request()->input('DateDebut'),
                    'DateFin' => request()->input('DateFin'),
                    'Motif' => request()->input('Motif'),
                    'NomOrganisation' => request()->input('NomOrganisation'),
                    'Validation' => request()->input('Validation'),
                    'Description' => request()->input('Description'),
                    'created_at' => $dateActuelle,
                    'updated_at' => $dateActuelle
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Une erreur s\'est produite lors de l\'ajout du congé.'], 500);
            }
    
        } else {
            // Si $conge est fourni, c'est une mise à jour, donc ajuster les soldes
            $numEmp = $conge->numEmp;
            $joursDemandes = $conge->NbrJours;
            $dateActuelle = now();
    
            // Logique pour recalculer solde et jours reportés
            $historiqueConge = Conge::where('numEmp', $numEmp)->orderBy('created_at', 'desc')->first();
            $solde = 30;
            $joursReportes = 0;
            $joursRestants = $joursDemandes - $joursReportes; // Jours à soustraire du solde
            $joursReportes = 0; // Réinitialiser les jours reportés
            $solde -= $joursRestants; // Ajuster le solde
            $joursReportes = $historiqueConge ? $historiqueConge->CumulAnnuel : 0;
    
            // Mettre à jour les informations du congé existant
            try {
                $conge->update([
                    'Solde' => $solde,
                    'CumulAnnuel' => $joursReportes,
                    'updated_at' => $dateActuelle
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du solde de congé.'], 500);
            }
        }
    
        // Rediriger vers la liste des congés
        return to_route('admin.conges.index');
    }
    
    

    public function show(string $id)
    {
        //
    }

    public function edit(Conge $conge)
    {
        $conges = Employe::all();
        $events = Calendrier::all();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        return view('admin.conge.form', compact('conge', 'conges', 'events', 'countInfo1', 'countInfo2', 'superviseurs'));
    }

    public function editValidation(Conge $conge)
    {
        $conges = Employe::all();
        $events = Calendrier::all();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

        // Récupérer les employés avec leurs permissions en attente
        $employe = Employe::where('numEmp', $conge->numEmp)->first();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.validationC.form', compact('conge', 'conges', 'events', 'latestImages', 'employe', 'countInfo1', 'countInfo2'));
    }

    public function updateValidation(CongeFormRequest $request, string $id)
    {
        DB::table('conges')
            ->where('id', $id)
            ->update($request->validated());

        return to_route('admin.conges.index');
    } 

    public function update(CongeFormRequest $request, string $id)
    {
        DB::table('conges')
        ->where('id', $id)
        ->update($request->validated());

        $congeMisAJour = Conge::findOrFail($id);

        $this->store($congeMisAJour);
    

        return to_route('admin.conges.index');
    }

    public function destroy(string $id)
    {
        $deleted = DB::table('conges')
        ->where('id', $id)
        ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Employé supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé.');
        }
    }
}
