<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
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
        return view('Demande-views/all')->with('demandes',$demandes);
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
                        ->with('success','Demande ajoutée.');
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
                        ->with('success','Demande mise à jour.');
    }

    public function valider(Request $request)
    {
        $id = $request->idDemande;
        $demande = Demande::where('idDemande', $id);
        $demande->update([
          "date_reponse" => Date::now(),
          "date_audience" => $request->dateA,
          "heure_audience" => $request->heureA,
          "decision" => true
        ]);

        $response = Http::withHeaders([
            'X-AUTH-TOKEN" => "b5fb79ba-a89e-44e2-93e2-5b95ce2a631e'
        ])->post('https://www.aqilas.com/api/v1/sms', [
            "from"=>"SUIVI-NOTIF",
            "to"=>["+22673897492"],
            "text"=>"Bonjour ! Mr/Mme $request->nom. Votre demande d'audience auprès du Directeur a été acceptée et programmée pour le $request->dateA, à $request->heureA."
        ]);



        dd($response);


    }

    public function validateView($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/validate')->with('demande',$demande);
    }

    public function rejetterView($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/rejet')->with('demande',$demande);
    }

    public function suppressionView($idDemande)
    {
        $demande = Demande::where('idDemande', $idDemande)->get();
        return view('Demande-views/delete')->with('demande',$demande);
    }

    public function rejetter(Request $request)
    {
        $id = $request->idDemande;
        $demande = Demande::where('idDemande', $id);
        $demande->update([
          "date_reponse" => Date::now(),
          "decision" => false
        ]);

        return redirect()->route('demande.index')
                        ->with('success','Demande rejetée.');
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

        return redirect()->route('demande.index')
                        ->with('success','Demande supprimée.');
    }
}
