@extends('layouts.master')

@section('css')
<!-- select2 css -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('title')
| Demandes de devoir
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
                            <h5 class="m-b-10">Demandes de devoir</h5>
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
                        <form method="POST" action="{{ route('devoir.update',$devoir) }}">
                            @csrf
                            @method('PUT')
                            @php
                            date_default_timezone_set("Africa/Abidjan");
                            $date = date("Y-m-d H:i", time());
                            @endphp
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="affectation" id="affectation" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN COURS ---</option>
                                            @foreach ($affectations as $affectation)
                                            <option value="{{$affectation->id}}">{{$affectation->matiere->code_matiere .' - '. $affectation->matiere->nom_matiere.' | '. $affectation->filiere->nom_filiere.' '. $affectation->niveau.' | '. $affectation->professeur->titre.' '. $affectation->professeur->nom.' '. $affectation->professeur->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <select name="salle" id="salle" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UNE FILIERE ---</option>
                                            <option value="{{$devoir->salle->id}}" selected>{{$devoir->salle->nom}}</option>
                                            @foreach ($salles as $salle)
                                            @if ($salle->id !== $devoir->salle->id)
                                            <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="surveillant[]" id="surveillant" class="form-control js-example-responsive" multiple="multiple" data-placeholder="--- SELECTIONNEZ UN SURVEILLANT ---">
                                            @foreach ($surveillants as $surveillant)
                                            <option value="{{$surveillant->id}}">{{$surveillant->nom .' '.$surveillant->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="date">Date et heure<span class="text-c-red">*</span></label>
                                        <input type="text" name="date" class="form-control" id="date" onblur="this.type='text'" onfocus="this.type='datetime-local'" value="{{$devoir->date}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="duree">Durée<span class="text-c-red">*</span></label>
                                        <input type="text" name="duree" class="form-control" id="duree" value="{{$devoir->duree}}">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="row float-right">
                            <div class="col-sm-12">
                                <a name="" id="" class="btn btn-primary" href="{{ route('devoir.index') }}" role="button">Retour</a>
                                <button type="submit" class="btn btn-success">Enregistrez</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDepotSujet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dépot de sijet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('devoir.depot-sujet') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$devoir->id}}">
                    @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d H:i", time());
                    @endphp
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="date_depot_sujet">Date et heure<span class="text-c-red">*</span></label>
                                <input type="text" name="date_depot_sujet" class="form-control" id="date_depot_sujet" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="par">Déposé par<span class="text-c-red">*</span></label>
                                <input type="text" name="sujet_depose_par" class="form-control" id="par">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalPriseSujet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prise du sujet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('devoir.prise-sujet') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$devoir->id}}">
                    @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d H:i", time());
                    @endphp
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="date_prise_sujet">Date et heure<span class="text-c-red">*</span></label>
                                <input type="text" autocomplete="off" name="date_prise_sujet" class="form-control" id="date_prise_sujet" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                                <input type="text" autocomplete="off" name="sujet_pris_par" class="form-control" id="par">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalRenvoiCopieApresCompo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Retour des copies après composition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('devoir.retour-copies') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$devoir->id}}">
                    @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d H:i", time());
                    @endphp
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="date_retour_copie">Date et heure<span class="text-c-red">*</span></label>
                                <input type="text" name="date_retour_copie" class="form-control" id="date_retour_copie" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="par">Renvoyé par<span class="text-c-red">*</span></label>
                                <input autocomplete="off" type="text" name="copie_envoye_par" class="form-control" id="par">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalPriseCopiePourCorrection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prise des copies pour correction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('devoir.prise-copies-prof') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$devoir->id}}">
                    @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d H:i", time());
                    @endphp
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="date_retour_copie">Date et heure<span class="text-c-red">*</span></label>
                                <input autocomplete="off" type="text" name="date_prise_copie_professeur" class="form-control" id="date_prise_copie_professeur" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                                <input autocomplete="off" type="text" name="copie_prise_par" class="form-control" id="par">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalRenvoiCopieApresCorrection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arrivée des copies après correction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('devoir.retour-copie-apres-correction') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$devoir->id}}">
                    @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d H:i", time());
                    @endphp
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="date_retour_copie_apres_correction">Date et heure<span class="text-c-red">*</span></label>
                                <input type="text" name="date_retour_copie_apres_correction" class="form-control" id="date_retour_copie_apres_correction" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                                <input autocomplete="off" type="text" name="copie_retourne_par" class="form-control" id="par">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalPriseCopieEtudiants" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Récupération des copies corrigée</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('devoir.prise-copie-etudiants') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$devoir->id}}">
                    @php
                    date_default_timezone_set("Africa/Abidjan");
                    $date = date("Y-m-d H:i", time());
                    @endphp
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="date_prise_copie_etudiants">Date et heure<span class="text-c-red">*</span></label>
                                <input type="text" name="date_prise_copie_etudiants" class="form-control" id="date_retour_copie_apres_correction" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                                <input autocomplete="off" type="text" name="copie_prise_par_etudiant" class="form-control" id="par">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>






