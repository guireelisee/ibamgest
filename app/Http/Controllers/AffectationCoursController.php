<?php

namespace App\Http\Controllers;

use App\Models\AffectationCours;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Professeur;
use Illuminate\Http\Request;

class AffectationCoursController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $affectations = AffectationCours::all();
        return view("Parametre.AffectationCours.all",compact("affectations"));
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
        return view('Parametre.AffectationCours.add', compact('professeurs', 'matieres', 'filieres'));
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
            'matiere' => ['required'],
            'professeur' => ['required'],
        ]);
        AffectationCours::create([
            'filiere_id' => $request->filiere,
            'matiere_id' => $request->matiere,
            'professeur_id' => $request->matiere,
            'niveau' => $request->niveau,
        ]);

        return redirect()->route('affectation-cours.index')->with('success', 'Nouvelle affectation enregistrée.');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        return AffectationCours::where('id', $id)->first();
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $niveaux = [
            'Licence I', 'Master I',
            'Licence II', 'Master II',
            'Licence III',
        ];
        $affectation = AffectationCours::where('id', $id)->first();
        $professeurs = Professeur::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();
        $filieres = Filiere::orderBy('nom_filiere')->get();
        return view("Parametre.AffectationCours.edit", compact('affectation','professeurs', 'matieres', 'filieres','niveaux'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'professeur' => ['required'],
            'filiere' => ['required'],
            'niveau' => ['required'],
            'matiere' => ['required'],
        ]);
        $affectation = AffectationCours::where('id', $id)->first();
        $affectation->update([
            'professeur_id' => $request->professeur,
            'filiere_id' => $request->filiere,
            'matiere_id' => $request->matiere,
            'niveau' => $request->niveau,
        ]);
        return redirect()->route('affectation-cours.index')->with('success', 'Modification de l\'affectation réussie.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $affectation = AffectationCours::where('id',$id)->first();
        $affectation->delete();
        return redirect()->route('affectation-cours.index')->with('success', 'Suppression réussie.');
    }
}
