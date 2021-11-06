<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SocialiteController extends Controller
{
    protected $providers = ["google", "github", "facebook"];

    public function redirect(Request $request)
    {
        $provider = $request->provider;
        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect();
        } else {
            abort(404);
        }
    }

    public function callback(Request $request)
    {
        $provider = $request->provider;
        if (in_array($provider, $this->providers)) {
            $data = Socialite::driver($request->provider)->user();
            $user = User::where("email", $data->getEmail())->first();
            if (isset($user)) {
                Auth::login($user);
                return redirect('/mes-demande');
            } else {
                $user = new User();
                $user->name = $data->getName();
                $user->email = $data->getEmail();
                $user->avatar = $data->getAvatar();
                $user->role_id = 6;
                Session::put(['user' => $user]);
                return redirect()->route('demandeur.complete');
            }
        } else {
            abort(404);
        }
    }

}
