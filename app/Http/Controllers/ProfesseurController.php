<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $professeurs = Professeur::all();
        return view('Parametre.Professeur.all', ['professeurs' => $professeurs]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('Parametre.Professeur.add');
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
            'nom' => ['required'],
            'prenom' => ['required'],
            'matricule' => ['required', 'unique:professeurs'],
            'titre' => ['required'],
            'civilite' => ['required'],
            'phone' => ['required', 'unique:professeurs'],
            'email' => ['required', 'unique:professeurs', 'email'],
        ]);

        Professeur::create($request->all());
        return redirect()->route('professeur.index')->with('success', 'Nouveau professeur enregistré.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Professeur  $professeur
    * @return \Illuminate\Http\Response
    */
    public function show(Professeur $professeur)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Professeur  $professeur
    * @return \Illuminate\Http\Response
    */
    public function edit(Professeur $professeur)
    {
        return view('Parametre.Professeur.edit', compact('professeur'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Professeur  $professeur
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Professeur $professeur)
    {
        $request->validate(['nom' => ['required'],
        'prenom' => ['required'],
        'civilite' => ['required'],
        'matricule' => ['required','unique:professeurs,matricule,'. $professeur->id],
        'titre' => ['required'],
        'phone' => ['required', 'unique:professeurs,phone,'.$professeur->id],
        'email' => ['required', 'unique:professeurs,email,' . $professeur->id],
    ]);

    $professeur->update($request->all());
    return redirect()->route('professeur.index')->with('success', 'Modification du professeur réussie.');
}

/**
* Remove the specified resource from storage.
*
* @param  \App\Models\Professeur  $professeur
* @return \Illuminate\Http\Response
*/
public function destroy(Professeur $professeur)
{
    $professeur->delete();
    return redirect()->route('professeur.index')->with('success', 'Suppression réussie.');
}
}
