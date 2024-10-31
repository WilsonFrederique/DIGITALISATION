<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Pointage;
use App\Models\Calendrier;
use App\Models\Conge;
use App\Models\Entreprise;
use App\Models\Permission;
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

        // Récupérer les dernières images de profil pour les employés qui n'ont pas pointé
        $employesSansPointagesAvecImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users WHERE numEmp NOT IN (SELECT numEmp FROM pointages) GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->whereIn('ipu.numEmp', $employesSansPointages->pluck('numEmp'))
            ->select('ipu.*')
            ->get();

        // Récupérer les images de profil des employés qui ont pointé aujourd'hui
        $employesAvecImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) AS latest_id 
                            FROM image_profil_users 
                            WHERE numEmp IN (SELECT numEmp FROM pointages) 
                            GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->select('ipu.*')
            ->get();

        // Récupérer les employés sans pointage mais ayant une permission active pour aujourd'hui
        $employesQuiApermissions = Employe::whereNotIn('numEmp', DB::table('pointages')->select('numEmp'))
            ->whereIn('numEmp', Permission::whereDate('updated_at', now())
                ->whereDate('DateDebut', '<=', now())
                ->whereDate('DateFin', '>=', now())
                ->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->whereDate('updated_at', now())
                    ->whereDate('DateDebut', '<=', now())
                    ->whereDate('DateFin', '>=', now());
            }])
            ->get();

        // Récupérer les employés sans pointage mais ayant une congé active pour aujourd'hui
        $employesQuiConges = Employe::whereNotIn('numEmp', DB::table('pointages')->select('numEmp'))
            ->whereIn('numEmp', Conge::whereDate('updated_at', now())
                ->whereDate('DateDebut', '<=', now())
                ->whereDate('DateFin', '>=', now())
                ->pluck('numEmp'))
            ->with(['conges' => function ($query) {
                $query->whereDate('updated_at', now())
                    ->whereDate('DateDebut', '<=', now())
                    ->whereDate('DateFin', '>=', now());
            }])
            ->get();

        // $employesAbsenteTotal = DB::table('employes')
        //     ->whereNotIn('numEmp', function ($query) {
        //         $query->select('numEmp')->from('pointages');
        //     })
        //     ->whereNotIn('numEmp', function ($query) {
        //         $query->select('numEmp')
        //             ->from('permissions')
        //             ->whereDate('updated_at', '=', DB::raw('CURDATE()'))
        //             ->where(DB::raw('CURDATE()'), '>=', 'DateDebut')
        //             ->where(DB::raw('CURDATE()'), '<=', 'DateFin');
        //     })
        //     ->select('numEmp', 'Nom', 'Prenom')
        //     ->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        // Passer les données à la vue
        return view('admin.pointage.index', [
            'totalPointageAujourdhui' => $totalPointageAujourdhui,
            'countEmployesSansPointagesAujourdhuit' => $countEmployesSansPointagesAujourdhuit,
            'pointages' => $pointages,
            'entreprises' => $entreprises,
            'employesSansPointages' => $employesSansPointages,
            'employesSansPointagesAvecImages' => $employesSansPointagesAvecImages,
            'employesAvecImages' => $employesAvecImages,
            'events' => $events,
            'employesQuiApermissions' => $employesQuiApermissions,
            'employesQuiConges' => $employesQuiConges,
            // 'employesAbsenteTotal' => $employesAbsenteTotal,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2
        ]);
    }

    // ========== Verification du Code QR Si employe ici ou pas =========
    public function checkNumEmp(Request $request) {
        $exists = Employe::where('numEmp', $request->input('numEmp'))->exists();
    
        return response()->json(['exists' => $exists]);
    }


    public function create()
    {
        $employe = new Employe();

        $events = Calendrier::all();

        // Récupérer les entreprises
        $entreprises = Entreprise::all();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.genererqr.form', compact('employe', 'entreprises', 'events', 'countInfo1', 'countInfo2'));
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
