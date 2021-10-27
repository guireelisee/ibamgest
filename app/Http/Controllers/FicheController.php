<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Salle;
use App\Models\User;
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
        return view('Fiche.all', compact('fiches','salles'));
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
            'date_arrivee' => 'required',
        ]);
        Fiche::create([
            'nom_exp' => $request->nom_exp,
            'prenom_exp' => $request->prenom_exp,
            'salle_id' => $request->salle,
            'motif' => $request->motif,
            'date_arrivee' => $request->date_arrivee,
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
        $salles = Salle::all();
        return view('Fiche.edit', compact('fiche','salles'));
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
        $success = 'Validation réussie.';
        if(!$fiche->secretaire) {
            $request->validate([
                'nom_exp' => 'required',
                'prenom_exp' => 'required',
                'salle' => 'required',
                'motif' => 'required',
                'date_arrivee' => 'required',
            ]);
            $fiche->update([
                'nom_exp' => $request->nom_exp,
                'prenom_exp' => $request->prenom_exp,
                'salle_id' => $request->salle,
                'motif' => $request->motif,
                'date_arrivee' => $request->date_arrivee,
            ]);
            $success = 'Modification réussie.';
        } elseif (!empty($request->sp)) {
            $fiche->update(['sp' => $request->sp]);

            $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif . "\nInstructions du SP: ".$request->sp."\n----------------------------\nMerci de vous connecter pour effectuer la validation.";
            $status = SmsController::sendSms($message, "73916210", "IBAM-SALLE");

            $notif = ( $status === 200 || $status === 201) ? 'Notification envoyée au Directeur' : 'Rechargez votre compte';

        } elseif (!empty($request->dir)) {
            $fiche->update(['dir' => $request->dir]);

            $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif . "\nInstructions du Directeur: " . $fiche->dir . "\n----------------------------\nMerci de vous connecter pour effectuer la validation.";
            $status = SmsController::sendSms($message, "73916210", "IBAM-SALLE");

            $notif = ( $status === 200 || $status === 201) ? 'Notification envoyée à la scolarité' : 'Rechargez votre compte';

        } elseif(empty($request->scolarite)) {
            $request->validate([
                "valide" => "required",
                "scolarite" => "required"
            ]);
        } elseif(!empty($request->scolarite)) {
            if ($request->valide == "accorde") {
                $vali = true;
            } else {
                $vali = false;
            }

            $fiche->update([
                "accepte" => $vali,
                'scolarite' => $request->scolarite,
                'date_validation' => now()
            ]);
            $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif . "\nInstructions de la scolarité: " . $fiche->dir . "\n----------------------------\nStatut: Demande traitee.";
            $status = SmsController::sendSms($message, "73916210", "IBAM-SALLE");

            $notif = ( $status === 200 || $status === 201) ? 'Notification envoyée à la secretaire' : 'Rechargez votre compte';
        }

        return redirect()->route('fiche.index')->with('success', $success.' '.$notif);
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

    public function valider(Fiche $fiche)
    {
        $fiche->update([
            'secretaire' => true
        ]);
        $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif."\n----------------------------\nMerci de vous connecter pour effectuer la validation.";
        $status = SmsController::sendSms($message, "73916210", "IBAM-SALLE");
        $notif = ( $status === 200 || $status === 201) ? 'Notification envoyée au SP' : 'Rechargez votre compte';

        return redirect()->route('fiche.index')->with('success', "Validation réussie. $notif");
    }

}
