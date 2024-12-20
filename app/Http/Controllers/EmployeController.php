<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Genererqr;
use App\Models\Calendrier;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\EmployeFormRequest;

class EmployeController extends Controller
{

    public function index(Request $request)
    {
        // Compter tous les employés
        $totalEmployes = DB::table('employes')->count();

        $employes = Employe::query();

        // Filtrer uniquement les superviseurs
        $employeSuperviseur = Employe::where('Personnel', 'Superviseur')->get();
        
        $events = Calendrier::all();

        $entreprises = Entreprise::all();

        if ($poste = $request->input('RechercherPoste')) {
            $employes->where('Poste', '=', $poste);
        }

        if ($recherche = $request->input('Rechercher')) {
            $employes->where(function($query) use ($recherche) {
                $query->where('numEmp', 'LIKE', '%' . $recherche . '%')
                    ->orWhere('Nom', 'LIKE', '%' . $recherche . '%')
                    ->orWhere('Prenom', 'LIKE', '%' . $recherche . '%');
            });
        }

        $countPresent = Employe::whereIn('numEmp', function($query) {
            $query->select('numEmp')
                  ->from('pointages')
                  ->whereDate('created_at', now()->toDateString());
        })->count();

        $countAbsent = Employe::whereNotIn('numEmp', function($query) {
            $query->select('numEmp')
                  ->from('pointages')
                  ->whereDate('created_at', now()->toDateString());
        })->count();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        // Passer les données à la vue
        return view('admin.employe.index', [
            'employes' => $employes->get(),
            'employeSuperviseur' => $employeSuperviseur,
            'totalEmployes' => $totalEmployes,
            'entreprises' => $entreprises,
            'countPresent' => $countPresent,
            'countAbsent' => $countAbsent,
            'events' => $events,
            'latestImages' => $latestImages,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2
        ]);
    }

    public function indexProfil(Request $request)
    {
        // Hanao requête amn employe
        $employes = Employe::query()->get();

        $entreprises = Entreprise::all();

        $events = Calendrier::all();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        // Amn'io get io no maka anle requête
        return view('admin.employe.toutProfil', [
            'employes' => $employes,
            'entreprises' => $entreprises,
            'latestImages' => $latestImages,
            'events' => $events,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2
        ]);

    }

    public function countEmployes()
    {
        $count = DB::table('employes')->count();

        return $count;
    }

    // Méthode pour générer le PDF
    public function telechargerPDF($numEmp)
    {
        $employe = Employe::findOrFail($numEmp); // Récupère l'employé ou affiche une erreur 404

        $pdf = PDF::loadView('admin.employe.pdfChaqueEmploye', compact('employe'));
        return $pdf->download('profil_employe_' . $employe->numEmp . '.pdf');
    }

    public function genereteAllPdf(){
        $employes = Employe::all();

        $pdf = PDF::loadView('admin.employe.pdf_tout', compact('employes'));
        return $pdf->download('pdf_tout.pdf');
    }

    public function create()
    {
        $employe = new Employe();

        $events = Calendrier::all();

        // Récupérer les entreprises
        $entreprises = Entreprise::all();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.employe.form', compact('employe', 'entreprises', 'events', 'countInfo1', 'countInfo2'));
    }

    public function store(EmployeFormRequest $request)
    {
        try {
            $employeData = $request->validated();

            // Insertion des données dans la table employes
            DB::table('employes')->insert($employeData);

            return to_route('admin.employes.index')->with('success', 'Employé ajouté avec succès!');

        } catch (\Throwable $th) {
            Log::error('Erreur lors de l\'ajout ou la modification de l\'employé: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Employe $employe)
    {
        // Récupérer les entreprises
        $entreprises = Entreprise::all();

        $events = Calendrier::all();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.employe.form', compact('employe', 'entreprises', 'events', 'countInfo1', 'countInfo2'));
    }

    public function update(EmployeFormRequest $request, string $numEmp)
    {
        try {
            $employeData = $request->validated();

            // Mise à jour des informations dans la table employes
            DB::table('employes')
                ->where('numEmp', $numEmp)
                ->update($employeData);

            return to_route('admin.employes.index')->with('success', 'Employé modifié avec succès!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function destroy(string $numEmp)
    {
        // Récupérer l'employé pour obtenir le chemin de l'image
        $employe = DB::table('employes')->where('numEmp', $numEmp)->first();

        // Vérifier si l'employé existe et s'il a une image associée
        // if ($employe && $employe->images) {
        //     $imagePath = public_path($employe->images);

        //     // Vérifier si l'image existe dans le répertoire et la supprimer
        //     if (file_exists($imagePath)) {
        //         unlink($imagePath);
        //     }
        // }

        // Supprimer l'enregistrement de l'employé de la base de données
        DB::table('employes')
            ->where('numEmp', $numEmp)
            ->delete();

        return redirect()->back()->with('success', 'Employé supprimé avec succès, y compris l\'image.');
    }

}
