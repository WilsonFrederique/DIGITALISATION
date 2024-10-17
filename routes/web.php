<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\GenererQrController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ExempleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PersonnelUserController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\UserPersonnelController;
use App\Http\Controllers\UsersController;
use App\Models\Employe;

// Route::get('/', [AccueilController::class, 'index'])->name('app_accueil');

Route::get('/', [UsersController::class, 'index'])->name('app_public');

Route::get('/home', [AuthentificationController::class, 'login'])->name('login');

Route::get('/notifications/permissions', [PermissionController::class, 'getNewPermissionsCount']);
Route::get('/permissions', [PermissionController::class, 'showPermissions'])->name('permissions');

Route::prefix('users')->name('users.')->middleware('auth')->group(function() {
    Route::resource('public', UsersController::class);
    Route::resource('personnel', UserPersonnelController::class);
    Route::resource('parametres', UserPersonnelController::class);

    // -------- Publication ---------
    Route::get('publication', [UserPersonnelController::class, 'indexPublication'])->name('indexPub');
    // -------- Publication ---------
    Route::post('ajout_publication', [UserPersonnelController::class, 'storePublicationUseer'])->name('ajoutPublication');
    // -------- Les employes --------
    Route::get('employes', [UserPersonnelController::class, 'indexLesEmployes'])->name('indexLesEmployes');
    // -------- Les Permission ------
    Route::get('permissions', [UserPersonnelController::class, 'indexPermissions'])->name('indexPermissions');
    // --------- Paramètres ---------
    Route::get('parametres', [UserPersonnelController::class, 'indexParametres'])->name('indexParm');
    // --------- Paramètres ---------
    Route::post('profilUser', [UserPersonnelController::class, 'storeImgProfils'])->name('users.storeAjoutProfil');

});

Route::prefix('auth')->name('auth.')->group(function() {
    Route::get('login', [AuthentificationController::class, 'login'])
        ->middleware('guest')
        ->name('login');

    Route::delete('logout', [AuthentificationController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    Route::post('login', [AuthentificationController::class, 'verification'])->name('verification');

    Route::resource('nouveau', AuthentificationController::class);
});







Route::post('/admin/calendrier/store', [CalendrierController::class, 'store'])->name('calendrier.store');
Route::get('/admin/events', [CalendrierController::class, 'index'])->name('calendrier.index');
Route::delete('/admin/calendrier/destroy/{id}', [CalendrierController::class, 'destroy'])->name('admin.calendrier.destroy');

Route::get('admin/scanner', [GenererQrController::class, 'scanner'])->name('admin.scanner');

// ========== DEF Chaque employe ==========
Route::get('employe/{id}/pdf', [EmployeController::class, 'telechargerPDF'])->name('page_pdf');

// =========== Badje pour ==============
Route::get('badge/{id}/pdf', [GenererQrController::class, 'telechargerBadge'])->name('badge_pdf');

// ====== Ajout Automatique Pointage =====
Route::post('store-pointage', [PointageController::class, 'store'])->name('store_pointage');

Route::post('/check-numEmp', [PointageController::class, 'checkNumEmp'])->name('check_numEmp');







Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('employes', EmployeController::class);
    Route::resource('genereqrs', GenererQrController::class);
    Route::resource('parametres', EntrepriseController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('calendrier', CalendrierController::class);
    Route::resource('pointages', PointageController::class);

    Route::get('scanner.code.QR', [GenererQrController::class, 'pageScannerQR'])->name('page_scanner_QR');
    Route::get('scanner.generer', [GenererQrController::class, 'indexScan'])->name('admin.indexScan');


    Route::get('tout.employe.pdf', [EmployeController::class, 'genereteAllPdf'])->name('tout_pdf_employe');


    Route::put('/parametres/{CodeEntreprise}', [EntrepriseController::class, 'update'])->name('admin.parametres.update');

    // Ajout de la route pour la méthode listeProfils
    Route::get('listes.profils', [EmployeController::class, 'indexProfil'])->name('listes_profils');
    
    // Ajout de la route pour la méthode listeEmployeNonCodeQR
    Route::get('listes.mployeNonCodeQR', [EmployeController::class, 'listeEmployeNonCodeQR'])->name('listes_mployeNonCodeQR');

});