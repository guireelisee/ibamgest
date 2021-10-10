@extends('layouts.auth-master')

@section('title')
| Réinitialisation du mot de passe
@endsection

@section('auth-content')

<h3 class="mb-4 f-w-400">Réinitialisation</h3>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <div class="form-group mb-3">
        <label class="floating-label" for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email"/>
    </div>

    <!-- Password -->
    <div class="form-group mb-3">
        <label class="floating-label" for="password">Nouveau mot de passe</label>
        <input id="password" class="form-control" type="password" name="password"/>
    </div>

    <!-- Confirm Password -->
    <div class="form-group mb-3">
        <label class="floating-label" for="password_confirmation">Confirmer le nouveau mot de passe</label>
        <input id="password_confirmation" class="form-control"
        type="password"
        name="password_confirmation"/>
    </div>
    <button class="btn btn-block btn-primary mb-4">Réinitialisez</button>

</form>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    var oldInput = <?= json_encode(session()->getOldInput()); ?>;
    console.log(oldInput);
    if (!(oldInput.length === 0)) {
        document.getElementById("email").value = oldInput['email'];
    }

</script>
@endsection
