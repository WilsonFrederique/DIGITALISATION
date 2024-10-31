<?php

namespace App\Http\Controllers;

use App\Http\Requests\CongeFormRequest;
use App\Models\Employe;
use App\Models\Calendrier;
use Illuminate\Http\Request;
use App\Models\ImageProfilUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeFormRequest;
use App\Http\Requests\UserPersonnelFormRequest;
use App\Http\Requests\ImageProfilUserFormRequest;
use App\Http\Requests\PermissionFormRequest;
use App\Http\Requests\PublicationUserFormRequest;
use App\Models\Conge;
use App\Models\Permission;

class UserPersonnelController extends Controller
{

    // -------------- Index Personnel ---------------
    public function index() {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        $events = Calendrier::all();

        $postEmployes = Employe::all();
        
        // Charger les informations de l'employé associées
        if($user && $user->employe) {
            $employe = $user->employe;

        // Récupérer le dernier profil d'image pour cet employé (par numEmp)
        $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
            ->orderBy('id', 'desc')
            ->first();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();

        $numEmp = auth()->user()->numEmp;
        // Exécuter la requête pour récupérer l'email de cet utilisateur
        $email = DB::table('users')
                    ->where('numEmp', $numEmp)
                    ->value('email');

        // Récupérer toutes les publications avec les informations de l'employé associé
        $publications = DB::table('publicatins as p')
            ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
            ->select('p.numEmp', 'e.Nom', 'e.Prenom', 'p.txtPartage', 'p.imgPartage', 'p.created_at')
            ->orderBy('p.id', 'desc')
            ->get();

        $pubRacours = DB::table('publicatins as p')
            ->select(
                'p.numEmp',
                'p.imgPartage',
                'p.txtPartage',
                'e.Nom',
                'e.Prenom',
                DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                'p.created_at'
            )
            ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
            ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
            ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
            ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
            ->orderBy('p.created_at', 'desc')
            ->get();

            
            // Retourner la vue avec les données de l'employé
            return view('users.personnel.index', compact('employe', 'events', 'imgProfil', 'ToutEmployes', 'postEmployes', 'email', 'publications', 'pubRacours'));
        }
        
        return redirect()->route('auth.login')->withErrors('Aucun employé trouvé pour cet utilisateur.');
    }

    // ------------- Index Publication --------------
    public function indexPublication(){
        $user = Auth::user();
        $events = Calendrier::all();

        // Récupérer tous les employés avec leurs images de profil
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();

        if ($user && $user->employe) {
            $employe = $user->employe;

            // Récupérer la dernière image de profil pour l'employé connecté
            $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->first();

            // Récupérer l'email de l'utilisateur connecté
            $email = DB::table('users')
                ->where('numEmp', $employe->numEmp)
                ->value('email');

            // Récupérer toutes les publications avec les informations des employés associés
            $publications = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            // Optimisation de la requête pour récupérer les publications avec les informations des employés
            $resultats = DB::table('publicatins as p')
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'p.numEmp', '=', 'ipu.numEmp')
                ->select('p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom')
                ->whereNotNull('ipu.numEmp') // S'assurer que l'employé a une image de profil
                ->get();

            // Retourner la vue avec les données
            return view('users.publication.index', compact('employe', 'events', 'imgProfil', 'ToutEmployes', 'email', 'publications', 'resultats', 'pubRacours'));
        }

