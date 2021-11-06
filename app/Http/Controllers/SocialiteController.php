<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
            $user = $data->user;
            dd($user);
            // token
            $token = $data->token;

            // Les informations de l'utilisateur
            $id = $data->getId();
            $name = $data->getNickname();
            $nickname = $data->getName();
            $email = $data->getEmail();
            $avatar = $data->getAvatar();
        }
        abort(404);
    }
}
