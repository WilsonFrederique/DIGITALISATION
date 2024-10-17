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

     // Récupérer le nombre total de permissions ajoutées depuis la dernière consultation
     public function getNewPermissionsCount(Request $request)
     {
         // Récupérer le dernier nombre de permissions vues depuis la session
         $lastCount = session('last_permissions_count', 0);
 
         // Compter le nombre total de permissions
         $totalPermissions = Permission::count();
 
         // Calculer les nouvelles permissions
         $newPermissionsCount = $totalPermissions - $lastCount;
 
         return response()->json(['count' => $newPermissionsCount]);
     }
 
     // Afficher la liste des permissions et réinitialiser le compteur
     public function showPermissions(Request $request)
     {
         // Récupérer toutes les permissions
         $permissions = Permission::orderBy('created_at', 'desc')->get();
 
         // Mettre à jour le dernier nombre de permissions dans la session
         session(['last_permissions_count' => Permission::count()]);
 
         return view('navigation.navigation', compact('permissions'));
     }

    public function index()
    {
        $entreprises = Entreprise::all();

        $employes = Employe::all();

        $events = Calendrier::all();

        // Récupérer les employés avec leurs permissions
        $employes = Employe::whereIn('numEmp', Permission::pluck('numEmp'))->with('permissions')->get();

        return view('admin.permission.index', [
            'entreprises' => $entreprises,
            'employes' => $employes,
            'events' => $events
        ]);
    }

    public function create()
    {
        //
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

    public function edit(Permission $permission)
    {
        $permissions = Employe::all();
        $events = Calendrier::all();
        return view('admin.permission.form', compact('permission', 'permissions', 'events'));
    }

    public function update(PermissionFormRequest $request, string $id)
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
