<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $users = User::all();
        return view('auth.all',['users'=>$users]);
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
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('auth.edit',['user'=>$user, 'roles' =>$roles]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required','unique:users,email,'.$user->id],
            'phone' => ['required','unique:users,phone,'.$user->id],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }

    public function updateData(Request $request, User $user)
    {
        $request->validate([
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $code = mt_rand(0, 9) . '' . mt_rand(0, 9) . '' . mt_rand(0, 9) . '' . mt_rand(0, 9);

        $verify = SmsController::sendSms("IBAM-INFOS", "Code de validation : " . $code . ".\nSaisissez-le pour valider votre inscription.", $request->phone);
        if ($verify['status'] == 201 || $verify['status'] == 200) {
            return view("auth.confirm-code", ['code' => $code, 'request' => $request]);
        } else {
            $error = $verify['response']['message'];
            return redirect()->route('user.inscription.index')
            ->with('error', $error);
        }
    }
}
