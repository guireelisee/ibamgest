
@extends('layouts.auth-master')

@section('title')
| Inscription
@endsection

@section('auth-content')

<h3 class="mb-4 f-w-400">Inscription</h3>
@if ($message = Session::get('error'))
<div class="card-header">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5>{{ $message }}</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
</div>
@endif
<form method="POST" action="{{ route('user.inscription.save',$user) }}" enctype="multipart/form-data">
    @csrf

    <!-- Avatar -->
    <div class="container">
        <div class="picture-container">
            <div class="picture">
                <img src="{{Storage::url($user->avatar)}}" class="picture-src" id="wizardPicturePreview" title="">
                <input type="file" accept="image/*" id="wizard-picture" class="" name="avatar">
            </div>
            <h6 class="mt-1">Avatar</h6>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="floating-label" for="email">Nom</label>
        <input id="name" class="form-control" type="text" name="name" value="{{$user->name}}"/>
    </div>
    <!-- Email Address -->
    <div class="form-group mb-3">
        <label class="floating-label" for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email" value="{{$user->email}}"/>
    </div>

    <!-- Phone -->
    <div class="mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">(+226)</span>
            </div>
            <input type="text" class="form-control mob_no" id="phone" name="phone" placeholder="Téléphone">
        </div>
    </div>
    <div class="text-center">
        <a name="" id="" class="btn btn-danger mb-4 text-white" href="{{ route('login') }}" role="button">Retour</a>
        <button class="btn btn-primary mb-4">S'inscrire</button>
    </div>

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
        document.getElementById("firstname").value = oldInput['firstname'];
        document.getElementById("name").value = oldInput['name'];
        document.getElementById("email").value = oldInput['email'];
        document.getElementById("phone").value = oldInput['phone'];
    }


</script>
@endsection
