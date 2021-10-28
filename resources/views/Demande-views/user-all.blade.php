@extends(' layouts.master')
@section('css')
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
@endsection
@section('title')
| Demandes
@endsection


@section('main-content')

@include('partials.sidebar')
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
@include('partials.navbar')



<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Demandes d'audience</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Demandes d'audience</a></li>
                            <li class="breadcrumb-item"><a href="#">Liste des audiences</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($demandes as $demande)
                <div class="col-md-4">
                    <div class="card user-card user-card-1">
                        <div class="card-header border-0 p-2 pb-0">
                            <div class="cover-img-block" style="text-align: center">
                                <img src="{{asset('assets/images/demande.png')}}" width="55px" alt="" class="img-fluid">
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <h6>Demande soumis le : <span style="color: rgb(131, 131, 131)">{{date('d/m/Y', strtotime($demande->date_demande))}}</span> </h6>
                            <h6>Motif :<span style="color: rgb(131, 131, 131)">{{ $demande->motif }}</span></h6>
                            <h6>Date de l'audience :
                                @if ($demande->date_audience === null)
                                -
                                @else
                                <span style="color: rgb(131, 131, 131)">{{date('d/m/Y', strtotime($demande->date_audience))}} à {{date('H:i', strtotime($demande->heure_audience))}}</span>

                                @endif
                            </h6>

                            @if ($demande->decision === 1 || $demande->decision === true)
                                <button class="btn btn-block btn-success">Audience accordée</button>
                            @endif
                            @if ($demande->decision === 0 || $demande->decision === false)
                                <button class="btn btn-block btn-danger">Audience refusée</button>
                            @endif
                            @if ($demande->decision === null)
                                <button class="btn btn-block btn-warning">En attente de reponse</button>
                            @endif

                        </div>

                        <div class="card-body hover-data text-white">
                            <div class="">
                                <h4 class="text-white">Actions</h4>

                                @if ($demande->decision === null)

                                    <a href="{{ route('demande.suppression.view', ['id'=>$demande->idDemande]) }}" role="button">
                                        <button type="submit" class="btn waves-effect waves-light btn-secondary"><i class="feather icon-delete"></i>&nbsp;Supprimer</button>
                                    </a>
                                @endif


                            </div>
                        </div>
                    </div>





                </div>


            @endforeach

            <div class="card user-card user-card-1">
                <br>

        </div>




@endsection


@section("javascript")


   <!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></>
<script src="assets/js/plugins/select.bootstrap4.min.js"></script>
<script src="assets/js/plugins/dataTables.select.min.js"></script>
<script src="assets/js/pages/data-autofill-custom.js"></script>

<script src="assets/js/plugins/bootstrap-notify.min.js"></script>
<script src="assets/js/pages/ac-notification.js"></script>

@endsection()
