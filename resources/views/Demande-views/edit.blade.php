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
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Demandes d'audience</a></li>
                            <li class="breadcrumb-item"><a href="#">Modification d'une demande </a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Nouvelle demande d'audience</h5>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{route('demande.update')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$demande[0]->idDemande}}" name="idDemande">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="dateR" class="floating-label">Date réponse</label>
                                              <input type="text" readonly value="{{$demande[0]->date_reponse}}" class="form-control" onblur="this.type='text'" onfocus="this.type='date'" name="dateR" id="dateR">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="dateA" class="floating-label">Date audience</label>
                                              <input type="text" readonly value="{{$demande[0]->date_audience}}" class="form-control" onblur="this.type='text'" onfocus="this.type='date'" name="dateA" id="dateA">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="heureA" class="floating-label">Heure audience</label>
                                              <input type="text" readonly value="{{$demande[0]->heure_audience}}" class="form-control" onblur="this.type='text'" onfocus="this.type='time'" name="heureA" id="heureA">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nom" class="floating-label">Nom</label>
                                                <input type="text"  value="{{$demande[0]->nomDemandeur}}" class="form-control" name="nom" id="nom">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="prenom" class="floating-label">Prénom (s)</label>
                                                <input type="text"  value="{{$demande[0]->prenomDemandeur}}" class="form-control" name="prenom" id="prenom">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="tel" class="floating-label">Téléphone</label>
                                                <input type="tel"  value="{{$demande[0]->tel}}" class="form-control" name="tel" id="tel">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="service" class="floating-label">Adresse/Service</label>
                                                <input type="service"  value="{{$demande[0]->service}}" class="form-control" name="service" id="service">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="prof" class="floating-label">Profession</label>
                                                <input type="text" value="{{$demande[0]->profession}}" class="form-control" name="prof" id="prof">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="dateD" class="floating-label">Date demande</label>
                                                <input type="text" class="form-control"  value="{{$demande[0]->date_demande}}" onblur="this.type='text'" onfocus="this.type='date'" name="dateD" id="dateD">
                                              </div>
                                          </div>

                                          <div class="col-md-12">
                                              <div class="form-group">
                                                <label for="motif" class="floating-label">Motif</label>
                                                <textarea rows="5" class="form-control" name="motif" id="motif">
                                                    {{$demande[0]->motif}}
                                                </textarea>
                                              </div>
                                          </div>

                                      </div>


                                  <div class="modal-footer">
                                    <a type="button" href="{{ route('demande.index') }}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
                                      <button type="submit" id="submit" class="btn btn-primary">Valider</button>
                                  </div>
                                    </div>
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
