<?php

namespace App\Http\Controllers;

use App\Models\AffectationCours;
use App\Models\Devoir;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\Surveillant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $professeurs = Professeur::orderBy('nom')->get();
        $affectations = AffectationCours::all();
        // $matieres = Matiere::orderBy('nom_matiere')->get();
        // $filieres = Filiere::orderBy('nom_filiere')->get();
        $salles = Salle::orderBy('nom')->get();
        $surveillants = Surveillant::orderBy('nom')->get();
        return view('Devoir.add',compact('affectations','salles', 'surveillants'));
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
            'salle' => ['required'],
            'date' => ['required'],
            'duree' => ['required'],
            'surveillant' => ['required'],
        ]);

        $affectation = AffectationCours::where('id', $request->affectation)->first();

        $devoir = Devoir::create([
            'professeur_id' => $affectation->professeur_id,
            'filiere_id' => $affectation->filiere_id,
            'matiere_id' => $affectation->matiere_id,
            'salle_id' => $request->salle,
            'niveau' => $affectation->niveau,
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
            'Licence III',
        ];
        $affectations = AffectationCours::all();
        $professeurs = Professeur::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();
        $filieres = Filiere::orderBy('nom_filiere')->get();
        $salles = Salle::orderBy('nom')->get();
        $surveillants = Surveillant::orderBy('nom')->get();
        return view('Devoir.edit', compact('affectations','niveaux','devoir','professeurs', 'matieres', 'filieres', 'salles', 'surveillants'));
    }

    public function tracking(Devoir $devoir)
    {
        return view('Devoir.tracking', compact('devoir'));
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
        dd($request);
        $request->validate([
            'salle' => ['required'],
            'date' => ['required'],
            'duree' => ['required'],
            'surveillant' => ['required'],
        ]);

        $affectation = AffectationCours::where('id', $request->affectation)->first();

        $devoir->update([
            'professeur_id' => $affectation->professeur_id,
            'filiere_id' => $affectation->filiere_id,
            'matiere_id' => $affectation->matiere_id,
            'salle_id' => $request->salle,
            'niveau' => $affectation->niveau,
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
            'qrcode' => ['required'],
        ]);
        if (Devoir::where('qrcode', $request->qrcode)->get()->count() !== 0) {
            return redirect()->route('devoir.tracking', [$request->id])->withErrors(['qrcodeError' => 'QrCode déjà utilisé']);

        }else {
            $devoir = Devoir::where('id', $request->id);
            $devoir->update([
                'date_depot_sujet' => $request->date_depot_sujet,
                'sujet_depose_par' => $request->sujet_depose_par,
                'user_sujet_depose_par' => Auth::user()->name." ". Auth::user()->firstname,
                'qrcode' => $request->qrcode,

            ]);
            return redirect()->route('devoir.index')->with('success', 'Modification du devoir réussie.');
        }

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
            'user_sujet_pris_par' => Auth::user()->name." ". Auth::user()->firstname,

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
            'user_copie_envoye_par' => Auth::user()->name." ". Auth::user()->firstname,
            'classeur_copie_envoye' => $request->classeur_copie_envoye,

            
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
            'user_copie_prise_par' => Auth::user()->name." ". Auth::user()->firstname,

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
            'user_copie_retourne_par' => Auth::user()->name." ". Auth::user()->firstname,
            'classeur_copies_retourne' => $request->classeur_copies_retourne,


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
            'user_copie_prise_par_etudiant' => Auth::user()->name." ". Auth::user()->firstname,

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
