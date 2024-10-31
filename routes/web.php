<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\CongeController;
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
use App\Http\Controllers\ValidationPermissionController;
use App\Models\Employe;

// Route::get('/', [AccueilController::class, 'index'])->name('app_accueil');

Route::get('/', [UsersController::class, 'index'])->name('app_public');

Route::get('/home', [AuthentificationController::class, 'login'])->name('login');

// Route::get('/notifications/permissions', [PermissionController::class, 'getNewPermissionsCount']);
// Route::get('/permissions', [PermissionController::class, 'showPermissions'])->name('permissions');

Route::get('/notifications/congeCount', [CongeController::class, 'getCongeCount']);
Route::post('/notifications/congeReset', [CongeController::class, 'resetCongeCount']);
Route::get('/notifications/count', [PermissionController::class, 'getPermissionCount']);
Route::post('/notifications/reset', [PermissionController::class, 'resetPermissionCount']);


Route::prefix('users')->name('users.')->middleware('auth')->group(function() {
    Route::resource('public', UsersController::class);
    Route::resource('personnel', UserPersonnelController::class);
    Route::resource('parametres', UserPersonnelController::class);
    Route::resource('permissions', UserPersonnelController::class);

    // ============================== User Affichage =================================
    // -------- Publication ---------
    Route::get('publication', [UserPersonnelController::class, 'indexPublication'])->name('indexPub');
    // -------- Les employes --------
    Route::get('employes', [UserPersonnelController::class, 'indexLesEmployes'])->name('indexLesEmployes');
    // -------- Les Permission ------
    Route::get('permissions', [UserPersonnelController::class, 'indexPermissions'])->name('indexPermissions');
    // -------- Les Conges ------
    Route::get('conges', [UserPersonnelController::class, 'indexConges'])->name('indexConges');
    // -------- Les Missions ------
    Route::get('missions', [UserPersonnelController::class, 'indexMissions'])->name('indexMissions');
    // --------- Paramètres ---------
    Route::get('parametres', [UserPersonnelController::class, 'indexParametres'])->name('indexParm');

    // --------- Affichage ReponsesPermission ---------
    Route::get('reponse_permissions{permission}', [UserPersonnelController::class, 'indexReponsePermissions'])
        ->name('indexReponsePermissions');
    // --------- ReponsesPermission ---------
    Route::put('/frm_reponse_permss/{id}', [UserPersonnelController::class, 'updateReponsePermission'])
        ->name('reponsePermission.update');

    // --------- Affichage ReponsesConges ---------
    Route::get('reponse_conges{permission}', [UserPersonnelController::class, 'indexReponseConges'])
        ->name('indexReponseConges');
    // --------- ReponsesConge ---------
    Route::put('/frm_reponse_conges/{id}', [UserPersonnelController::class, 'updateReponseConges'])
        ->name('reponseConges.update');

    // =============================== User Frm =======================================
    // -------- Publication ---------
    Route::post('ajout_publication', [UserPersonnelController::class, 'storePublicationUseer'])->name('ajoutPublication');
    // -------- Permission ---------
    Route::post('ajout_permission', [UserPersonnelController::class, 'storePermission'])->name('ajoutPermission');
    // -------- Conges ---------
    Route::post('ajout_conge', [UserPersonnelController::class, 'storeConge'])->name('ajoutConge');
    // --------- Paramètres ---------
    Route::post('profilUser', [UserPersonnelController::class, 'storeImgProfils'])->name('users.storeAjoutProfil');


    // ======================== Suppression ===========================
    Route::delete('/conge/{id}', [UserPersonnelController::class, 'destroyConge'])->name('conge.destroy');
    Route::delete('/congeMessage/{id}', [UserPersonnelController::class, 'destroyCongeMessage'])->name('congeMessage.destroy');

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

    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'editPermission'])
        ->name('perm.edit');
    Route::get('/validations/{permission}/edit', [PermissionController::class, 'editValidation'])
        ->name('validPer.edit');

    Route::get('/congesValids/{conge}/edit', [CongeController::class, 'editValidation'])
        ->name('valid.edit');


    Route::put('/conge/{id}', [PermissionController::class, 'updatePermission'])
        ->name('perm.update');

    Route::put('/vals/{id}', [PermissionController::class, 'updateValidation'])
        ->name('validPermss.update');

    Route::put('/valConges/{id}', [CongeController::class, 'updateValidation'])
        ->name('validConge.update');

    Route::resource('calendrier', CalendrierController::class);
    Route::resource('pointages', PointageController::class);
    Route::resource('conges', CongeController::class);

    Route::get('scanner.code.QR', [GenererQrController::class, 'pageScannerQR'])->name('page_scanner_QR');
    Route::get('scanner.generer', [GenererQrController::class, 'indexScan'])->name('admin.indexScan');

    // -------- Publication ---------
    Route::get('lettreDePermission', [PermissionController::class, 'indexLettrePermission'])->name('textPermission');

    Route::get('tout.employe.pdf', [EmployeController::class, 'genereteAllPdf'])->name('tout_pdf_employe');

    Route::get('validationPermission', [PermissionController::class, 'indexValidation'])->name('indexValidation');
    // Route::put('updateValidation/{id}', [PermissionController::class, 'updateValidation'])->name('updateValidation');

    Route::put('/parametres/{CodeEntreprise}', [EntrepriseController::class, 'update'])->name('admin.parametres.update');

    // Ajout de la route pour la méthode listeProfils
    Route::get('listes.profils', [EmployeController::class, 'indexProfil'])->name('listes_profils');
    
    // Ajout de la route pour la méthode listeEmployeNonCodeQR
    Route::get('listes.mployeNonCodeQR', [EmployeController::class, 'listeEmployeNonCodeQR'])->name('listes_mployeNonCodeQR');

});
