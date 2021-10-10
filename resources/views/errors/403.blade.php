@extends('layouts.master')

@section('main-content')

<!-- [ offline-ui ] start -->
<div class="auth-wrapper bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <img src="{{ asset('assets/images/maintance/403.jpg') }}" alt="" class="img-fluid">
                    <h5 class="text-muted my-4">Oops! Vous n'avez pas les autorisations!</h5>
                    <form action="{{ route('index') }}">
                        <button class="btn waves-effect waves-light btn-primary mb-4"><i class="feather icon-arrow-left mr-2"></i>Retour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

