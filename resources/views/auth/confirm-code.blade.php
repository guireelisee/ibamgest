
@extends('layouts.auth-master')

@section('title')
| Inscription
@endsection

@section('auth-content')

<h5 class="mb-4 f-w-400">Saisissez le code qui vous a été envoyé par SMS</h5>
<form method="POST" onsubmit="onSubmit(event)" action="{{ route('user.inscription.verifier-code') }}" enctype="multipart/form-data">
    @csrf
    @if ($request->role->id !== 6 && !empty($request->avatar))
    <input type="hidden" name="avatar" value="{{$request->avatar->extension()}}">
    @endif
    <input type="hidden" name="email" value="{{$request->email}}">
    <input type="hidden" name="name" value="{{$request->name}}">
    <input type="hidden" name="firstname" value="{{$request->firstname}}">

    <input type="hidden" name="phone" value="{{$request->phone}}">
    <input type="hidden" name="password" value="{{$request->password}}">

    <input type="hidden" name="code_envoye" value="{{$code}}" id="code-envoye">
    <input type="hidden" name="code_saisie" id="code-saisie">
    <div class="row" style=" width: 100%; margin: auto;">
        <div class="form-group">
            <input name='code' style="width: 60px; margin-right: 7px" class="form-control code-input" required/>
        </div>
        <div class="form-group">
            <input name='code' style="width: 60px; margin-right: 7px" class="form-control code-input" required/>
        </div>
        <div class="form-group">
            <input name='code' style="width: 60px; margin-right: 7px" class="form-control code-input" required/>
        </div>
        <div class="form-group">
            <input name='code' style="width: 60px; margin-right: 7px" class="form-control code-input" required/>
        </div>

    </div>
    <div class="float-left">
        <button type="submit" class="btn btn-primary mb-4">Verifier</button>
    </div>

</form>

<style>

    .code-input{
        border: 1px solid rgb(129, 129, 129);
        box-shadow: 2px;
        text-align: center;
    }


</style>

@endsection

@section('javascript')
<script src="assets/js/plugins/sweetalert.min.js"></script>

<script>
    const inputElements = [...document.querySelectorAll('input.code-input')]

    inputElements.forEach((ele,index)=>{
        ele.addEventListener('keydown',(e)=>{
            if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
        })
        ele.addEventListener('input',(e)=>{
            const [first,...rest] = e.target.value
            e.target.value = first ?? ''
            if(index!==inputElements.length-1 && first!==undefined) {
                inputElements[index+1].focus()
                inputElements[index+1].value = rest.join('')
                inputElements[index+1].dispatchEvent(new Event('input'))
            }
        })

    })


    function onSubmit(e){
        var code = '';
        const inputElements = [...document.querySelectorAll('input.code-input')]
        inputElements.forEach(element => {
            code = code + '' +element.value;
        });
        const inputOfCode = document.querySelector('#code-saisie').value = code;
        console.log(document.querySelector('#code-saisie').value)

        if (inputOfCode !== document.querySelector('#code-envoye').value) {
            e.preventDefault();
            swal({
                title: 'Erreur',
                text: 'Code invalide !',
                icon: 'error',
                buttons: true,
                dangerMode: true,
            })
        }


    }
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
