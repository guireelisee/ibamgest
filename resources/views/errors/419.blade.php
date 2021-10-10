@extends('layouts.master')

@section('title')
| Site en maintenance
@endsection
@section('main-content')
<!-- [ offline-ui ] start -->
<div class="auth-wrapper offline">
    <div class="offline-wrapper">
        <img src="assets/images/maintance/sparcle-1.png" alt="User-Image" class="img-fluid s-img-1">
        <img src="assets/images/maintance/sparcle-2.png" alt="User-Image" class="img-fluid s-img-2">
        <div class="container on-main">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="text-center">
                        <div class="moon"></div>
                    </div>
                </div>
            </div>
            <div class="row m-0 justify-content-center on-content">
                <div class="col-sm-12 p-0">
                    <div class="text-center">
                        <h1 class="text-white">Page expirée </h1>
                        <form action="{{ route('index') }}">
                            <button class="btn waves-effect waves-light btn-primary mb-4"><i class="feather icon-refresh-ccw mr-2"></i>Rafraîchir</button>
                        </form>
                    </div>
                </div>
                <div class="sark">
                    <img src="assets/images/maintance/sark.svg" alt="" class="img-fluid img-sark">
                    <div class="bubble"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- [ offline-ui ] end -->

    @endsection

