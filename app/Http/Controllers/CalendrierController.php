<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CalendrieFormRequest;

class CalendrierController extends Controller
{
    public function index(Request $request)
    {
        $calendriers = Calendrier::query();

        if ($request->has('month') && $request->has('year')) {
            $month = $request->input('month');
            $year = $request->input('year');
            
            $calendriers->whereMonth('dateDebu', $month)
                        ->whereYear('dateDebu', $year);
        }

        $calendriers = $calendriers->get();
        
        return view('admin.calendrier.pivotCal', [
            'calendriers' => $calendriers
        ]);
    }


    public function store(CalendrieFormRequest $request)
    {
        try {
            $calendries = $request->validated();

            DB::table('calendriers')->insert($calendries);

            return to_route('admin.calendrier.index')->with('success', 'Calendrie ajouté avec succès!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function destroy(string $id)
    {
        $calendrier = DB::table('calendriers')->where('id', $id)->first();

        DB::table('calendriers')
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Employé supprimé avec succès, y compris l\'image.');
    }
}
