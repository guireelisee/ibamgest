
@extends('layouts.auth-master')

@section('title')
| Inscription
@endsection

@section('auth-content')

<h3 class="mb-4 f-w-400">Inscription</h3>
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    <!-- Avatar -->
    <div class="container">
        <div class="picture-container">
            <div class="picture">
                <img src="{{Storage::url('avatars/default.png')}}" class="picture-src" id="wizardPicturePreview" title="">
                <input type="file" id="wizard-picture" class="" name="avatar">
            </div>
            <h6 class="mt-1">Avatar</h6>
        </div>
    </div>
    <!-- Role -->
    <div class="form-group mb-3">
        <label class="floating-label" for="name">Rôle</label>
        <select id="role" class="form-control" name="role">
            <option disabled>--- SELECTIONNEZ UN RÔLE ---</option>
            @foreach ($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>
    <!-- Name -->
    <div class="form-group mb-3">
        <label class="floating-label" for="name">Nom d'utilisateur</label>
        <input id="name" class="form-control" type="name" name="name" value=""/>
    </div>
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

    <!-- Confirm Password -->
    <div class="form-group mb-3">
        <label class="floating-label" for="password_confirmation">Confirmer le mot de passe</label>
        <input class="form-control" id="password_confirmation" type="password"
        name="password_confirmation" />
    </div>
    <button class="btn btn-block btn-primary mb-4">S'inscrire</button>

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
        document.getElementById("role").value = oldInput['role'];
        document.getElementById("name").value = oldInput['name'];
        document.getElementById("email").value = oldInput['email'];
    }


</script>
@endsection
