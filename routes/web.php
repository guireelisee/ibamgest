<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DevoirController;
use App\Http\Controllers\FiliereController;

use App\Http\Controllers\FicheController;
use App\Http\Controllers\QrcodeController;

use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SurveillantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AffectationCoursController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/generate-barcode', [QrcodeController::class, 'index'])->name('qrcode.index');

    Route::post('/track-barcode', [QrcodeController::class, 'tracking'])->name('qrcode.tracking');

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('demande', [DemandeController::class, 'index'])->name('demande.index');

    Route::get('mes-demande', [DemandeController::class, 'auth_index'])->name('demande.auth.index');

    Route::post('mes-demande', [DemandeController::class, 'auth_store'])->name('demande.auth.store');

    Route::get('demande-auth-create', [DemandeController::class, 'auth_create'])->name('demande.auth.create');

    Route::get('demande-create', [DemandeController::class, 'create'])->name('demande.create');

    Route::get('demande-show/{id}', [DemandeController::class, 'show'])->name('demande.show');

    Route::post('demande-save', [DemandeController::class, 'store'])->name('demande.store');

    Route::post('demande-update', [DemandeController::class, 'update'])->name('demande.update');

    Route::get('demande-valider-view/{id}', [DemandeController::class, 'validateView'])->name('demande.validate.view');

    Route::get('demande-rejetter-view/{id}', [DemandeController::class, 'rejetterView'])->name('demande.rejetter.view');

    Route::get('demande-suppression-view/{id}', [DemandeController::class, 'suppressionView'])->name('demande.suppression.view');

    Route::post('demande-valider', [DemandeController::class, 'valider'])->name('demande.validate');

    Route::post('demande-rejetter', [DemandeController::class, 'rejetter'])->name('demande.rejetter');

    Route::post('demande-suppression', [DemandeController::class, 'destroy'])->name('demande.destroy');

    Route::post('imprimer', [DemandeController::class, 'print'])->name('demande.print');

    Route::resource('fiche', FicheController::class);

    Route::get('fiche-auth-create', [FicheController::class, 'auth_create'])->name('fiche.auth.create');

    Route::post('verifier-disponibilite', [FicheController::class, 'verifier_disponibilite'])->name('fiche.verifier.disponibilite');

    Route::resource('devoir', DevoirController::class);

    Route::get('devoir/tracking/{devoir}', [DevoirController::class, 'tracking'])->name('devoir.tracking');

    Route::post('depot-sujet', [DevoirController::class, 'depot_sujet'])->name('devoir.depot-sujet');

    Route::post('prise-sujet', [DevoirController::class, 'prise_sujet'])->name('devoir.prise-sujet');

    Route::post('retour-copies', [DevoirController::class, 'retour_copies'])->name('devoir.retour-copies');

    Route::post('prise-copies-prof', [DevoirController::class, 'prise_copies_prof'])->name('devoir.prise-copies-prof');

    Route::post('retour-copie-apres-correction', [DevoirController::class, 'retour_copie_apres_correction'])->name('devoir.retour-copie-apres-correction');

    Route::post('prise-copie-etudiants', [DevoirController::class, 'prise_copie_etudiants'])->name('devoir.prise-copie-etudiants');

    Route::get('fiche/validate/{fiche}', [FicheController::class,'valider'])->name('fiche.validate');

    Route::fallback(function () {
        return view('errors.404');
    });

    Route::get('filiere', [FiliereController::class, 'index'])->name('filiere.index');

    Route::get('filiere-create', [FiliereController::class, 'create'])->name('filiere.create');

    Route::get('filiere-show/{id}', [FiliereController::class, 'show'])->name('filiere.show');

    Route::post('filiere-save', [FiliereController::class, 'store'])->name('filiere.store');

    Route::get('filiere-suppression-view/{id}', [FiliereController::class, 'suppressionView'])->name('filiere.suppression.view');

    Route::post('filiere-update', [FiliereController::class, 'update'])->name('filiere.update');

    Route::post('filiere-suppression', [FiliereController::class, 'destroy'])->name('filiere.destroy');

    Route::get('matiere', [MatiereController::class, 'index'])->name('matiere.index');

    Route::get('matiere-create', [MatiereController::class, 'create'])->name('matiere.create');

    Route::get('matiere-show/{id}', [MatiereController::class, 'show'])->name('matiere.show');

    Route::post('matiere-save', [MatiereController::class, 'store'])->name('matiere.store');

    Route::get('matiere-suppression-view/{id}', [MatiereController::class, 'suppressionView'])->name('matiere.suppression.view');

    Route::post('matiere-update', [MatiereController::class, 'update'])->name('matiere.update');

    Route::post('matiere-suppression', [MatiereController::class, 'destroy'])->name('matiere.destroy');

    Route::resource('salle', SalleController::class);

    Route::resource('professeur', ProfesseurController::class);

    Route::resource('surveillant', SurveillantController::class);

    Route::resource('affectation-cours', AffectationCoursController::class);

});

Route::get('redirect/{provider}', [SocialiteController::class, 'redirect'])->name('socialite.redirect');

Route::get('callback/{provider}', [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::resource('user', UserController::class)->middleware(['auth','admin']);

Route::get('inscription', [RegisteredUserController::class, 'inscription_demandeur_index'])->name('user.inscription.index');

Route::post('inscription', [RegisteredUserController::class, 'inscription_demandeur'])->name('user.inscription.save');

Route::get('confirm-code', [RegisteredUserController::class, 'confirm_code_view'])->name('user.inscription.confirm-code-index');

Route::post('verifier-code', [RegisteredUserController::class, 'verifier_code'])->name('user.inscription.verifier-code');

Route::post('demandeur/update', [UserController::class,'updateData'])->name('demandeur.update');

Route::get('demandeur/complete', [UserController::class,'completeData'])->name('demandeur.complete');

require __DIR__.'/auth.php';
