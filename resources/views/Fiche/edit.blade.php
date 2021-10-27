@extends('layouts.master')

@section('css')
<!-- select2 css -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('title')
| Gestion des salles
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
                            <h5 class="m-b-10">Gestion des salles</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Modification</a></li>
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
                        <form method="POST" action="{{ route('fiche.update', $fiche) }}">
                            @csrf
                            @method('PUT')
                            @php
                            date_default_timezone_set("Africa/Abidjan");
                            $date = date("Y-m-d H:i", time());
                            @endphp

                            @can('secretaire')
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="date_arrivee">Date d'arrivée<span class="text-c-red">*</span></label>
                                        <input type="text" name="date_arrivee" class="form-control" id="date_arrivee" onblur="this.type='text'" onfocus="this.type='datetime-local'" value="{{$fiche->date_arrivee}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="nom_exp">Nom de l'expéditeur<span class="text-c-red">*</span></label>
                                        <input type="text" name="nom_exp" class="form-control" id="nom_exp" value="{{$fiche->nom_exp}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="prenom_exp">Prénom(s) de l'expéditeur<span class="text-c-red">*</span></label>
                                        <input type="text" name="prenom_exp" class="form-control" id="prenom_exp" value="{{$fiche->prenom_exp}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <div class="form-group">
                                        <select name="salle" id="salle" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UNE SALLE ---</option>
                                            <option value="{{$fiche->salle->id}}" selected>{{$fiche->salle->nom}}</option>
                                            @foreach ($salles as $salle)
                                            @if ($salle->id !== $fiche->salle->id)
                                            <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="motif">Motif<span class="text-c-red">*</span></label>
                                        <input type="text" name="motif" class="form-control" id="motif" value="{{$fiche->motif}}">
                                    </div>
                                </div>
                            </div>
                            @endcan

                            @cannot('secretaire')
                            <div class="col-md-12 mb-3">
                                <div class="table-responsive table-border-style">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Expéditeur</th>
                                                <th>Date d'arrivée</th>
                                                <th>Salle</th>
                                                <th>Motif</th>
                                                @if (!empty($fiche->sp))
                                                <th>Secretaire Permanent</th>
                                                @endif
                                                @if (!empty($fiche->dir))
                                                <th>Directeur</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$fiche->nom_exp . ' ' . $fiche->prenom_exp}}</td>
                                                <td>{{date('d/m/Y H:i', strtotime($fiche->date_arrivee))}}</td>
                                                <td>{{$fiche->salle->nom}}</td>
                                                <td>{{$fiche->motif}}</td>
                                                @if (!empty($fiche->sp))
                                                <th>{{$fiche->sp}}</th>
                                                @endif
                                                @if (!empty($fiche->dir))
                                                <th>{{$fiche->dir}}</th>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endcannot

                            @can('secretaire_permanent')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select class="form-control js-example-basic-single" name="sp">
                                        <option disabled>--- SELECTIONNEZ UNE INSTRUCTION ---</option>
                                        <option value="Pour avis du Directeur">Pour avis du Directeur</option>
                                        <option value="Pour décision du Directeur" selected>Pour décision du Directeur</option>
                                        <option value="Pour l'interessé">Pour l'interessé</option>
                                        <option value="Pour Information">Pour Information</option>
                                    </select>
                                </div>
                            </div>
                            @endcan

                            @can('directeur')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select name="dir" class="form-control js-example-basic-single" name="dir">
                                        <option disabled>--- SELECTIONNEZ UNE INSTRUCTION ---</option>
                                        <optgroup label="Remettre au SP">
                                            <option value="Remettre au SP pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Remettre au SP pour étude">Pour étude</option>
                                            <option value="Remettre au SP pour diffusion">Pour diffusion</option>
                                            <option value="Remettre au SP pour avis">Pour avis</option>
                                            <option value="Remettre au SP pour suivi">Pour suivi</option>
                                            <option value="Remettre au SP pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre au DA">
                                            <option value="Remettre au DA pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Remettre au DA pour étude">Pour étude</option>
                                            <option value="Remettre au DA pour diffusion">Pour diffusion</option>
                                            <option value="Remettre au DA pour avis">Pour avis</option>
                                            <option value="Remettre au DA pour suivi">Pour suivi</option>
                                            <option value="Remettre au DA pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre aux Coordonnateurs">
                                            <option value="Remettre aux Coordonnateurs pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Remettre aux Coordonnateurs pour étude">Pour étude</option>
                                            <option value="Remettre aux Coordonnateurs pour diffusion">Pour diffusion</option>
                                            <option value="Remettre aux Coordonnateurs pour avis">Pour avis</option>
                                            <option value="Remettre aux Coordonnateurs pour suivi">Pour suivi</option>
                                            <option value="Remettre aux Coordonnateurs pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre au CSAF">
                                            <option value="Remettre au CSAF pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Remettre au CSAF pour étude">Pour étude</option>
                                            <option value="Remettre au CSAF pour diffusion">Pour diffusion</option>
                                            <option value="Remettre au CSAF pour avis">Pour avis</option>
                                            <option value="Remettre au CSAF pour suivi">Pour suivi</option>
                                            <option value="Remettre au CSAF pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre à la Scolarité">
                                            <option value="Remettre à la Scolarité pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Remettre à la Scolarité pour vérification">Pour vérification</option>
                                            <option value="Remettre à la Scolarité pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Le sécrétaire">
                                            <option value="Au sécrétaire pour traitement">Pour traitement</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            @endcan

                            @can('scolarite')
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <select class="form-control" name="valide" id="valide">
                                                <option disabled>--- SELECTIONNEZ UNE DECISION ---</option>
                                                <option value="accorde">Salle accordée</option>
                                                <option value="reffuse">Demande réjettée</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label class="floating-label" for="scolarite">Décision de la directrice de la scolarité<span class="text-c-red">*</span></label>
                                            <input type="text" name="scolarite" class="form-control" id="scolarite" value="{{$fiche->scolarite}}">
                                        </div>
                                    </div>
                                </div>
                            @endcan


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
                    document.getElementById("date_arrivee").value = oldInput['date_arrivee'];
                    document.getElementById("nom_exp").value = oldInput['nom_exp'];
                    document.getElementById("prenom_exp").value = oldInput['prenom_exp'];
                }


            </script>
            @endsection
