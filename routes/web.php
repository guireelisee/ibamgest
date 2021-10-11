<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FicheController;
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


Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('index');

Route::get('demande', [DemandeController::class, 'index'])
                    ->middleware(['auth'])->name('demande.index');

Route::get('demande-create', [DemandeController::class, 'create'])
                    ->middleware(['auth'])->name('demande.create');
                    
Route::get('demande-show/{id}', [DemandeController::class, 'show'])
                    ->middleware(['auth'])->name('demande.show');

Route::post('demande-save', [DemandeController::class, 'store'])
                    ->middleware(['auth'])->name('demande.store');
    
Route::post('demande-update', [DemandeController::class, 'update'])
                    ->middleware(['auth'])->name('demande.update');

Route::get('demande-valider-view/{id}', [DemandeController::class, 'validateView'])
                    ->middleware(['auth'])->name('demande.validate.view');

Route::get('demande-rejetter-view/{id}', [DemandeController::class, 'rejetterView'])
                    ->middleware(['auth'])->name('demande.rejetter.view');

Route::get('demande-suppression-view/{id}', [DemandeController::class, 'suppressionView'])
                    ->middleware(['auth'])->name('demande.suppression.view');

Route::post('demande-valider', [DemandeController::class, 'valider'])
                    ->middleware(['auth'])->name('demande.validate');

Route::post('demande-rejetter', [DemandeController::class, 'rejetter'])
                    ->middleware(['auth'])->name('demande.rejetter');

Route::post('demande-suppression', [DemandeController::class, 'destroy'])
                    ->middleware(['auth'])->name('demande.destroy');
                    
Route::resource('fiche', FicheController::class)->middleware(['auth']);


Route::fallback(function () {
    return view('errors.404');
})->middleware(['auth']);

require __DIR__.'/auth.php';
