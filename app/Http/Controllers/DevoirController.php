<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\Surveillant;
use Illuminate\Http\Request;

class DevoirController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $devoirs = Devoir::all();
        return view('Devoir.all', ['devoirs' => $devoirs]);
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
        $salles = Salle::orderBy('nom')->get();
        $surveillants = Surveillant::orderBy('nom')->get();
        return view('Devoir.add',compact('professeurs','matieres','filieres','salles', 'surveillants'));
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
            'salle' => ['required'],
            'date' => ['required'],
            'duree' => ['required'],
            'surveillant' => ['required'],
            'matiere' => ['required'],
        ]);
        $devoir = Devoir::create([
            'professeur_id' => $request->professeur,
            'filiere_id' => $request->filiere,
            'matiere_id' => $request->matiere,
            'salle_id' => $request->salle,
            'niveau' => $request->niveau,
            'heure' => $request->heure,
            'duree' => $request->duree,
            'date' => $request->date,
        ]);


        foreach ($request->input('surveillant') as $id) {
           $surveillant = Surveillant::where('id', $id)->get()->values();
           $message = "Bonjour Mr/Mme ".$surveillant[0]->nom.". Nous vous informons que vous êtes programmé pour un devoir.\n-------------------------\nDate du devoir : ".date('d/m/Y', strtotime($request->date))."\nHeure du devoir : ".date('H:i', strtotime($request->date))."\n-------------------------\nMerci et bonne journée !";
           SmsController::sendSms("IBAM-DEVOIR", $message, $surveillant[0]->phone);
        }
        $devoir->surveillants()->sync($request->input('surveillant'));
        return redirect()->route('devoir.index')->with('success', 'Nouveau devoir enregistré.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function show(Devoir $devoir)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function edit(Devoir $devoir)
    {
        $niveaux = [
            'Licence I','Master I',
            'Licence II','Master II',
            'Licence III','Master III',
        ];
        $professeurs = Professeur::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();
        $filieres = Filiere::orderBy('nom_filiere')->get();
        $salles = Salle::orderBy('nom')->get();
        $surveillants = Surveillant::orderBy('nom')->get();
        return view('Devoir.edit', compact('niveaux','devoir','professeurs', 'matieres', 'filieres', 'salles', 'surveillants'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Devoir $devoir)
    {
        $request->validate([
            'professeur' => ['required'],
            'filiere' => ['required'],
            'niveau' => ['required'],
            'salle' => ['required'],
            'date' => ['required'],
            'duree' => ['required'],
            'surveillant' => ['required'],
            'matiere' => ['required'],
        ]);
        $devoir->update([
            'professeur_id' => $request->professeur,
            'filiere_id' => $request->filiere,
            'matiere_id' => $request->matiere,
            'salle_id' => $request->salle,
            'niveau' => $request->niveau,
            'heure' => $request->heure,
            'duree' => $request->duree,
            'date' => $request->date,
        ]);
        $devoir->surveillants()->sync($request->input('surveillant'));
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    public function depot_sujet(Request $request)
    {
        $request->validate([
            'date_depot_sujet' => ['required'],
            'sujet_depose_par' => ['required'],
        ]);
        $devoir = Devoir::where('id', $request->id);
        $devoir->update([
            'date_depot_sujet' => $request->date_depot_sujet,
            'sujet_depose_par' => $request->sujet_depose_par,
        ]);
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    public function prise_sujet(Request $request)
    {
        $request->validate([
            'date_prise_sujet' => ['required'],
            'sujet_pris_par' => ['required'],
        ]);
        $devoir = Devoir::where('id', $request->id);
        $devoir->update([
            'date_prise_sujet' => $request->date_prise_sujet,
            'sujet_pris_par' => $request->sujet_pris_par,
        ]);
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    public function retour_copies(Request $request)
    {
        $request->validate([
            'date_retour_copie' => ['required'],
            'copie_envoye_par' => ['required'],
        ]);
        $devoir = Devoir::where('id', $request->id);
        $devoir->update([
            'date_retour_copie' => $request->date_retour_copie,
            'copie_envoye_par' => $request->copie_envoye_par,
        ]);
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    public function prise_copies_prof(Request $request)
    {
        $request->validate([
            'date_prise_copie_professeur' => ['required'],
            'copie_prise_par' => ['required'],
        ]);
        $devoir = Devoir::where('id', $request->id);
        $devoir->update([
            'date_prise_copie_professeur' => $request->date_prise_copie_professeur,
            'copie_prise_par' => $request->copie_prise_par,
        ]);
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    public function retour_copie_apres_correction(Request $request)
    {
        $request->validate([
            'date_retour_copie_apres_correction' => ['required'],
            'copie_retourne_par' => ['required'],
        ]);
        $devoir = Devoir::where('id', $request->id);
        $devoir->update([
            'date_retour_copie_apres_correction' => $request->date_retour_copie_apres_correction,
            'copie_retourne_par' => $request->copie_retourne_par,
        ]);
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }

    public function prise_copie_etudiants(Request $request)
    {
        $request->validate([
            'date_prise_copie_etudiants' => ['required'],
            'copie_prise_par_etudiant' => ['required'],
        ]);
        $devoir = Devoir::where('id', $request->id);
        $devoir->update([
            'date_prise_copie_etudiants' => $request->date_prise_copie_etudiants,
            'copie_prise_par_etudiant' => $request->copie_prise_par_etudiant,
        ]);
        return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Devoir  $devoir
    * @return \Illuminate\Http\Response
    */
    public function destroy(Devoir $devoir)
    {
        $devoir->delete();
        return redirect()->route('devoir.index')->with('success', 'Suppression réussie.');
    }
}
