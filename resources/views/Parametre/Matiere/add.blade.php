@extends(' layouts.master')

@section('title')
| Matières
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
                            <h5 class="m-b-10">Paramètres</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Matières</a></li>
                            <li class="breadcrumb-item"><a href="#">Nouvelle matière</a></li>

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
                        <h5>Nouvelle matière</h5>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form id="form" method="post" action="{{ route('matiere.store') }}">
                                @csrf
                                <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nom" class="floating-label">Nom de la matière</label>
                                            <input type="text" class="form-control" value="{{ old('nom') }}" name="nom" id="nom">
                                        </div>
                                      </div>

                                  </div>


                              <div class="modal-footer">
                                  <a type="button" href="{{ route('matiere.index') }}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
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



@endsection()
