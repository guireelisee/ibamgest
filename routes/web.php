<?php

use App\Http\Controllers\DemandeController;
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

Route::post('demande-save', [DemandeController::class, 'store'])
                    ->middleware(['auth'])->name('demande.store');


Route::fallback(function () {
    return view('errors.404');
})->middleware(['auth']);

require __DIR__.'/auth.php';
