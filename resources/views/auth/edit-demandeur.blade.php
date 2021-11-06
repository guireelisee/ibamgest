
@extends('layouts.master')

@section('title')
| Edition
@endsection

@section('main-content')
<div class="auth-wrapper">
    <div class="blur-bg-images"></div>
    <div class="auth-content">
        <div class="card">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            @endif
            <form method="POST" action="{{ route('demandeur.update',$user) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body text-center">
                    <h4 class="">IBAM<span style="color: #4680ff; font-size: 3rem">.</span>GEST</h4>
                    <input id="name" class="form-control" type="text" name="name" value="{{$user->name}}" hidden/>
                    <input id="role" class="form-control" type="text" name="role" value="{{$user->role->id}}" hidden/>
                    <input id="password" class="form-control" type="password" name="password" value="{{$user->password}}" hidden/>
                    <input id="email" class="form-control" type="email" name="email"  value="{{$user->email}}" hidden/>
                    <!-- Phone -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">(+226)</span>
                            </div>
                            <input type="text" class="form-control mob_no" id="phone" name="phone" placeholder="Téléphone"  value="{{$user->phone}}">
                        </div>
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

                    <div class="mt-4">
                        {{-- <a name="" id="" class="btn btn-danger mb-4 text-white" href="{{ route('user.index') }}" role="button">Retour</a> --}}
                        <button type="submit" class="btn  btn-primary mb-4">Enregistrez</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- [ profile-settings ] end -->
</div>

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
        document.getElementById("phone").value = oldInput['phone'];
    }


</script>
@endsection
