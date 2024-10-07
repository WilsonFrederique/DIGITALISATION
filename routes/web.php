<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\GenererQrController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ExempleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\UsersController;

Route::get('/', [AccueilController::class, 'index'])->name('app_accueil');

// Route::get('/', [UsersController::class, 'index'])->name('app_public');

// Route::prefix('users')->name('users.')->group(function() {
//     Route::resource('public', UsersController::class);
// });

Route::prefix('auth')->name('auth.')->group(function() {

    Route::get('login.admin', [LoginController::class, 'loginAdmin'])->name('page_admin');
    Route::get('login.users', [LoginController::class, 'loginPublic'])->name('page_users');
    Route::get('formulaire.register', [LoginController::class, 'formUser'])->name('page_formUser');

});

Route::post('/admin/calendrier/store', [CalendrierController::class, 'store'])->name('calendrier.store');
Route::get('/admin/events', [CalendrierController::class, 'index'])->name('calendrier.index');
Route::delete('/admin/calendrier/destroy/{id}', [CalendrierController::class, 'destroy'])->name('admin.calendrier.destroy');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('employes', EmployeController::class);
    Route::resource('genereqrs', GenererQrController::class);
    Route::resource('parametres', EntrepriseController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('calendrier', CalendrierController::class);
    Route::resource('pointages', PointageController::class);



    Route::put('/parametres/{CodeEntreprise}', [EntrepriseController::class, 'update'])->name('admin.parametres.update');

    // Ajout de la route pour la méthode listeProfils
    Route::get('listes.profils', [EmployeController::class, 'indexProfil'])->name('listes_profils');

    // Ajout de la route pour la méthode indexCalendrier
    // Route::get('listes.Calendrier', [EmployeController::class, 'indexCalendrier'])->name('listes_calendrier');

    // Ajout de la route pour la méthode listeEmployeNonCodeQR
    Route::get('listes.mployeNonCodeQR', [EmployeController::class, 'listeEmployeNonCodeQR'])->name('listes_mployeNonCodeQR');

});