<style>
    .modal-footer{
        border: none;
    }
    .tracking-detail {
        padding:3rem 0
    }
    #tracking {
        margin-bottom:1rem
    }
    [class*=tracking-status-] p {
        margin:0;
        font-size:1.1rem;
        color:#fff;
        text-transform:uppercase;
        text-align:center
    }
    [class*=tracking-status-] {
        padding:1.6rem 0
    }
    .tracking-status-intransit {
        background-color:#3847ce
    }
    .tracking-status-outfordelivery {
        background-color:#f5a551
    }
    .tracking-status-deliveryoffice {
        background-color:#f7dc6f
    }
    .tracking-status-delivered {
        background-color:#4cbb87
    }
    .tracking-status-attemptfail {
        background-color:#b789c7
    }
    .tracking-status-error,.tracking-status-exception {
        background-color:#d26759
    }
    .tracking-status-expired {
        background-color:#616e7d
    }
    .tracking-status-pending {
        background-color:#ccc
    }
    .tracking-status-inforeceived {
        background-color:#214977
    }
    .tracking-list {
        border:1px solid #e5e5e5
    }
    .tracking-item {
        position:relative;
        padding:2rem 1.5rem .5rem 2.5rem;
        font-size:.9rem;
        margin-left:3rem;
        min-height:5rem
    }

    .tracklist-valide{
        border-left:2px solid #17c507;
    }
    .tracklist-encours{
        border-left:2px solid #a0a79f;
    }
    .tracking-item:last-child {
        padding-bottom:4rem
    }
    .tracking-item .tracking-date {
        margin-bottom:.5rem
    }
    .tracking-item .tracking-date span {
        color:#888;
        font-size:85%;
        padding-left:.4rem
    }
    .tracking-item .tracking-content {
        padding:.5rem .8rem;
        background-color:#f4f4f4;
        border-radius:.5rem
    }
    .tracking-item .tracking-content span {
        display:block;
        color:rgb(121, 121, 121);
        font-size:85%
    }
    .tracking-item .tracking-icon {
        line-height:2.6rem;
        position:absolute;
        left:-1.3rem;
        width:2.6rem;
        height:2.6rem;
        text-align:center;
        border-radius:50%;
        font-size:1.1rem;
        background-color:#fff;
        color:#fff
    }
    .tracking-item .tracking-icon.status-sponsored {
        background-color:#f68
    }
    .tracking-item .tracking-icon.status-delivered {
        background-color:#4cbb87
    }
    .tracking-item .tracking-icon.status-outfordelivery {
        background-color:#f5a551
    }
    .tracking-item .tracking-icon.status-deliveryoffice {
        background-color:#f7dc6f
    }
    .tracking-item .tracking-icon.status-attemptfail {
        background-color:#b789c7
    }
    .tracking-item .tracking-icon.status-exception {
        background-color:#d26759
    }
    .tracking-item .tracking-icon.status-inforeceived {
        background-color:#214977
    }
    .tracking-item .tracking-icon.status-intransit {
        color:#e5e5e5;
        border:1px solid #e5e5e5;
        font-size:.6rem
    }
    @media(min-width:992px) {
        .tracking-item {
            margin-left:10rem
        }
        .tracking-item .tracking-date {
            position:absolute;
            left:-10rem;
            width:7.5rem;
            text-align:right
        }
        .tracking-item .tracking-date span {
            display:block
        }
        .tracking-item .tracking-content {
            padding:0;
            background-color:transparent
        }
    }
</style>

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
        document.getElementById("salle").value = oldInput['salle'];
        document.getElementById("date").value = oldInput['date'];
        document.getElementById("surveillant").value = oldInput['surveillant'];
        document.getElementById("duree").value = oldInput['duree'];
    }


</script>
@endsection
