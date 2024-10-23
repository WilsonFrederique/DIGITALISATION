<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Calendrier;
use App\Models\Entreprise;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PermissionFormRequest;

class PermissionController extends Controller
{

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

        $permissions = Permission::all();

        return view('admin.permission.index', [
            'entreprises' => $entreprises,
            'employes' => $employes,
            'permissionAccepters' => $permissionAccepters,
            'permissionRefusee' => $permissionRefusee,
            'permissions' => $permissions,
            'latestImages' => $latestImages,
            'events' => $events
        ]);
    }

    public function create()
    {
        $employe = new Employe();
        $permission = new Permission();
        $events = Calendrier::all();
        $entreprises = Entreprise::all();

        return view('admin.permission.form', compact('employe', 'entreprises', 'events', 'permission'));
    }

    public function store(PermissionFormRequest $request)
    {
        try {
            $permisssionData = $request->validated();

            DB::table('permissions')->insert($permisssionData);

            return to_route('admin.permissions.index');

        } catch(\Throwable $th) {
            return redirect()->back();
        }
    }

    public function show(string $id)
    {
        //
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

        return view('admin.validationP.form', compact('permission', 'permissions', 'events', 'latestImages', 'employe'));
    }

    public function editPermission(Permission $permission)
    {
        $permissions = Employe::all();
        $events = Calendrier::all();
        return view('admin.permission.form', compact('permission', 'permissions', 'events'));
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
