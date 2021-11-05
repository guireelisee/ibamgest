<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::orderByDesc('date_demande')->get()->values();
        return view('Demande-views/all')->with('demandes', $demandes);
    }

    public function auth_index()
    {
        $demandes = Demande::where('id_demandeur', Auth::user()->id)->orderByDesc('date_demande')->get()->values();
        return view('Demande-views/user-all')->with('demandes', $demandes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Demande-views/add');
    }

    public function auth_create()
    {
        return view('Demande-views/auth-add');
    }


    public function print(Request $request)
    {
        $demande = Demande::where('date_demande', '<=', $request->date_fin)
            ->where('date_demande', '>=', $request->date_debut)
            ->get();
        return view('Demande-views/print')->with('demandes', $demande);
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
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'motif' => 'required',
            'dateD' => 'required',
        ]);
        Demande::create([
            "nomDemandeur" => $request->nom,
            "prenomDemandeur" => $request->prenom,
            "tel" => $request->tel,
            "service" => $request->service,
            "profession" => $request->prof,
            "motif" => $request->motif,
            "date_demande" => $request->dateD
        ]);
        return redirect()->route('demande.index')
            ->with('success', 'Demande ajoutée.');
    }

    public function auth_store(Request $request)
    {
        $request->validate([
            'motif' => 'required',
            'dateD' => 'required',
        ]);
        Demande::create([
            "nomDemandeur" => Auth::user()->name,
            "prenomDemandeur" => Auth::user()->firstname,
            "tel" => Auth::user()->phone,
            "motif" => $request->motif,
            "date_demande" => $request->dateD,
            "id_demandeur" => Auth::user()->id

        ]);
        return redirect()->route('demande.auth.index')
            ->with('success', 'Demande soumise.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/edit')->with('demande', $demande);
    }


    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'motif' => 'required',
            'dateD' => 'required',
        ]);
        $idDemande = $request->idDemande;
        $demande = demande::where('idDemande', $idDemande);
        $demande->update([
            "nomDemandeur" => $request->nom,
            "prenomDemandeur" => $request->prenom,
            "tel" => $request->tel,
            "service" => $request->service,
            "profession" => $request->prof,
            "motif" => $request->motif,
            "date_demande" => $request->dateD
        ]);
        return redirect()->route('demande.index')
            ->with('success', 'Demande mise à jour.');
    }

    public function valider(Request $request)
    {
        $request->validate([
            'dateR' => 'required',
            'dateA' => 'required',
            'heureA' => 'required'
        ]);

        $id = $request->idDemande;
        $demande = Demande::where('idDemande', $id);
        $demande->update([
            "date_reponse" => Date::now(),
            "date_audience" => $request->dateA,
            "heure_audience" => $request->heureA,
            "decision" => true
        ]);

        $demande = $demande->get();
        $tel = $demande[0]->tel;
        $msg = "Bonjour ! Mr/Mme $request->nom. Votre demande d'audience aupres du Directeur a ete acceptee et programmee pour le $request->dateA, a $request->heureA.";
        $verify = SmsController::sendSms("IBAM-INFOS", $msg, $tel);


        if ($verify['status'] == 201 || $verify['status'] == 200) {
            return redirect()->route('demande.index')
                ->with('success', 'Demande validée !');
        } else die("Error: {$verify['response']['message']} ");
    }

    public function validateView($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/validate')->with('demande', $demande);
    }

    public function rejetterView($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/rejet')->with('demande', $demande);
    }

    public function suppressionView($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/delete')->with('demande', $demande);
    }

    public function rejetter(Request $request)
    {
        $id = $request->idDemande;
        $demande = Demande::where('idDemande', $id);
        $demande->update([
            "date_reponse" => Date::now(),
            "decision" => false
        ]);
        $demande = $demande->get();
        $tel = $demande[0]->tel;
        $msg = "Bonjour ! Mr/Mme $request->nom. Votre demande d'audience aupres du Directeur a ete rejettee.";
        $verify = SmsController::sendSms("IBAM-INFOS", $msg, $tel);

        if ($verify['status'] == 201 || $verify['status'] == 200) {
            return redirect()->route('demande.index')
                ->with('success', 'Demande rejetée.');
        } else die("Error: {$verify['response']['message']} ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->idDemande;
        $demande = Demande::where('idDemande', $id);
        $demande->delete();

        if (Auth::user()->role_id === 6) {
            return redirect()->route('demande.auth.index')
                ->with('success', 'Demande supprimée.');
        } else {
            return redirect()->route('demande.index')
                ->with('success', 'Demande supprimée.');
        }
    }
}
