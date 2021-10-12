<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Salle;
use Illuminate\Http\Request;

class FicheController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $fiches = Fiche::withTrashed()->get();
        $salles = Salle::all();
        $compteurs = FicheController::compteur();
        return view('Fiche.all', compact('fiches', 'compteurs','salles'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $salles = Salle::all();
        return view('Fiche.add', compact('salles'));
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
            'nom_exp' => 'required',
            'prenom_exp' => 'required',
            'salle' => 'required',
            'motif' => 'required',
        ]);
        Fiche::create([
            'nom_exp' => $request->nom_exp,
            'prenom_exp' => $request->prenom_exp,
            'salle_id' => $request->salle,
            'motif' => $request->motif,
        ]);
        return redirect()->route('fiche.index')->with('success', 'Demande de salle enregistrée avec succès.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Fiche  $fiche
    * @return \Illuminate\Http\Response
    */
    public function show(Fiche $fiche)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Fiche  $fiche
    * @return \Illuminate\Http\Response
    */
    public function edit(Fiche $fiche)
    {
        return view('Fiche.edit', compact('fiche'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Fiche  $fiche
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Fiche $fiche)
    {

        if (!empty($request->sp)) {
            $fiche->update(['sp' => $request->sp]);
        } elseif (!empty($request->dir)) {
            $fiche->update(['dir' => $request->dir]);
        } elseif(!empty($request->scolarite)) {
            $request->validate([
                "scolarite" => "required"
            ]);
            $fiche->update(['scolarite' => $request->scolarite]);
        }

        return redirect()->route('fiche.index')->with('success', 'Validation réussie.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Fiche  $fiche
    * @return \Illuminate\Http\Response
    */
    public function destroy(Fiche $fiche)
    {
        $fiche->delete();
        return redirect()->route('fiche.index')->with('success', 'Annulation réussie.');
    }

    public static function compteur()
    {
        $fiches = Fiche::all();
        $validate = 0;
        $en_cours_sp = 0;
        $en_cours_dir = 0;
        $en_cours_scolarite = 0;

        foreach ($fiches as $fiche) {
            if (empty($fiche->sp)) {
                $en_cours_sp++;
            } elseif (!empty($fiche->sp) && empty($fiche->dir)) {
                $en_cours_dir++;
            } elseif (!empty($fiche->sp) && !empty($fiche->dir) && empty($fiche->scolarite)) {
                $en_cours_scolarite++;
            } elseif (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite)) {
                $validate++;
            }
        }
        return $data = [
            'en_cours_sp' => $en_cours_sp,
            'en_cours_dir' => $en_cours_dir,
            "en_cours_scolarite" => $en_cours_scolarite,
            "validate" => $validate
        ];
    }
}
