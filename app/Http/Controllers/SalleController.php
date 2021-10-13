<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salles = Salle::all();
        return view('Parametre.Salle.all',['salles'=>$salles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Parametre.Salle.add');
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
            'nom' => ['required','unique:salles'],
            'place' => ['required','numeric'],
        ]);

        Salle::create([
            'nom' => $request->nom,
            'place' => $request->place,
            'caracteristique' => $request->caracteristique,
        ]);
        return redirect()->route('salle.index')->with('success', 'Nouvelle salle enregistrée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function show(Salle $salle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function edit(Salle $salle)
    {
        return view('Parametre.Salle.edit',compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salle $salle)
    {
        $request->validate([
            'nom' => ['required', 'unique:salles,nom,'.$salle->id],
            'place' => ['required', 'numeric'],
        ]);

        $salle->update([
            'nom' => $request->nom,
            'place' => $request->place,
            'caracteristique' => $request->caracteristique,
        ]);
        return redirect()->route('salle.index')->with('success','Modification de la salle réussie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->route('salle.index')->with('success', 'Suppression réussie.');
    }
}
