<?php

namespace App\Http\Controllers;

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
    public function show(qrcode $qrcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function edit(qrcode $qrcode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qrcode $qrcode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(qrcode $qrcode)
    {
        //
    }
}
