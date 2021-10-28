<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Devoir;
use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct() {
        
    }

    public function index()
    {
        if (Auth::user()->role_id == 6) {
            return redirect()->route('demande.auth.index');
        } else{
            $audiences = $this->audiences();
            $fiches = $this->fiches();
            $devoirs = $this->devoirs();
            return view('index', compact('audiences', 'fiches','devoirs'));
        }
        
    }

    public function audiences()
    {
        $audiences = Demande::all();
        $enAttente = 0;
        $valider = 0;
        foreach ($audiences as $audience) {
            if (!$audience->decision) {
               $enAttente++;
            } else {
                $valider++;
            }
        }
        return [
            'enAttente' => $enAttente,
            'valider' => $valider,
            'all' => count($audiences)
        ];
    }

    public function fiches()
    {
        $fiches = Fiche::all();
        $valider = 0;
        $sp = 0;
        $dir = 0;
        $scolarite = 0;

        foreach ($fiches as $fiche) {
            if (empty($fiche->sp)) {
                $sp++;
            } elseif (!empty($fiche->sp) && empty($fiche->dir)) {
                $dir++;
            } elseif (!empty($fiche->sp) && !empty($fiche->dir) && empty($fiche->scolarite)) {
                $scolarite++;
            } elseif (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite)) {
                $valider++;
            }
        }
        return [
            'sp' => $sp,
            'dir' => $dir,
            "scolarite" => $scolarite,
            "valider" => $valider,
            'all' => count($fiches)
        ];
    }

    public function devoirs()
    {
        $devoirs = Devoir::all();
        return [
            'all' => count($devoirs)
        ];
    }
}
