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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\GenererQrFormRequest;

class GenererQrController extends Controller
{

    public function index(Request $request)
    {
        // Charger les relations avec 'employes' dans genererqrs
        $genererqrs = Genererqr::query()->with('employes');

        // Obtenir toutes les entreprises et événements
        $entreprises = Entreprise::all();
        $events = Calendrier::all();

        // Obtenir les numEmp présents dans la table genererqrs
        $numEmpAvecQR = Genererqr::pluck('numEmp');  // Cette requête sera utilisée pour les employés n'ayant pas de QR généré

        // Récupérer les employés dont le numEmp n'est pas dans la liste
        $employes = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();
        $employes_dans_scans = $employes;

        // Si une recherche est effectuée
        if ($recherche = $request->input('Rechercher')) {
            $genererqrs->whereHas('employes', function ($query) use ($recherche) {
                $query->where('Nom', 'LIKE', '%' . $recherche . '%')
                    ->orWhere('Prenom', 'LIKE', '%' . $recherche . '%')
                    ->orWhere('Poste', 'LIKE', '%' . $recherche . '%');
            });
        }

        // Récupérer les dernières images des employés qui ont un QR
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->whereIn('ipu.numEmp', function($query) {
                $query->select('numEmp')->from('genererqrs');
            })
            ->select('ipu.*')
            ->get();

        // Récupérer les résultats
        return view('admin.genererqr.index', [
            'genererqrs' => $genererqrs->get(),
            'employes' => $employes,
            'employes_dans_scans' => $employes_dans_scans,
            'entreprises' => $entreprises,
            'latestImages' => $latestImages,
            'events' => $events,
        ]);
    }

    public function indexScanGen() {
        $numEmpAvecQR = Genererqr::pluck('numEmp');
        $emps = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();
    
        // Récupérer les résultats
        return view('admin.genererqr.scanner', [
            'emps' => $emps,
            'events' => Calendrier::all(),
        ]);
    }

    public function scanner(Request $request)
    {
        $employes = Employe::all();

        return view('admin.genererqr.scanner', compact('employes'));
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

        // Récupérer les dernières images des employés qui ont un QR
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->whereIn('ipu.numEmp', function($query) {
                $query->select('numEmp')->from('genererqrs');
            })
            ->select('ipu.*')
            ->get();

            $pdf = PDF::loadView('admin.badje.pdfBadge', compact('badge', 'events', 'latestImages'));

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
        $events = Calendrier::all();
        // Obtenir les numEmp présents dans la table genererqrs
        $numEmpAvecQR = Genererqr::pluck('numEmp');
        $employes = Employe::whereNotIn('numEmp', $numEmpAvecQR)->get();
        return view('admin.genererqr.form', compact('events', 'employes'));
    }

    public function store(GenererQrFormRequest $request)
    {
        $request->validate([
            'numEmp' => 'required|string',
            'imageqr' => 'required', // Validation pour vérifier que l'image est présente
        ]);
    
        $numEmp = $request->input('numEmp');
        $imageqr = $request->input('imageqr'); // Image QR en base64
    
        // Décoder l'image base64 et enregistrer dans le dossier public/images/qrcodes
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageqr));
        $imageName = 'qr_' . $numEmp . '_' . time() . '.png';
        $path = public_path('images/' . $imageName);
        file_put_contents($path, $imageData);
    
        // Enregistrer dans la base de données
        Genererqr::create([
            'numEmp' => $numEmp,
            'imageqr' => $imageName, // Sauvegarde du nom de l'image
        ]);
    
        return redirect()->back()->with('success', 'QR Code généré et sauvegardé avec succès.');
    }   

    public function show(string $id)
    {
        // Récupérer tous les événements
        $events = Calendrier::all();

        // Récupérer les données de 'genererqr' associées à l'employé avec l'id donné
        $genererqr = Genererqr::with('employes')
                                ->where('id', $id)
                                ->firstOrFail();

        // Récupérer les dernières images des employés qui ont un QR
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->whereIn('ipu.numEmp', function($query) {
                $query->select('numEmp')->from('genererqrs');
            })
            ->select('ipu.*')
            ->get();

        // Passer à la vue à la fois $genererqr et $events
        return view('admin.badje.index', [
            'genererqr' => $genererqr,
            'latestImages' => $latestImages,
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
