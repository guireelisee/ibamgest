<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matiere = Matiere::all();
        return view("Parametre/Matiere/all")->with('matieres',$matiere);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Parametre/Matiere/add');
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
            'nom' => 'required'
        ]);
        Matiere::create([
            "nom_matiere" => $request->nom
        ]);
        return redirect()->route('matiere.index')
                        ->with('success','Matière ajoutée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function show($idMatiere)
    {
        $matiere = Matiere::where('id', $idMatiere)->get();
        return view('Parametre/Matiere/edit')->with('matiere', $matiere);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function edit(Matiere $matiere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required'
        ]);
        $idMatiere = $request->id;
        $demande = Matiere::where('id', $idMatiere);
        $demande->update([
            "nom_matiere" => $request->nom
        ]);
        return redirect()->route('matiere.index')
                        ->with('success','Matière mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $demande = Matiere::where('id', $id);
        $demande->delete();

        return redirect()->route('matiere.index')
                        ->with('success','Matière supprimée.');
    }

    public function suppressionView($idMatiere)
    {
        $matiere = Matiere::where('id', $idMatiere)->get();
        return view('Parametre/Matiere/delete')->with('matiere', $matiere);

    }
}
