<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filiere = Filiere::all();
        return view("Parametre/Filiere/all")->with('filieres',$filiere);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Parametre/Filiere/add');
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
        Filiere::create([
            "nom_filiere" => $request->nom
        ]);
        return redirect()->route('filiere.index')
                        ->with('success','Filière ajoutée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function show($idFiliere)
    {
        $filiere = Filiere::where('id', $idFiliere)->get();
        return view('Parametre/Filiere/edit')->with('filiere', $filiere);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function edit(Filiere $filiere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required'
        ]);
        $idFiliere = $request->id;
        $demande = Filiere::where('id', $idFiliere);
        $demande->update([
            "nom_filiere" => $request->nom
        ]);
        return redirect()->route('filiere.index')
                        ->with('success','Filière mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $demande = Filiere::where('id', $id);
        $demande->delete();

        return redirect()->route('filiere.index')
                        ->with('success','Filière supprimée.');
    }

    public function suppressionView($idFiliere)
    {
        $filiere = Filiere::where('id', $idFiliere)->get();
        return view('Parametre/Filiere/delete')->with('filiere', $filiere);

    }
}
