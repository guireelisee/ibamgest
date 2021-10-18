@extends('layouts.master')

@section('title')
| Dashboard
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
                            <h5 class="m-b-10">Tableau de bord</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <!-- page statustic card start -->
        <div class="row">
            <div class="col-sm-4">
                <a href="{{ route('demande.index') }}">
                    <div class="card statustic-card">
                        <div class="card-body text-center">
                            <h5 class="text-left">Demandes d'audiences</h5>
                            <span class="d-block text-c-blue f-36">{{$audiences['all']}}</span>
                            <p class="m-b-0">Total</p>
                            <div class="progress">
                                <div class="progress-bar bg-c-blue" style="width:56%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue border-0">
                            <h6 class="text-white m-b-0">
                                <span class="float-left"> En attente: {{$audiences['all']}}</span>
                                <span class="float-right"> Terminées: {{$audiences['valider']}}</span>
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('fiche.index') }}">
                    <div class="card statustic-card">
                        <div class="card-body text-center">
                            <h5 class="text-left">Demandes de salles</h5>
                            <span class="d-block text-c-blue f-36">{{$fiches['all']}}</span>
                            <p class="m-b-0">Total</p>
                            <div class="progress">
                                <div class="progress-bar bg-c-blue" style="width:56%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue border-0">
                            <h6 class="text-white m-b-0">
                                <span class="float-left"> En attente: {{$fiches['all']}}</span>
                                <span class="float-right"> Terminées: {{$fiches['valider']}}</span>
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('devoir.index') }}">
                    <div class="card statustic-card">
                        <div class="card-body text-center">
                            <h5 class="text-left">Devoirs</h5>
                            <span class="d-block text-c-blue f-36">{{$audiences['all']}}</span>
                            <p class="m-b-0">Total</p>
                            <div class="progress">
                                <div class="progress-bar bg-c-blue" style="width:56%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue border-0">
                            <h6 class="text-white m-b-0">
                                <span class="float-left"> Programmés: {{$devoirs['all']}}</span>
                                <span class="float-right"> Terminés: {{$audiences['valider']}}</span>
                            </h6>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!-- page statustic card end -->
        <!-- [ Main Content ] end -->

        @endsection
