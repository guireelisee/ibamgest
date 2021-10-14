<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\Surveillant;
use Illuminate\Http\Request;

class DevoirController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $devoirs = Devoir::all();
        return view('Devoir.all', ['devoirs' => $devoirs]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $professeurs = Professeur::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();
        $filieres = Filiere::orderBy('nom_filiere')->get();
        $salles = Salle::orderBy('nom')->get();
        $surveillants = Surveillant::orderBy('nom')->get();
        return view('Devoir.add',compact('professeurs','matieres','filieres','salles', 'surveillants'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'professeur' => ['required'],
            'filiere' => ['required'],
            'niveau' => ['required'],
            'salle' => ['required'],
            'date' => ['required'],
            'duree' => ['required'],
            'surveillant' => ['required'],
            'matiere' => ['required'],
        ]);
        $devoir = Devoir::create([
            'professeur_id' => $request->professeur,
            'filiere_id' => $request->filiere,
            'matiere_id' => $request->matiere,
            'salle_id' => $request->salle,
            'niveau' => $request->niveau,
            'heure' => $request->heure,
            'duree' => $request->duree,
            'date' => $request->date,
        ]);
        $devoir->surveillants()->sync($request->input('surveillant'));
        return redirect()->route('devoir.index')->with('success', 'Nouveau devoir enregistré.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function show(Devoir $devoir)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function edit(Devoir $devoir)
    {
        $niveaux = [
            'Licence I','Master I',
            'Licence II','Master II',
            'Licence III','Master III',
        ];
        $professeurs = Professeur::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();
        $filieres = Filiere::orderBy('nom_filiere')->get();
        $salles = Salle::orderBy('nom')->get();
        $surveillants = Surveillant::orderBy('nom')->get();
        return view('Devoir.edit', compact('niveaux','devoir','professeurs', 'matieres', 'filieres', 'salles', 'surveillants'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Devoir $devoir)
    {
        $request->validate([
            'professeur' => ['required'],
            'filiere' => ['required'],
            'niveau' => ['required'],
            'salle' => ['required'],
            'date' => ['required'],
            'duree' => ['required'],
            'surveillant' => ['required'],
            'matiere' => ['required'],
        ]);
        $devoir->update([
            'professeur_id' => $request->professeur,
            'filiere_id' => $request->filiere,
            'matiere_id' => $request->matiere,
            'salle_id' => $request->salle,
            'niveau' => $request->niveau,
            'heure' => $request->heure,
            'duree' => $request->duree,
            'date' => $request->date,
        ]);
        $devoir->surveillants()->sync($request->input('surveillant'));
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function destroy(Devoir $devoir)
    {
        $devoir->delete();
        return redirect()->route('devoir.index')->with('success', 'Suppression réussie.');
    }
}
