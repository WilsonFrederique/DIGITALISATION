<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Calendrier;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function index()
    {
        $pointages = Pointage::query();
        
        $events = Calendrier::all();

        // Passer les données à la vue
        return view('admin.pointage.index', [
            'employes' => $pointages->get(),
            'events' => $events
        ]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(string $id)
    {
        //
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
        //
    }
}
