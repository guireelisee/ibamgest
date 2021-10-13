<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
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
        return view('Devoir.add');
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
            'phone' => ['required', 'unique:devoirs'],
            'email' => ['required', 'unique:devoirs', 'email'],
        ]);

        Devoir::create($request->all());
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
        return view('Devoir.edit', compact('devoir'));
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

        $request->validate(['nom' => ['required'],
        'prenom' => ['required'],
        'civilite' => ['required'],
        'phone' => ['required', 'unique:devoirs,phone,'.$devoir->id],
        'email' => ['required', 'unique:devoirs,email,' . $devoir->id],
    ]);

    $devoir->update($request->all());
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
