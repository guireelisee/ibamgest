@extends('layouts.master')

@section('css')
<!-- select2 css -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('title')
| Gestion des devoirs
@endsection

@section('main-content')
<!-- [ navigation menu ] start -->
@include('partials.sidebar')
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
@include('partials.navbar')
<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Gestion des devoirs</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Enregistrement d'un devoir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @if ($errors->any())
                    <div class="card-header">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oups!</strong> Il y a un problème.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('devoir.store') }}">
                            @csrf
                            @php
                            date_default_timezone_set("Africa/Abidjan");
                            $date = date("Y-m-d H:i", time());
                            @endphp
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="matiere" id="matiere" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE MATIERE ---</option>
                                            @foreach ($matieres as $matiere)
                                            <option value="{{$matiere->id}}">{{$matiere->nom_matiere}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="professeur" id="professeur" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN PROFESSEUR ---</option>
                                            @foreach ($professeurs as $professeur)
                                            <option value="{{$professeur->id}}">{{$professeur->nom.' '.$professeur->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="filiere" id="filiere" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE FILIERE ---</option>
                                            @foreach ($filieres as $filiere)
                                            <option value="{{$filiere->id}}">{{$filiere->nom_filiere}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="niveau" id="niveau" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN NIVEAU ---</option>
                                            <option value="Licence I">Licence I</option>
                                            <option value="Licence II">Licence II</option>
                                            <option value="Licence III">Licence III</option>
                                            <option value="Master I">Master I</option>
                                            <option value="Master II">Master II</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="salle" id="salle" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE SALLE ---</option>
                                            @foreach ($salles as $salle)
                                            <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="surveillant[]" id="surveillant" class="form-control js-example-responsive" multiple="multiple" data-placeholder="--- SELECTIONNEZ UN SURVEILLANT ---">
                                            @foreach ($surveillants as $surveillant)
                                            <option value="{{$surveillant->id}}">{{$surveillant->nom .' '.$surveillant->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="date">Date et heure<span class="text-c-red">*</span></label>
                                        <input type="text" name="date" class="form-control" id="date" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="duree">Durée<span class="text-c-red">*</span></label>
                                        <input type="text" name="duree" class="form-control" id="duree">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="code">Code<span class="text-c-red">*</span></label>
                                        <input type="text" name="code" class="form-control" id="code">
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-sm-12">
                                    <a name="" id="" class="btn btn-primary" href="{{ route('devoir.index') }}" role="button">Retour</a>
                                    <button type="submit" class="btn btn-success">Enregistrez</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<!-- select2 Js -->
<script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
<!-- form-select-custom Js -->
<script src="{{ asset('assets/js/pages/form-select-custom.js') }}"></script>
<script>
    var oldInput = <?= json_encode(session()->getOldInput()); ?>;
    console.log(oldInput);
    if (!(oldInput.length === 0)) {
        document.getElementById("matiere").value = oldInput['matiere'];
        document.getElementById("professeur").value = oldInput['professeur'];
        document.getElementById("filiere").value = oldInput['filiere'];
        document.getElementById("niveau").value = oldInput['niveau'];
        document.getElementById("salle").value = oldInput['salle'];
        document.getElementById("date").value = oldInput['date'];
        document.getElementById("surveillant").value = oldInput['surveillant'];
        document.getElementById("duree").value = oldInput['duree'];
        document.getElementById("code").value = oldInput['code'];
    }


</script>
@endsection
