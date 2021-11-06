<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    protected $providers = ["google", "github", "facebook"];

    public function redirect(Request $request)
    {
        $provider = $request->provider;
        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    public function callback(Request $request)
    {
        $provider = $request->provider;
        if (in_array($provider, $this->providers)) {
            $data = Socialite::driver($request->provider)->user();

            $user = User::where("email", $data->getEmail())->first();

            if (isset($user)) {
                $user->name = $data->getName();
                $user->save();
                event(new Registered($user));
                Auth::login($user);
                return redirect('/mes-demande');
            } else {
                $user = User::create([
                    'name' => $data->getName(),
                    'email' => $data->getEmail(),
                    'password' => Hash::make('password'),
                    'avatar' => $data->getAvatar(),
                    'role_id' => 6,
                ]);
                return view('auth.register-demandeur-phone', compact('user'));
            }
        }
        abort(404);
    }

}
