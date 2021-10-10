@extends('layouts.master')

@section('title')
| Dashboard
@endsection

@section('main-content')

<!-- [ navigation menu ] start -->
@include('partials.sidebar')
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
        <a href="#" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="assets/images/logo.png" alt="" class="logo">
        </a>
        <a href="#" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Recherchez ici ...">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                        </div>
                        <ul class="noti-body">
                            <li class="n-title">
                                <p class="m-b-0">Nouveau</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                        <p>New ticket Added</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="noti-footer">
                            <a href="#">show all</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{Storage::url(Auth::user()->avatar)}}" class="img-radius" alt="User-Profile-Image">
                            <span>{{ Auth::user()->name }}</span>
                            {{-- <span>{{ Auth::user()->role->name }}</span> --}}
                        </div>
                        <ul class="pro-body">
                            <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Mon profil</a></li>
                            <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> Mes messages</a></li>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf<li><a href="route('logout')" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();"><i class="feather icon-lock"></i> Verrouiller</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>


</header>
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
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
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
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-yellow">$30200</h4>
                                <h6 class="text-muted m-b-0">All Earnings</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-bar-chart-2 f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-yellow">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-green">290+</h4>
                                <h6 class="text-muted m-b-0">Page Views</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-file-text f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-green">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-red">145</h4>
                                <h6 class="text-muted m-b-0">Task</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-calendar f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-red">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-down text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">500</h4>
                                <h6 class="text-muted m-b-0">Downloads</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-thumbs-down f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-down text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page statustic card end -->
        <!-- [ Main Content ] end -->

        @endsection
