@extends('layouts.master')

@section('main')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oups!</strong> Il y a un problème.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel" style="font-weight: bold">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Enregistrement d'une demande</h5>
            <form action="{{ route('fiche.update', $fiche->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="position-relative row form-group">
                     @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d", time());
                    @endphp
                    <label class="col-sm-2 col-form-label">Date d'arrivée</label>
                    <div class="col-sm-10">
                        <input name="date_arrivee" placeholder="" type="text" class="form-control" value="{{$fiche->date_arrivee}}" max="@php echo $date @endphp" readonly>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Nom de l'expéditeur</label>
                    <div class="col-sm-10">
                        <input name="nom_exp" placeholder="" type="text" class="form-control" value="{{$fiche->nom_exp}}" readonly>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Prénom(s) de l'expéditeur</label>
                    <div class="col-sm-10">
                        <input name="prenom_exp" placeholder="" type="text" class="form-control" value="{{$fiche->prenom_exp}}" readonly>
                    </div>
                </div>

                @if ($fiche->sp_instructions == "")
                    <div class="position-relative row form-group">
                    <label for="exampleSelect" class="col-sm-2 col-form-label">Instructions du SP</label>
                    <div class="col-sm-10">
                        <select name="sp_instructions" class="form-control" name="sp_instructions">
                            <option value="Pour avis du Directeur">Pour avis du Directeur</option>
                            <option value="Pour décision du Directeur" selected>Pour décision du Directeur</option>
                            <option value="Pour l'interessé">Pour l'interessé</option>
                            <option value="Pour Information">Pour Information</option>
                        </select>
                    </div>
                </div>
                @elseif ($fiche->dir_instructions == "")
                    <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Instructions du SP</label>
                    <div class="col-sm-10">
                        <input name="sp_instructions" placeholder="" type="text" class="form-control" value="{{$fiche->sp_instructions}}" readonly>
                    </div>
                </div>

                <div class="position-relative row form-group">
                    <label for="exampleSelect" class="col-sm-2 col-form-label">Instructions du Directeur</label>
                    <div class="col-sm-10">
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
                                {{-- <option value="Pour diffusion">Pour diffusion</option> --}}
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

                @elseif ($fiche->proposition == "")
                    <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Instructions du SP</label>
                    <div class="col-sm-10">
                        <input name="sp_instructions" placeholder="" type="text" class="form-control" value="{{$fiche->sp_instructions}}" readonly>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Instructions du Directeur</label>
                    <div class="col-sm-10">
                        <input name="dir_instructions" placeholder="" type="text" class="form-control" value="{{$fiche->dir_instructions}}" readonly>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Décision de la directrice de la scolarité</label>
                    <div class="col-sm-10">
                        <input name="proposition" placeholder="" type="text" class="form-control">
                    </div>
                </div>
                @endif

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2">
                        <a name="" id="" class="btn btn-danger" href="{{ route('fiche.index') }}" role="button">Retour</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
