<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
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
        $fiches = Fiche::all();
        $compteurs = FicheController::compteur();
        return view('Fiche.all', compact('fiches', 'compteurs'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('Fiche.add');
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
        ]);
        Fiche::create($request->all());
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

        if (!empty($request->sp_instructions)) {
            $fiche->update(['sp_instructions' => $request->sp_instructions]);
        } elseif (!empty($request->dir_instructions)) {
            $fiche->update(['dir_instructions' => $request->dir_instructions]);
        } elseif(!empty($request->proposition)) {
            $request->validate([
                "proposition" => "required"
            ]);
            $fiche->update(['proposition' => $request->proposition]);
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
        $fiche->update(["delete" => true]);
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
            if (empty($fiche->sp_instructions)) {
                $en_cours_sp++;
            } elseif (!empty($fiche->sp_instructions) && empty($fiche->dir_instructions)) {
                $en_cours_dir++;
            } elseif (!empty($fiche->sp_instructions) && !empty($fiche->dir_instructions) && empty($fiche->proposition)) {
                $en_cours_scolarite++;
            } elseif (!empty($fiche->sp_instructions) && !empty($fiche->dir_instructions) && !empty($fiche->proposition)) {
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
