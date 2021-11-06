@extends('layouts.auth-master')

@section('title')
| Connexion
@endsection

@section('auth-content')

<h3 class="mb-4 f-w-400">Connexion</h3>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Email Address -->
    <div class="form-group mb-3">
        <label class="floating-label" for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email"/>
    </div>
    <!-- Password -->
    <div class="form-group mb-3">
        <label class="floating-label" for="password">Mot de passe</label>
        <input class="form-control" id="password" type="password" name="password"/>
    </div>
    <!-- Remember Me -->
    <div class="custom-control custom-checkbox text-left mb-4 mt-2">
        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
        <label class="custom-control-label" for="customCheck1">Se souvenir de moi</label>
    </div>
    <button class="btn btn-block btn-primary mb-4">Se connecter</button>

    <div class="text-center">
        <div class="saprator my-4"><span>OU</span></div>
        <a href="{{ route('socialite.redirect', 'facebook') }}" class="btn text-white bg-facebook mb-2 mr-2  wid-40 px-0 hei-40 rounded-circle" title="Connexion/Inscription avec Facebook" class="btn btn-link"  ><i class="fab fa-facebook-f"></i></a>
        <a href="{{ route('socialite.redirect', 'google') }}" class="btn text-white bg-googleplus mb-2 mr-2 wid-40 px-0 hei-40 rounded-circle" title="Connexion/Inscription avec Google" class="btn btn-link"  ><i class="fab fa-google-plus-g"></i></a>
        <button class="btn text-white bg-twitter mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-twitter"></i></button>
        @if (Route::has('password.request'))
        <p class="mb-2 mt-4 text-muted">Mot de passe oublié ? <a  href="{{ route('password.request') }}" class="f-w-400">Réinitialiser</a></p>
        @endif
        <p class="mb-2 mt-4 text-muted">Nouveau ? <a  href="{{ route('user.inscription.index') }}" class="f-w-400">Créer un compte</a></p>
    </div>

</form>

@endsection

@section('javascript')
<script>
    var oldInput = <?= json_encode(session()->getOldInput()); ?>;
    console.log(oldInput);
    if (!(oldInput.length === 0)) {
        document.getElementById("email").value = oldInput['email'];
    }


</script>
@endsection
