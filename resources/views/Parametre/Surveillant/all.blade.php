@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
@endsection

@section('title')
| Gestion des surveillants
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
                            <h5 class="m-b-10">Gestion des surveillants</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Liste des surveillants</a></li>
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
                                    <th scope="col">Nom</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surveillants as $surveillant)
                                <tr>
                                    <td>{{$surveillant->civilite.' '.$surveillant->nom . ' '. $surveillant->prenom}}</td>
                                    <td><a href="tel:+226{{$surveillant->phone}}">{{$surveillant->phone}}</a></td>
                                    <td><a href="mailto:{{$surveillant->email}}">{{$surveillant->email}}</a></td>
                                    <td class="">
                                        <form action="{{ route('surveillant.destroy', $surveillant)}}" method="POST">
                                            <a class="btn btn-secondary btn-sm" href="{{ route('surveillant.edit',$surveillant) }}"><i class="fas fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm confirm-modal" type="submit" data-name="{{ $surveillant->nom }}"><i class="fas fa-trash"></i></button>
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
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/select.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/dataTables.select.min.js"></script>
        <script src="assets/js/pages/data-autofill-custom.js"></script>
        @include('layouts.confirm-modal')

        @endsection()
