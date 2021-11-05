<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class FicheController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if (Auth::user()->role_id == 6) {
            $fiches = Fiche::Where('id_demandeur', Auth::user()->id)->get();
            $salles = Salle::all();
            return view('Fiche.all', compact('fiches','salles'));
        } else {
            $fiches = Fiche::all();
            $salles = Salle::all();
            return view('Fiche.all', compact('fiches','salles'));
        }

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

    public function auth_create()
    {
        $salles = Salle::all();
        return view('Fiche.auth-add', compact('salles'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if (Auth::user()->role_id == 6) {
            $request->validate([
                'salle' => 'required',
                'motif' => 'required',
                'date_arrivee' => 'required',
                'date_debut_occupation' => 'required',
                'date_fin_occupation' => 'required',

            ]);

            Fiche::create([
                'nom_exp' => Auth::user()->name,
                'prenom_exp' => Auth::user()->firstname,
                'id_demandeur' => Auth::user()->id,
                'salle_id' => $request->salle,
                'motif' => $request->motif,
                'date_arrivee' => $request->date_arrivee,
                'date_debut_occupation' => $request->date_debut_occupation,
                'date_fin_occupation' => $request->date_fin_occupation,
            ]);

            return redirect()->route('fiche.index')->with('success', 'Demande de salle enregistrée avec succès.');

        } else {
            $request->validate([
                'nom_exp' => 'required',
                'prenom_exp' => 'required',
                'salle' => 'required',
                'motif' => 'required',
                'date_arrivee' => 'required',
                'date_debut_occupation' => 'required',
                'date_fin_occupation' => 'required',
            ]);
            Fiche::create([
                'nom_exp' => $request->nom_exp,
                'prenom_exp' => $request->prenom_exp,
                'salle_id' => $request->salle,
                'motif' => $request->motif,
                'date_arrivee' => $request->date_arrivee,
                'date_debut_occupation' => $request->date_debut_occupation,
                'date_fin_occupation' => $request->date_fin_occupation,
            ]);
            return redirect()->route('fiche.index')->with('success', 'Demande de salle enregistrée avec succès.');
        }

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

    public function verifier_disponibilite(Request $request)
    {
        $id_salle = $request->id_salle;
        $fiche = Fiche::where('accepte', '=', true)->where('salle_id', '=', $id_salle)
        ->where('date_fin_occupation', '>=', $request->date_debut_occupation)
        ->get();
        if ($fiche->count() === 0) {
            return redirect()->route('fiche.index')->with('success','La salle est disponible dans cette période !');
        } else {
            return redirect()->route('fiche.index')->with('warning','La salle est indisponible dans cette période !');

        }

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
            $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif . "\nInstructions du SP: ".$request->sp."\n----------------------------\nMerci de vous connecter pour effectuer la validation.";
            $verify = SmsController::sendSms("IBAM-SALLE", $message, User::where('role_id', 4)->first()->phone);
            if ($verify['status'] == 201 || $verify['status'] == 200) {
                $fiche->update(['sp' => $request->sp]);
                return redirect()->route('fiche.index')->with('success', "Validation réussie.");
            } else {
                return redirect()->route('fiche.index')->with('error', $verify['response']['message']);
            }

        } elseif (!empty($request->dir)) {
            $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif . "\nInstructions du Directeur: " . $request->dir . "\n----------------------------\nMerci de vous connecter pour effectuer la validation.";
            $verify = SmsController::sendSms("IBAM-SALLE", $message, User::where('role_id', 5)->first()->phone);
            if ($verify['status'] == 201 || $verify['status'] == 200) {
                $fiche->update(['dir' => $request->dir]);
                return redirect()->route('fiche.index')->with('success', "Validation réussie.");
            } else {
                return redirect()->route('fiche.index')->with('error', $verify['response']['message']);
            }

        } elseif(empty($request->scolarite)) {
            $request->validate([
                "valide" => "required",
                "scolarite" => "required"
            ]);
        } elseif(!empty($request->scolarite)) {
            if ($request->valide == "accorde") {
                $valide = true;
            } else {
                $valide = false;
            }
            $statut = $fiche->accepte ? "Accordee" : "Rejette";
            $message = "Bonjour, votre demande de la salle ". $fiche->salle->nom." a ete traitee.\Statut: ".$statut;
            $verify = SmsController::sendSms("IBAM-SALLE", $message, User::where('role_id', 6)->first()->phone);
            if ($verify['status'] == 201 || $verify['status'] == 200) {
                $fiche->update([
                    "accepte" => $valide,
                    'scolarite' => $request->scolarite,
                    'date_validation' => now()
                ]);
                return redirect()->route('fiche.index')->with('success', "Validation réussie.");
            } else {
                return redirect()->route('fiche.index')->with('error', $verify['response']['message']);
            }
        }

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
        $message = "Bonjour, vous avez une demande de salle en cours de validation.\nCi-dessous les details:\n----------------------------\nExpediteur: " . $fiche->nom_exp . ' ' . $fiche->prenom_exp . "\nSalle demandee: " . $fiche->salle->nom . "\nMotif: " . $fiche->motif."\n----------------------------\nMerci de vous connecter pour effectuer la validation.";
        $verify = SmsController::sendSms("IBAM-SALLE",$message, User::where('role_id', 3)->first()->phone);

        if ($verify['status'] == 201 || $verify['status'] == 200) {
            $fiche->update([
                'secretaire' => true
            ]);
            return redirect()->route('fiche.index')->with('success', "Validation réussie.");
        } else {
            return redirect()->route('fiche.index')->with('error',$verify['response']['message']);
        }

    }

}
