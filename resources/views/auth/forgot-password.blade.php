@extends('layouts.auth-master')

@section('auth-content')

<h3 class="mb-4 f-w-400">Mot de passe oublié</h3>
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <!-- Email Address -->
    <div class="form-group mb-3">
        <label class="floating-label" for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email"/>
    </div>
    <button class="btn btn-block btn-primary mb-4">Envoyez</button>
    @if (Route::has('login'))
    <p class="mb-2 mt-4 text-muted">Voulez-vous vous connecter ? <a  href="{{ route('login') }}" class="f-w-400">Connexion</a></p>
    @endif
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
