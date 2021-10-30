@extends('layouts.master')

@section('main-content')

<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="h-100 d-md-flex align-items-center auth-side-img">
            <div class="col-sm-10 auth-content w-auto">
                {{-- <img src="{{ asset('assets/images/auth/auth-logo.png') }}" alt="" class="img-fluid"> --}}
                {{-- <h4 class="text-white">IBAM<span style="color: red; font-size: 2rem">.</span>GEST</h4> --}}
                <h1 class="text-white my-4">Bienvenue !</h1>
                <h4 class="text-white font-weight-normal">Connectez-vous pour accéder au futur.</h4>
            </div>
        </div>
        <div class="auth-side-form">
            <div class=" auth-content">
                <h4 class="">IBAM<span style="color: #4680ff; font-size: 3rem">.</span>GEST</h4>
                {{-- <img src="{{ asset('assets/images/auth/auth-logo-dark.png') }}" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none"> --}}
                <!-- Session Status -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
                @endif
                @yield('auth-content')
            </div>
        </div>
    </div>
</div>


@endsection
