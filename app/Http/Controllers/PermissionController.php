<?php

namespace App\Http\Controllers;

use App\Models\Employe;
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

        // Récupérer les employés avec leurs permissions
        $employes = Employe::whereIn('numEmp', Permission::pluck('numEmp'))->with('permissions')->get();

        return view('admin.permission.index', [
            'entreprises' => $entreprises,
            'employes' => $employes
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
        return view('admin.permission.form', compact('permission', 'permissions'));
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
