@extends(' layouts.master')

@section('title')
| Demandes
@endsection

@section('main-content')

@include('partials.sidebar')
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
@include('partials.navbar')



<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Demandes d'audience</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Demandes d'audience</a></li>
                            <li class="breadcrumb-item"><a href="#">Nouvelle demande</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
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
                    <div class="card-header">
                        <h5>Nouvelle demande d'audience</h5>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form id="form" method="post" action="{{ route('demande.auth.store') }}">
                                @csrf
                                @php
                                date_default_timezone_set("Africa/Abidjan");
                                $date = date("Y-m-d", time());
                                @endphp
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dateD" class="floating-label">Date demande</label>
                                            <input type="text" class="form-control" value='@php echo $date @endphp' onblur="this.type='text'" onfocus="this.type='date'" name="dateD" id="dateD">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="motif" class="floating-label">Motif</label>
                                            <textarea rows="5"  class="form-control" value="{{ old('motif') }}" name="motif" id="motif"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" href="{{ route('demande.index') }}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
                                    <button type="submit" id="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endsection

        @section("javascript")
        <script>
            var oldInput = <?= json_encode(session()->getOldInput()); ?>;
            console.log(oldInput);
            if (!(oldInput.length === 0)) {
                document.getElementById("dateD").value = oldInput['dateD'];
            }
        </script>


        @endsection()