        return redirect()->route('auth.login')->withErrors('Aucun employé trouvé pour cet utilisateur.');
    } 

    // ------------ Index Les employes --------------
    public function indexLesEmployes(){
        $user = Auth::user();

        $events = Calendrier::all();

        $postEmployes = Employe::all();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();
        
        // Charger les informations de l'employé associées
        if($user && $user->employe) {
            $employe = $user->employe;

            // Récupérer le dernier profil d'image pour cet employé (par numEmp)
            $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->first();

            $numEmp = auth()->user()->numEmp;

            // Exécuter la requête pour récupérer l'email de cet utilisateur
            $email = DB::table('users')
                ->where('numEmp', $numEmp)
                ->value('email');

            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            // Retourner la vue avec les données de l'employé
            return view('users.lesEmployes.index', compact('employe', 'events', 'imgProfil', 'ToutEmployes', 'postEmployes', 'email', 'pubRacours'));
        }
    }

    // ------------ Index Les Permissions -----------
    public function indexPermissions(){
        $user = Auth::user();

        $events = Calendrier::all();

        $postEmployes = Employe::all();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();
        
        // Charger les informations de l'employé associées
        if($user && $user->employe) {
            $employe = $user->employe;

            // Récupérer le dernier profil d'image pour cet employé (par numEmp)
            $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->first();

            $numEmp = auth()->user()->numEmp;
            // Exécuter la requête pour récupérer l'email de cet utilisateur
            $email = DB::table('users')
                ->where('numEmp', $numEmp)
                ->value('email');

            // Récupérer les permissions pour cet employé
            $permissions = DB::table('permissions')
                ->where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->get();

            // Récupérer les permissions des superviseurs
            $permissionsPourSuperviseurs = DB::table('permissions')
                ->where('numSup', $numEmp)
                ->where('Validation', 'En attente...')
                ->orderBy('id', 'desc')
                ->get();

            // Cont Message Permission
            $countPermission = DB::table('permissions')
                ->where('numSup', $numEmp)
                ->where('Validation', 'En attente...')
                ->count();

            $superviseurs = DB::table('employes')
                ->select('numEmp', 'Nom', 'Prenom')
                ->where('Personnel', 'Superviseur')
                ->get();

            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            // Retourner la vue avec les données de l'employé
            return view('users.permission.index', compact('employe', 'events', 'imgProfil', 'ToutEmployes', 'postEmployes', 'email', 'permissions', 'permissionsPourSuperviseurs', 'countPermission', 'superviseurs', 'pubRacours'));
        }
    }

    // ------------ Frm Les Reponses Permissions -----------
    public function indexReponsePermissions(Permission $permission){
        $permissions = Employe::all();
        $events = Calendrier::all();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();


        $user = Auth::user();

        if($user && $user->employe) {
            $employe = $user->employe;
            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            return view('users.permission.form', compact('permission', 'permissions', 'events', 'ToutEmployes', 'pubRacours'));
        }
        
    }

    // ------------ Les Reponses Permissions -----------
    public function updateReponsePermission(PermissionFormRequest $request, string $id)
    {
        DB::table('permissions')
            ->where('id', $id)
            ->update($request->validated());

        return to_route('users.indexPermissions');
    } 

    // ---------------- Index Conges ----------------
    public function indexConges(){
        $user = Auth::user();

        $events = Calendrier::all();

        $postEmployes = Employe::all();

        $conge = new Conge();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();
        
        // Charger les informations de l'employé associées
        if($user && $user->employe) {
            $employe = $user->employe;

            // Récupérer le dernier profil d'image pour cet employé (par numEmp)
            $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->first();

            $numEmp = auth()->user()->numEmp;
            // Exécuter la requête pour récupérer l'email de cet utilisateur
            $email = DB::table('users')
                ->where('numEmp', $numEmp)
                ->value('email');

            // conge les permissions pour cet employé
            $conges = DB::table('conges')
                ->where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->get();

            // Récupérer les permissions des superviseurs
            $congesPourSuperviseurs = DB::table('conges')
                ->where('numSup', $numEmp)
                ->where('Validation', 'En attente...')
                ->orderBy('id', 'desc')
                ->get();

            // Cont Message Conge
            $countConge = DB::table('conges')
                ->where('numSup', $numEmp)
                ->where('Validation', 'En attente...')
                ->count();

            $superviseurs = DB::table('employes')
                ->select('numEmp', 'Nom', 'Prenom')
                ->where('Personnel', 'Superviseur')
                ->get();

            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            // Retourner la vue avec les données de l'employé
            return view('users.conges.index', compact('employe', 'events', 'imgProfil', 'ToutEmployes', 'postEmployes', 'email', 'congesPourSuperviseurs', 'conges', 'conge', 'countConge', 'superviseurs', 'pubRacours'));
        }
    }

    
    // ------------ Frm Les Reponses Permissions -----------
    public function indexReponseConges($id){
        $conge = Conge::findOrFail($id);
        $permissions = Employe::all();
        $events = Calendrier::all();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();

        $user = Auth::user();

        if($user && $user->employe) {
            $employe = $user->employe;
            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            return view('users.conges.form', compact('conge', 'permissions', 'events', 'ToutEmployes', 'pubRacours'));
        }
    }

    // ------------ Les Reponses Permissions -----------
    public function updateReponseConges(CongeFormRequest $request, string $id)
    {
        DB::table('conges')
        ->where('id', $id)
        ->update($request->validated());

        return to_route('users.indexConges')->with('success', 'Congé mis à jour avec succès.');
    }

    // ---------------- Index Missions ----------------
    public function indexMissions(){
        $user = Auth::user();

        $events = Calendrier::all();

        $postEmployes = Employe::all();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();
        
        // Charger les informations de l'employé associées
        if($user && $user->employe) {
            $employe = $user->employe;

        // Récupérer le dernier profil d'image pour cet employé (par numEmp)
        $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
                ->orderBy('id', 'desc')
                ->first();

        $numEmp = auth()->user()->numEmp;
        // Exécuter la requête pour récupérer l'email de cet utilisateur
        $email = DB::table('users')
                    ->where('numEmp', $numEmp)
                    ->value('email');

            // Retourner la vue avec les données de l'employé
            return view('users.missions.index', compact('employe', 'events', 'imgProfil', 'ToutEmployes', 'postEmployes', 'email'));
        }
    }

    // ------------- Index Paramètres ---------------
    public function indexParametres(){
        $user = Auth::user();

        $events = Calendrier::all();

        // Récupérer tous les employés
        $ToutEmployes = DB::table('employes as e')
            ->leftJoin(DB::raw('(SELECT numEmp, MAX(id) AS latest_id FROM image_profil_users GROUP BY numEmp) as latest'), 'e.numEmp', '=', 'latest.numEmp')
            ->leftJoin('image_profil_users as ipu', 'ipu.id', '=', 'latest.latest_id')
            ->select('e.numEmp', 'e.Nom', 'e.Prenom', 'ipu.imgProfil', 'e.Grade')
            ->orderBy('e.numEmp')
            ->get();

        // Récupérer le dernier profil d'image
        $imgProfil = ImageProfilUser::orderBy('id', 'desc')->first();
        
        // Charger les informations de l'employé associées
        if($user && $user->employe) {
            $employe = $user->employe;

            // Récupérer le dernier profil d'image pour cet employé (par numEmp)
            $imgProfil = ImageProfilUser::where('numEmp', $employe->numEmp)
                    ->orderBy('id', 'desc')
                    ->first();

            $numEmp = auth()->user()->numEmp;
            // Exécuter la requête pour récupérer l'email de cet utilisateur
            $email = DB::table('users')
                        ->where('numEmp', $numEmp)
                        ->value('email');

            // Récupérer l'email et le mot de passe crypté de l'utilisateur connecté
            $userData = DB::table('users')
                ->where('numEmp', $numEmp)
                ->select('email', 'password')
                ->first();

            $pubRacours = DB::table('publicatins as p')
                ->select(
                    'p.numEmp',
                    'p.imgPartage',
                    'p.txtPartage',
                    'e.Nom',
                    'e.Prenom',
                    DB::raw('MAX(ipu.imgProfil) AS imgProfil'),
                    'p.created_at'
                )
                ->join('employes as e', 'p.numEmp', '=', 'e.numEmp')
                ->leftJoin('image_profil_users as ipu', 'e.numEmp', '=', 'ipu.numEmp')
                ->where('p.numEmp', '=', $employe->numEmp) // Filtrer par employé connecté
                ->groupBy('p.numEmp', 'p.imgPartage', 'p.txtPartage', 'e.Nom', 'e.Prenom', 'p.created_at')
                ->orderBy('p.created_at', 'desc')
                ->get();

            // Retourner la vue avec les données de l'employé
            return view('users.parametre.index', [
                'employe' => $employe,
                'events' => $events,
                'imgProfil' => $imgProfil,
                'ToutEmployes' => $ToutEmployes,
                'passwordCrypted' => $userData->password,
                'email' => $email,
                'pubRacours' => $pubRacours
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    // ------------ Store Image Profil ---------------
    public function storeImgProfils(ImageProfilUserFormRequest $request){
        try {
            // Validation des données
            $imgProflData = $request->validated();

            // Gestion du fichier image
            if ($request->hasFile('imgProfil')) {
                $file = $request->file('imgProfil'); // Assurez-vous que le nom de champ est correct
                $filename = time() . '_' . $file->getClientOriginalName(); // Crée un nom unique pour le fichier
                $file->move(public_path('images'), $filename); // Déplace le fichier dans le dossier public/images
                $imgProflData['imgProfil'] = 'images/' . $filename; // Enregistre le chemin de l'image dans la base de données
            }

            // Insertion des données dans la table image_profil_users
            DB::table('image_profil_users')->insert([
                'numEmp' => $imgProflData['numEmp'], // Assurez-vous que numEmp est présent dans les données validées
                'imgProfil' => $imgProflData['imgProfil'],
                'created_at' => now(), // Optionnel : ajoutez le timestamp
                'updated_at' => now()  // Optionnel : ajoutez le timestamp
            ]);

            return to_route('users.indexParm')->with('success', 'Image de profil ajoutée avec succès!');

        } catch (\Throwable $th) {
            Log::error('Erreur lors de l\'ajout de l\'image de profil: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    // ------------ Store Image Profil ---------------
    public function storePublicationUseer(PublicationUserFormRequest $request){
        try {
            // Validation des données
            $publicationUserData = $request->validated();

            // Gestion du fichier image
            if ($request->hasFile('imgPartage')) {
                $file = $request->file('imgPartage'); // Assurez-vous que le nom de champ est correct
                $filename = time() . '_' . $file->getClientOriginalName(); // Crée un nom unique pour le fichier
                $file->move(public_path('images'), $filename); // Déplace le fichier dans le dossier public/images
                $publicationUserData['imgPartage'] = 'images/' . $filename; // Enregistre le chemin de l'image dans la base de données
            }

            // Insertion des données dans la table image_profil_users
            DB::table('publicatins')->insert([
                'numEmp' => $publicationUserData['numEmp'],
                'txtPartage' => $publicationUserData['txtPartage'],
                'imgPartage' => $publicationUserData['imgPartage'],
                'created_at' => now(),
                'updated_at' => now() 
            ]);

            return to_route('users.indexPub')->with('success', 'Publication ajoutée avec succès!');

        } catch (\Throwable $th) {
            Log::error('Erreur lors de l\'ajout de l\'image de profil: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    // ------------ Store Permissions ---------------
    public function storePermission(PermissionFormRequest $request)
    {
        try {
            $permissionData = $request->validated();

            // Ajouter created_at et updated_at
            $permissionData['created_at'] = now();
            $permissionData['updated_at'] = now();

            DB::table('permissions')->insert($permissionData);

            return to_route('users.indexPermissions');

        } catch(\Throwable $th) {
            return redirect()->back();
        }
    }

    // ------------ Store Permissions ---------------
    public function storeConge($conge = null)
    {
        // try {
        //     $congesDate = $request->validated();

        //     // Ajouter created_at et updated_at
        //     $congesDate['created_at'] = now();
        //     $congesDate['updated_at'] = now();

        //     DB::table('conges')->insert($congesDate);

        //     return to_route('users.indexConges');

        // } catch(\Throwable $th) {
        //     return redirect()->back();
        // }


        // Si $conge n'est pas fourni, on est en train de créer un nouveau congé
        if (!$conge) {
            // Récupération des informations de la requête
            $numEmp = request()->input('numEmp');
            $joursDemandes = request()->input('NbrJours');
            $dateActuelle = now();
            
            // Logique pour calculer solde, historique, etc.
            $historiqueConge = Conge::where('numEmp', $numEmp)->orderBy('created_at', 'desc')->first();
            $currentYear = $dateActuelle->year;
          
            if (!$historiqueConge || $historiqueConge->Annee < $currentYear) {
                        $solde = 30; // 30 jours par défaut pour la nouvelle année
                        $joursReportes = 0; // Pas de jours reportés
                    } else {
                        // Réutiliser les valeurs du dernier congé
                        $solde = $historiqueConge->Solde ?? 30;
                        $joursReportes = $historiqueConge->CumulAnnuel ?? 0;
                    }

            //     // Vérifier si le solde est suffisant pour les jours demandés
                if ($joursDemandes > ($solde + $joursReportes)) {
                    return response()->json(['error' => 'Solde insuffisant pour ce congé.'], 400);
                }
            
                // Calculer le nouveau solde et ajuster les jours reportés
                if ($joursDemandes <= $joursReportes) {
                    $joursReportes -= $joursDemandes; // Utiliser uniquement les jours reportés
                } else {
                    $joursRestants = $joursDemandes - $joursReportes; // Jours à soustraire du solde
                    $joursReportes = 0; // Réinitialiser les jours reportés
                    $solde -= $joursRestants; // Ajuster le solde
                }
    
            // Créer un nouveau congé avec les informations et soldes calculés
            try {
                Conge::create([
                    'numEmp' => $numEmp,
                    'NbrJours' => $joursDemandes,
                    'Solde' => $solde,
                    'CumulAnnuel' => $joursReportes,
                    'numSup' => request()->input('numSup'),
                    'Annee' => $currentYear,
                    'Mois' => request()->input('Mois'),
                    'FaiLe' => request()->input('FaiLe'),
                    'DateDebut' => request()->input('DateDebut'),
                    'DateFin' => request()->input('DateFin'),
                    'Motif' => request()->input('Motif'),
                    'NomOrganisation' => request()->input('NomOrganisation'),
                    'Validation' => request()->input('Validation'),
                    'Description' => request()->input('Description'),
                    'created_at' => $dateActuelle,
                    'updated_at' => $dateActuelle
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Une erreur s\'est produite lors de l\'ajout du congé.'], 500);
            }
    
        } else {
            // Si $conge est fourni, c'est une mise à jour, donc ajuster les soldes
            $numEmp = $conge->numEmp;
            $joursDemandes = $conge->NbrJours;
            $dateActuelle = now();
    
            // Logique pour recalculer solde et jours reportés
            $historiqueConge = Conge::where('numEmp', $numEmp)->orderBy('created_at', 'desc')->first();
            $solde = 30;
            $joursReportes = 0;
            $joursRestants = $joursDemandes - $joursReportes; // Jours à soustraire du solde
            $joursReportes = 0; // Réinitialiser les jours reportés
            $solde -= $joursRestants; // Ajuster le solde
            $joursReportes = $historiqueConge ? $historiqueConge->CumulAnnuel : 0;
    
            // Mettre à jour les informations du congé existant
            try {
                $conge->update([
                    'Solde' => $solde,
                    'CumulAnnuel' => $joursReportes,
                    'updated_at' => $dateActuelle
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du solde de congé.'], 500);
            }
        }
    
        // Rediriger vers la liste des congés
        return to_route('users.indexConges');

    }

    // ------------ Edit Conge ---------------
    public function editCongeMessage(Conge $conge)
    {
        $permissions = Employe::all();
        $events = Calendrier::all();
        return view('users.conges.form', compact('conge', 'permissions', 'events'));
    }

    public function updateCongeMessage(CongeFormRequest $request, string $id)
    {
        DB::table('conges')
            ->where('id', $id)
            ->update($request->validated());

        return to_route('users.indexConges');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(UserPersonnelFormRequest $request, string $id)
    {
        try {
            // Récupère les données validées
            $validated = $request->validated();

            // Récupère l'utilisateur connecté
            $user = Auth::user();

            // Vérifie que le nouveau mot de passe et sa confirmation correspondent
            if ($validated['new_password'] !== $validated['new_password_confirmation']) {
                return redirect()->back()->with('error', 'Le nouveau mot de passe et sa confirmation ne correspondent pas.');
            }

            // Met à jour le mot de passe de l'utilisateur dans la base de données
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($validated['new_password'])]);

            return redirect()->route('users.parametres.index')->with('success', 'Mot de passe modifié avec succès!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
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

    public function destroyConge(string $id)
    {
        $deleted = DB::table('conges')
                ->where('id', $id)
                ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Employé supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé.');
        }
    }

    public function destroyCongeMessage(string $id)
    {
        $deleted = DB::table('conges')
                ->where('id', $id)
                ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Employé supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé.');
        }
    }
}
