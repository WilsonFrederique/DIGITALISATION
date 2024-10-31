<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Calendrier;
use App\Models\Entreprise;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PermissionFormRequest;
use App\Models\Conge;

class PermissionController extends Controller
{

    public function getPermissionCount()
    {
        // Compter toutes les permissions dans la base de données
        // $totalPermissions = Permission::count();
        $totalPermissions = DB::table('permissions')->where('Validation', 'En attente...')->count();

        // Récupérer le dernier nombre de permissions consultées depuis la session
        $lastPermissionCount = session('last_permission_count', 0);

        // Calculer le nombre de nouvelles permissions ajoutées depuis la dernière consultation
        $newPermission = $totalPermissions - $lastPermissionCount;
       

        // Si de nouvelles permissions sont ajoutées, renvoyer cette différence, sinon afficher 0
        $displayCounte = $newPermission > 0 ? $newPermission : 0;

        return response()->json(['count' => $displayCounte]);
    }
    
    public function resetPermissionCount()
    {
        // Mettre à jour le dernier nombre de permissions consultées dans la session
        session(['last_permission_count' => Permission::count()]);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $entreprises = Entreprise::all();
        $employes = Employe::all();
        $events = Calendrier::all();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

        // Récupérer les employés avec leurs permissions en attente
        $employes = Employe::whereIn('numEmp', Permission::where('Validation', 'En attente...')->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->where('Validation', 'En attente...');
            }])->get();

        $permissionAccepters = Employe::whereIn('numEmp', Permission::where('Validation', 'Acceptée')->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->where('Validation', 'Acceptée');
            }])->get();

        $permissionRefusee = Employe::whereIn('numEmp', Permission::where('Validation', 'Refusée')->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->where('Validation', 'Refusée');
            }])->get();

        // $permissions = Permission::all();
        $permissions = Permission::orderBy('id', 'desc')->get();

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

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.permission.index', [
            'entreprises' => $entreprises,
            'employes' => $employes,
            'permissionAccepters' => $permissionAccepters,
            'permissionRefusee' => $permissionRefusee,
            'permissions' => $permissions,
            'latestImages' => $latestImages,
            'employesQuiApermissions' => $employesQuiApermissions,
            'superviseurs' => $superviseurs,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2,
            'events' => $events
        ]);
    }

    public function indexLettrePermission()
    {
        $entreprises = Entreprise::all();
        $employes = Employe::all();
        $events = Calendrier::all();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

        // Récupérer les employés avec leurs permissions en attente
        $employes = Employe::whereIn('numEmp', Permission::where('Validation', 'En attente...')->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->where('Validation', 'En attente...');
            }])->get();

        $permissionAccepters = Employe::whereIn('numEmp', Permission::where('Validation', 'Acceptée')->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->where('Validation', 'Acceptée');
            }])->get();

        $permissionRefusee = Employe::whereIn('numEmp', Permission::where('Validation', 'Refusée')->pluck('numEmp'))
            ->with(['permissions' => function ($query) {
                $query->where('Validation', 'Refusée');
            }])->get();

        // $permissions = Permission::all();
        $permissions = Permission::orderBy('id', 'desc')->get();

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

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.permission.text', [
            'entreprises' => $entreprises,
            'employes' => $employes,
            'permissionAccepters' => $permissionAccepters,
            'permissionRefusee' => $permissionRefusee,
            'permissions' => $permissions,
            'latestImages' => $latestImages,
            'employesQuiApermissions' => $employesQuiApermissions,
            'superviseurs' => $superviseurs,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2,
            'events' => $events
        ]);
    }

    public function create()
    {
        $employe = new Employe();
        $permission = new Permission();
        $events = Calendrier::all();
        $entreprises = Entreprise::all();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        return view('admin.permission.form', compact('employe', 'entreprises', 'events', 'permission', 'countInfo1', 'countInfo2', 'superviseurs'));
    }

    public function store(PermissionFormRequest $request)
    {
        try {
            // Valider les données du formulaire
            $permissionData = $request->validated();

            // Ajouter les timestamps 'created_at' et 'updated_at'
            $permissionData['created_at'] = now();
            $permissionData['updated_at'] = now();

            // Insérer les données dans la table 'permissions'
            DB::table('permissions')->insert($permissionData);

            // Rediriger vers la liste des permissions
            return to_route('admin.permissions.index');

        } catch (\Throwable $th) {
            // Gérer les exceptions
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue.']);
        }
    }

    // public function show(string $id)
    // {
    //     $events = Calendrier::all();

    //     // Récupère la permission avec les informations de l'employé
    //     $permission = DB::table('permissions')
    //         ->join('employes as emp', 'permissions.numEmp', '=', 'emp.numEmp')
    //         ->join('employes as sup', 'permissions.numSup', '=', 'sup.numEmp')
    //         ->select('permissions.*', 
    //                 'emp.Nom as employeNom', 'emp.Prenom as employePrenom', 'emp.Quartier as employeQuartier',
    //                 'emp.Lot as employeLot', 'emp.Commune as employeCommune', 'emp.Email as employeEmail',
    //                 'emp.Telephone as employeTelephone', 
    //                 'sup.Nom as superviseurNom', 'sup.Prenom as superviseurPrenom', 'sup.Grade as superviseurGrade', 'sup.Raison as superviseurRaison',)
    //         ->where('permissions.id', $id)
    //         ->first();

    //     $detalles = Permission::with('employes')
    //         ->where('id', $id)
    //         ->firstOrFail();

    //     $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
    //     $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

    //     return view('admin.permission.text', [
    //         'events' => $events,
    //         'employe' => $permission,
    //         'detalles' => $detalles,
    //         'countInfo1' => $countInfo1,
    //         'countInfo2' => $countInfo2
    //     ]);
    // }

    public function show(string $id)
    {
        $events = Calendrier::all();

        // Récupère la permission avec les informations de l'employé
        $permission = DB::table('permissions')
            ->join('employes as emp', 'permissions.numEmp', '=', 'emp.numEmp')
            ->join('employes as sup', 'permissions.numSup', '=', 'sup.numEmp')
            ->select('permissions.*', 
                    'emp.Nom as employeNom', 
                    'emp.Prenom as employePrenom', 
                    'emp.Quartier as employeQuartier',
                    'emp.Lot as employeLot', 
                    'emp.Commune as employeCommune', 
                    'emp.Email as employeEmail',
                    'emp.Telephone as employeTelephone', 
                    'sup.Nom as superviseurNom', 
                    'sup.Prenom as superviseurPrenom', 
                    'sup.Grade as superviseurGrade') // Supprimez 'sup.Raison'
            ->where('permissions.id', $id)
            ->first();

        $detalles = Permission::with('employes')
            ->where('id', $id)
            ->firstOrFail();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.permission.text', [
            'events' => $events,
            'employe' => $permission,
            'detalles' => $detalles,
            'countInfo1' => $countInfo1,
            'countInfo2' => $countInfo2
        ]);
    }

    public function editValidation(Permission $permission)
    {
        $permissions = Employe::all();
        $events = Calendrier::all();

        // Récupérer l'image la plus récente pour chaque employé
        $latestImages = DB::table('image_profil_users as ipu')
            ->join(DB::raw('(SELECT numEmp, MAX(id) as latest_id FROM image_profil_users GROUP BY numEmp) as latest'), function($join) {
                $join->on('ipu.id', '=', 'latest.latest_id');
            })
            ->get();

        // Récupérer les employés avec leurs permissions en attente
        $employe = Employe::where('numEmp', $permission->numEmp)->first();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.validationP.form', compact('permission', 'permissions', 'events', 'latestImages', 'employe', 'countInfo1', 'countInfo2'));
    }

    public function editPermission(Permission $permission)
    {
        $permissions = Employe::all();
        $events = Calendrier::all();

        $superviseurs = DB::table('employes')
            ->select('numEmp', 'Nom', 'Prenom')
            ->where('Personnel', 'Superviseur')
            ->get();

        $countInfo1 = DB::table('permissions')->where('Validation', 'En attente...')->count();
        $countInfo2 = DB::table('conges')->where('Validation', 'En attente...')->count();

        return view('admin.permission.form', compact('permission', 'permissions', 'events', 'countInfo1', 'countInfo2', 'superviseurs'));
    }

    public function updatePermission(PermissionFormRequest $request, string $id)
    {
        DB::table('permissions')
            ->where('id', $id)
            ->update($request->validated());

        return to_route('admin.permissions.index');
    }    

    public function updateValidation(PermissionFormRequest $request, string $id)
    {
        DB::table('permissions')
            ->where('id', $id)
            ->update($request->validated());

        return to_route('admin.permissions.index');
    }    


    public function destroy(string $id)
    {
        $deleted = DB::table('permissions')
                ->where('id', $id)
                ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Employé supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé.');
        }
    }
}
