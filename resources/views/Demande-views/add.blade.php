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
                            <form id="form" method="post" action="{{ route('demande.store') }}">
                                @csrf
                                <div class="row">

                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nom" class="floating-label">Nom</label>
                                            <input type="text" class="form-control" value="{{ old('nom') }}" name="nom" id="nom">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="prenom" class="floating-label">Prénom (s)</label>
                                            <input type="text" class="form-control" value="{{ old('prenom') }}"  name="prenom" id="prenom">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="tel" class="floating-label">Téléphone</label>
                                            <input type="tel" class="form-control" value="{{ old('tel') }}"  name="tel" id="tel">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="service" class="floating-label">Adresse/Service</label>
                                            <input type="service" class="form-control" value="{{ old('service') }}"  name="service" id="service">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="prof" class="floating-label">Profession</label>
                                            <input type="text" class="form-control" value="{{ old('prof') }}"  name="prof" id="prof">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="dateD" class="floating-label">Date demande</label>
                                            <input type="text" class="form-control" value="{{ old('dateD') }}"  onblur="this.type='text'" onfocus="this.type='date'" name="dateD" id="dateD">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="dateR" class="floating-label">Date réponse</label>
                                            <input type="text" readonly class="form-control" onblur="this.type='text'" onfocus="this.type='date'" name="dateR" id="dateR">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="dateA" class="floating-label">Date audience</label>
                                            <input type="text" readonly class="form-control" onblur="this.type='text'" onfocus="this.type='date'" name="dateA" id="dateA">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="heureA" class="floating-label">Heure audience</label>
                                            <input type="text" readonly class="form-control" onblur="this.type='text'" onfocus="this.type='time'" name="heureA" id="heureA">
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



@endsection()
