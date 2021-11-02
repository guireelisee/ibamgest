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
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ $message }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
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
        @endsection

        @section("javascript")
        @include('layouts.confirm-modal')
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/select.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/dataTables.select.min.js"></script>
        <script src="assets/js/pages/data-autofill-custom.js"></script>

        @endsection()
