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
        return view('Fiche.index', compact('fiches', 'compteurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fiches.create');
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
        return redirect()->route('fiche.index')->with('success', 'Demande enregistrée avec succès.');
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
        return view('fiches.edit', compact('fiche'));
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

        // Mise à jour de l'instruction du SP
        if (!empty($request->sp_instructions) && !isset($request->dir_instructions)) {
            $fiche->update(['sp_instructions' => $request->sp_instructions]);
        }

        // Mise à jour de l'instruction du Directeur
        if (!empty($request->sp_instructions) && !empty($request->dir_instructions)) {
            $fiche->update(['dir_instructions' => $request->dir_instructions]);
        }

        // Mise à jour de l'instruction de la scolarité
        if (!empty($request->sp_instructions) && !empty($request->dir_instructions) && !empty($request->proposition)) {
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
        //
    }

    public function compteur()
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
