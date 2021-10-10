@extends('layouts.master')

@section('title')
    | Site en maintenance
@endsection
@section('main-content')
<!-- [ offline-ui ] start -->
<div class="auth-wrapper maintance">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <img src="assets/images/maintance/maintance.png" alt="" class="img-fluid">
                    <h5 class="text-muted my-4">Application en maintenance, repassez plus tard !</h5>
                    <form action="{{ route('index') }}">
                        <button class="btn waves-effect waves-light btn-primary mb-4"><i class="feather icon-refresh-ccw mr-2"></i>Rafraîchir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

