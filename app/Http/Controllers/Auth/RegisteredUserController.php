<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Core\Number;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

    /**
    * Display the registration view.
    *
    * @return \Illuminate\View\View
    */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('auth.register',['roles'=>$roles]);
    }

    /**
    * Handle an incoming registration request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    *
    * @throws \Illuminate\Validation\ValidationException
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        if ($request->avatar) {
            $filename = time() . '.' . $request->avatar->extension();
            $path = $request->avatar->storeAs('avatars', $filename, 'public');
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'avatar' => $path
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role_id' => $request->role
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function inscription_demandeur_index()
    {
        return view('auth.register-demandeur');
    }

    public function confirm_code_view()
    {
        return view('auth.confirm-code');
    }

    public function verifier_code(Request $request)
    {
        if ($request->code_envoye == $request->code_saisie) {
            if ($request->avatar) {
            $filename = time() . '.' . $request->avatar->extension();
            $path = $request->avatar->storeAs('avatars', $filename, 'public');
            $user = User::create([
                'name' => $request->name,
                'firstname' => $request->firstname,
                'email' => $request->email,
                'phone' => "+226".$request->phone,
                'password' => Hash::make($request->password),
                'role_id' => 6,
                'avatar' => $path
            ]);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'firstname' => $request->firstname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role_id' => 6
                ]);
            }
            event(new Registered($user));

            Auth::login($user);

            return redirect('/mes-demande');
        } else {
            return view('auth.register-demandeur');
        }

    }

    public function inscription_demandeur(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $code = mt_rand(0, 9).''.mt_rand(0, 9).''.mt_rand(0, 9).''.mt_rand(0, 9);

        if (SmsController::sendSms("IBAM-INFOS", "Code de validation : ".$code.". Saisissez le pour valider votre inscription", $request->phone)) {
            return view("auth.confirm-code", ['code'=>$code, 'request'=>$request]);
        } else {
            echo "Une erreur est survenue !";
        }
    }
}
