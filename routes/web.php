<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\UserController;
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

    Route::get('/', function () {
        return view('index');
    })->name('index');

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
    Route::fallback(function () {
        return view('errors.404');
    });
});


Route::resource('user', UserController::class)->middleware(['auth','admin']);


require __DIR__.'/auth.php';
