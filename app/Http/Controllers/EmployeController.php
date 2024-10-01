<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\EmployeFormRequest;
use App\Models\Genererqr;

class EmployeController extends Controller
{

    public function index(Request $request)
    {
        // Compter tous les employés
        $totalEmployes = DB::table('employes')->count();

        $employes = Employe::query();

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

        // Passer les données à la vue
        return view('admin.employe.index', [
            'employes' => $employes->get(),
            'totalEmployes' => $totalEmployes,
            'entreprises' => $entreprises
        ]);
    }


    public function indexProfil(Request $request)
    {
        // Hanao requête amn employe
        $employes = Employe::query()->get();

        $entreprises = Entreprise::all();

        // Amn'io get io no maka anle requête
        return view('admin.employe.toutProfil', [
            'employes' => $employes,
            'entreprises' => $entreprises
        ]);

    }

    public function countEmployes()
    {
        $count = DB::table('employes')->count();

        return $count;
    }

    public function create()
    {
        $employe = new Employe();

        // Récupérer les entreprises
        $entreprises = Entreprise::all();

        return view('admin.employe.form', compact('employe', 'entreprises'));
    }

    public function store(EmployeFormRequest $request)
    {
        try {
            $employeData = $request->validated();

            // Gestion du fichier image
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $filename = time() . '_' . $file->getClientOriginalName(); // Crée un nom unique pour le fichier
                $file->move(public_path('images'), $filename); // Déplace le fichier dans le dossier public/images
                $employeData['images'] = 'images/' . $filename; // Enregistre le chemin de l'image dans la base de données
            }

            // Insertion des données dans la table employes
            DB::table('employes')->insert($employeData);

            return to_route('admin.employes.index')->with('success', 'Employé ajouté avec succès!');

        } catch (\Throwable $th) {
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

        return view('admin.employe.form', compact('employe', 'entreprises'));
    }

    public function update(EmployeFormRequest $request, string $numEmp)
    {
        try {
            $employeData = $request->validated();

            // Vérification si une nouvelle image a été téléchargée
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $filename = time() . '_' . $file->getClientOriginalName(); // Crée un nom unique pour le fichier
                $file->move(public_path('images'), $filename); // Déplace le fichier dans le dossier public/images
                $employeData['images'] = 'images/' . $filename; // Enregistre le chemin de l'image dans la base de données
            }

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
        if ($employe && $employe->images) {
            $imagePath = public_path($employe->images);

            // Vérifier si l'image existe dans le répertoire et la supprimer
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Supprimer l'enregistrement de l'employé de la base de données
        DB::table('employes')
            ->where('numEmp', $numEmp)
            ->delete();

        return redirect()->back()->with('success', 'Employé supprimé avec succès, y compris l\'image.');
    }

}
