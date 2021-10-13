<?php

namespace App\Http\Controllers;

use App\Models\Surveillant;
use Illuminate\Http\Request;

class SurveillantController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $surveillants = Surveillant::all();
        return view('Surveillant.all', ['surveillants' => $surveillants]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('Surveillant.add');
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
            'nom' => ['required'],
            'prenom' => ['required'],
            'civilite' => ['required'],
            'phone' => ['required', 'unique:surveillants'],
            'email' => ['required', 'unique:surveillants', 'email'],
        ]);

        Surveillant::create($request->all());
        return redirect()->route('surveillant.index')->with('success', 'Nouveau surveillant enregistré.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Surveillant  $surveillant
    * @return \Illuminate\Http\Response
    */
    public function show(Surveillant $surveillant)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Surveillant  $surveillant
    * @return \Illuminate\Http\Response
    */
    public function edit(Surveillant $surveillant)
    {
        return view('Surveillant.edit', compact('surveillant'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Surveillant  $surveillant
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Surveillant $surveillant)
    {
        $request->validate(['nom' => ['required'],
        'prenom' => ['required'],
        'civilite' => ['required'],
        'phone' => ['required', 'unique:surveillants,phone,'.$surveillant->id],
        'email' => ['required', 'unique:surveillants,email,' . $surveillant->id],
    ]);

    $surveillant->update($request->all());
    return redirect()->route('surveillant.index')->with('success', 'Modification du surveillant réussie.');
}

/**
* Remove the specified resource from storage.
*
* @param  \App\Models\Surveillant  $surveillant
* @return \Illuminate\Http\Response
*/
public function destroy(Surveillant $surveillant)
{
    $surveillant->delete();
    return redirect()->route('surveillant.index')->with('success', 'Suppression réussie.');
}
}
