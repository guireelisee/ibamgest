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
                            <li class="breadcrumb-item"><a href="#">Instructions</a></li>
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
                        <form method="POST" action="{{ route('fiche.update', $fiche->id) }}">
                            @csrf
                            @method('PUT')
                            @php
                            date_default_timezone_set("Africa/Abidjan");
                            $date = date("Y-m-d", time());
                            @endphp

                            <div class="col-md-12 mb-3">
                                <div class="table-responsive table-border-style">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Expéditeur</th>
                                                <th>Date d'arrivée</th>
                                                @if (!empty($fiche->sp_instructions))
                                                <th>Secretaire Permanent</th>
                                                @endif
                                                @if (!empty($fiche->dir_instructions))
                                                <th>Directeur</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$fiche->nom_exp . ' ' . $fiche->prenom_exp}}</td>
                                                <td>{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</td>
                                                @if (!empty($fiche->sp_instructions))
                                                <th>{{$fiche->sp_instructions}}</th>
                                                @endif
                                                @if (!empty($fiche->dir_instructions))
                                                <th>{{$fiche->dir_instructions}}</th>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @can('secretaire_permanent')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" class="floating-label">Instructions du Sécrétaire Permanent</label>
                                    <select class="form-control" name="sp_instructions">
                                        <option value="" disabled>--- SELECTIONNEZ UNE INSTRUCTION ---</option>
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
                                    <label for="" class="floating-label">Instructions du Directeur</label>
                                    <select name="dir_instructions" class="form-control" name="dir_instructions">
                                        <optgroup label="Remettre à SP">
                                            <option value="Pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Pour étude">Pour étude</option>
                                            <option value="Pour diffusion">Pour diffusion</option>
                                            <option value="Pour avis">Pour avis</option>
                                            <option value="Pour suivi">Pour suivi</option>
                                            <option value="Pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre au DA">
                                            <option value="Pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Pour étude">Pour étude</option>
                                            <option value="Pour diffusion">Pour diffusion</option>
                                            <option value="Pour avis">Pour avis</option>
                                            <option value="Pour suivi">Pour suivi</option>
                                            <option value="Pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre aux Coordonnateurs">
                                            <option value="Pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Pour étude">Pour étude</option>
                                            <option value="Pour diffusion">Pour diffusion</option>
                                            <option value="Pour avis">Pour avis</option>
                                            <option value="Pour suivi">Pour suivi</option>
                                            <option value="Pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre au CSAF">
                                            <option value="Pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Pour étude">Pour étude</option>
                                            <option value="Pour diffusion">Pour diffusion</option>
                                            <option value="Pour avis">Pour avis</option>
                                            <option value="Pour suivi">Pour suivi</option>
                                            <option value="Pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Remettre à la Scolarité">
                                            <option value="Pour nécessaire à faire">Pour nécessaire à faire</option>
                                            <option value="Pour vérification">Pour vérification</option>
                                            <option value="Pour information">Pour information</option>
                                        </optgroup>
                                        <optgroup label="Le sécrétaire">
                                            <option value="Pour traitement">Pour traitement</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            @endcan

                            @can('scolarite')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="proposition">Décision de la directrice de la scolarité</label>
                                    <input type="text" name="proposition" class="form-control" id="proposition" value="{{$fiche->proposition}}">
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
