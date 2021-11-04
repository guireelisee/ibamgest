<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\qrcode;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qrcodes = new ArrayObject();

        for ($i=0; $i < 15; $i++) {
            $code = $this->generateCode();
            $qrcodes->append($code);
        }



        return view('qrcode/index')->with('qrcodes', $qrcodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateCode()
    {
        $code = "IBAM-". strtoupper(Str::random(10));

        if (qrcode::where('codes', $code)->get()->count() !== 0) {
            $this->generateCode();
        }else {
            qrcode::create([
                "codes" => $code
            ]);
            return $code;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function tracking(Request $request)
    {
        $request->validate([
            'qrcode' => ['required']
        ]);
        $devoir = Devoir::where('qrcode', $request->qrcode)->get();
        if ($devoir->count() !== 0)  {
            return redirect()->route('devoir.tracking', [$devoir[0]->id]);

        } else {
            return redirect()->route('devoir.index')->withErrors(['devoirnotefound' => 'Aucun devoir avec ce qrcode !']);

        }

    }



}
