<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DevoirController;
use App\Http\Controllers\FiliereController;

use App\Http\Controllers\FicheController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SurveillantController;
use App\Http\Controllers\UserController;
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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link'); // this will do the command line job
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('demande', [DemandeController::class, 'index'])->name('demande.index');

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

    Route::resource('fiche', FicheController::class);

    Route::resource('devoir', DevoirController::class);

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

});


Route::resource('user', UserController::class)->middleware(['auth','admin']);


require __DIR__.'/auth.php';
