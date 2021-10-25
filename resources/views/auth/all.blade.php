@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
@endsection

@section('title')
| Gestion des utilisateurs
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
                            <h5 class="m-b-10">Gestion des utilisateurs</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Grille des utilisateurs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($users as $user)
            @if ($user->id !== Auth::user()->id)
            <div class="col-sm-4">
                <div class="card user-card user-card-1">
                    <div class="card-header border-0 p-2 pb-0">
                        <div class="cover-img-block">
                            <img src="assets/images/widget/slider7.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="user-about-block text-center">
                            <div class="row align-items-end">
                                <div class="col"></div>
                                <div class="col">
                                    <div class="position-relative d-inline-block">
                                        <img class="img-radius img-fluid wid-80" src="{{ asset(Storage::url($user->avatar)) }}" alt="User image">
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h6 class="mb-1 mt-3">{{$user->name}}</h6>
                            <p class="mb-3 text-muted">{{$user->role->name}}</p>
                        </div>
                        <hr class="wid-80 b-wid-3 my-4">
                        <div class="row text-center">
                            <div class="col">
                                <h6 class="mb-1">Email</h6>
                                <p class="mb-0">{{$user->email}}</p>
                            </div>
                            <div class="col">
                                <h6 class="mb-1">Téléphone</h6>
                                <p class="mb-0">{{$user->phone}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body hover-data text-white">
                        <div class="">
                            <h4 class="text-white">Actions</h4>
                            <a href="{{ route('user.edit', $user) }}" role="button">                                <button type="submit" class="btn waves-effect waves-light btn-secondary"><i class="feather icon-edit"></i>&nbsp;Editer</button>
                            </a>                        </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

        </div>
    </div>

    @endsection

    @section("javascript")
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>

    <script>
        $('#user-list-table').DataTable();
    </script>
    @endsection()
