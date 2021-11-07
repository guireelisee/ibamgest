@extends('layouts.master')

@section('title')
| Demandes de salle
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
                            <h5 class="m-b-10">Demandes de salle</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Enregistrement d'une demande</a></li>
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
                    @if ($message = Session::get('error'))
                        <div class="card-header">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <h5>{{ $message }}</h5>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('fiche.store') }}">
                            @csrf
                            @php
                            date_default_timezone_set("Africa/Abidjan");
                            $date = date("Y-m-d H:i", time());
                            @endphp
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="date_arrivee">Date d'arrivée<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="date_arrivee" class="form-control" id="date_arrivee" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="nom_exp">Nom de l'expéditeur<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="nom_exp" class="form-control" id="nom_exp">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="prenom_exp">Prénom(s) de l'expéditeur<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="prenom_exp" class="form-control" id="prenom_exp">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">(+226)</span>
                                        </div>
                                        <input type="text" class="form-control mob_no" id="phone" name="phone" placeholder="Téléphone (*)">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="prenom_exp">Salle<span class="text-c-red">&nbsp*</span></label>
                                        <select name="salle" id="" class="form-control">
                                            <option value="" disabled>--- SELECTIONNEZ UNE SALLE ---</option>
                                            @foreach ($salles as $salle)
                                            <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="motif">Motif<span class="text-c-red">&nbsp*</span></label>
                                        <select name="motif" id="motif" class="form-control" onchange="changeFunc()">
                                            <option value="" disabled>--- SELECTIONNEZ UN MOTIF ---</option>
                                            <option value="Pour une formation">Pour une formation</option>
                                            <option value="Pour une conférence">Pour une conférence</option>
                                            <option value="Pour un cours">Pour un cours</option>
                                            <option value="autre" id="autre">Autre ( à préciser)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4" id="autreMotif" style="display: none">
                                    <div class="form-group">
                                        <label class="floating-label" for="motif">Motif<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="motif" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="date_debut_occupation">Date et heure de début d'occupation<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="date_debut_occupation" class="form-control" id="date_debut_occupation" value="" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="date_fin_occupation">Date et heure de fin d'occupation<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="date_fin_occupation" class="form-control" id="date_fin_occupation" value="" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-sm-12">
                                    <a name="" id="" class="btn btn-primary" href="{{ route('fiche.index') }}" role="button">Retour</a>
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
<script>
    function changeFunc() {
        var selectBox = document.getElementById("motif");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if (selectedValue == "autre") {
            $('#autreMotif').show();
        } else {
            $('#autreMotif').hide();
        }
    }

    var oldInput = <?= json_encode(session()->getOldInput()); ?>;
    console.log(oldInput);
    if (!(oldInput.length === 0)) {
        document.getElementById("date_arrivee").value = oldInput['date_arrivee'];
        document.getElementById("nom_exp").value = oldInput['nom_exp'];
        document.getElementById("prenom_exp").value = oldInput['prenom_exp'];
        document.getElementById("motif").value = oldInput['motif'];
        document.getElementById("phone").value = oldInput['phone'];
    }

</script>
@endsection
