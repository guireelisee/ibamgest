@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
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
                            <li class="breadcrumb-item"><a href="#">Liste des devoirs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ $message }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" data-toggle="modal" data-target="#modalqr" class="btn btn-primary" id="qrcode-button"><i class="fas fa-qrcode"></i></button>
                    </div>
                </div><br>
                <div class="dt-responsive table-responsive">
                    <table id="scroll-fill" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Matière</th>
                                <th scope="col">Professeur</th>
                                <th scope="col">Classe</th>
                                <th scope="col">Salle</th>
                                <th scope="col">Date et heure</th>
                                <th scope="col">Durée</th>
                                <th scope="col">Surveillants</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devoirs as $devoir)
                            <tr>
                                <td>{{$devoir->matiere->nom_matiere}}</td>
                                <td>{{$devoir->professeur->titre . ' '.$devoir->professeur->nom.' '.$devoir->professeur->prenom}}</td>
                                <td>{{$devoir->filiere->nom_filiere . ' ' .$devoir->niveau}}</td>
                                <td>{{$devoir->salle->nom}}</td>
                                <td>{{date('d/m/Y à H:i',strtotime($devoir->date))}}</td>
                                <td>{{$devoir->duree}}</td>
                                <td>
                                    @foreach ($devoir->surveillants as $surveillant)
                                    {{$surveillant->nom . ' '. $surveillant->prenom}}
                                    <br>
                                    @endforeach
                                </td>
                                <td class="">
                                    <form action="{{ route('devoir.destroy', $devoir)}}" method="POST">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('devoir.tracking',$devoir) }}"><i class="fas fa-check"></i></a>

                                        <a class="btn btn-secondary btn-sm" href="{{ route('devoir.edit',$devoir) }}"><i class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm confirm-modal" type="submit" data-name="{{ $devoir->nom }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalqr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tracking par qrcode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="qr" action="{{ route('qrcode.tracking') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="par">QrCode<span class="text-c-red">*</span></label>
                                    <input type="text" autocomplete="off" name="qrcode" class="form-control" id="qrcode">
                                </div>
                            </div>
                        </div><br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <input type="submit" class="btn btn-primary" value="Tracker" id="submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endsection

    @section("javascript")
    @include('layouts.confirm-modal')

    <!-- datatable Js -->
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/plugins/select.bootstrap4.min.js"></script>
    <script src="assets/js/plugins/dataTables.select.min.js"></script>
    <script src="assets/js/pages/data-autofill-custom.js"></script>

    <script src="assets/js/plugins/bootstrap-notify.min.js"></script>
    <script src="assets/js/pages/ac-notification.js"></script>
    <script>

        $( "#qrcode-button").click(function() {
            setTimeout(() => {
                $( "#qrcode" ).focus();
            }, 500);
        });

        $('#qrcode').keyup(function(){
            if(this.value.length == 15){
                $('#submit').click();
            }
        });

    </script>

    @endsection()
