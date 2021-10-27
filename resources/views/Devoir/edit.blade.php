@extends('layouts.master')

@section('css')
<!-- select2 css -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('title')
| Demandes de devoir
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
                            <h5 class="m-b-10">Demandes de devoir</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Modification</a></li>
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
                    <div class="card-body">
                        <form method="POST" action="{{ route('devoir.update',$devoir) }}">
                            @csrf
                            @method('PUT')
                            @php
                            date_default_timezone_set("Africa/Abidjan");
                            $date = date("Y-m-d H:i", time());
                            @endphp
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="matiere" id="matiere" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UNE MATIERE ---</option>
                                            <option value="{{$devoir->matiere->id}}" selected>{{$devoir->matiere->nom_matiere}}</option>
                                            @foreach ($matieres as $matiere)
                                            @if ($matiere->id !== $devoir->matiere->id)
                                            <option value="{{$matiere->id}}">{{$matiere->nom_matiere}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="professeur" id="professeur" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UN PROFESSEUR ---</option>
                                            <option value="{{$devoir->professeur->id}}" selected>{{$devoir->professeur->nom .' '. $devoir->professeur->prenom}}</option>
                                            @foreach ($professeurs as $professeur)
                                            @if ($professeur->id !== $devoir->professeur->id)
                                            <option value="{{$professeur->id}}">{{$professeur->nom.' '.$professeur->prenom}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="filiere" id="filiere" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UNE FILIERE ---</option>
                                            <option value="{{$devoir->filiere->id}}" selected>{{$devoir->filiere->nom_filiere}}</option>
                                            @foreach ($filieres as $filiere)
                                            @if ($filiere->id !== $devoir->filiere->id)
                                            <option value="{{$filiere->id}}">{{$filiere->nom_filiere}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="niveau" id="niveau" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UN NIVEAU ---</option>
                                            <option value="{{$devoir->niveau}}" selected>{{$devoir->niveau}}</option>
                                            @foreach ($niveaux as $niveau)
                                            @if ($niveau !== $devoir->niveau)
                                            <option value="{{$niveau}}">{{$niveau}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="salle" id="salle" class="form-control js-example-basic-single">
                                            <option disabled>--- SELECTIONNEZ UNE FILIERE ---</option>
                                            <option value="{{$devoir->salle->id}}" selected>{{$devoir->salle->nom}}</option>
                                            @foreach ($salles as $salle)
                                            @if ($salle->id !== $devoir->salle->id)
                                            <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="surveillant[]" id="surveillant" class="form-control js-example-responsive" multiple="multiple" data-placeholder="--- SELECTIONNEZ UN SURVEILLANT ---">
                                            @foreach ($surveillants as $surveillant)
                                            <option value="{{$surveillant->id}}">{{$surveillant->nom .' '.$surveillant->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="date">Date et heure<span class="text-c-red">*</span></label>
                                        <input type="text" name="date" class="form-control" id="date" onblur="this.type='text'" onfocus="this.type='datetime-local'" value="{{$devoir->date}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="duree">Durée<span class="text-c-red">*</span></label>
                                        <input type="text" name="duree" class="form-control" id="duree" value="{{$devoir->duree}}">
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div id="accordion">
                            @if ($devoir->date_depot_sujet == null || $devoir->date_prise_sujet == null || $devoir->date_retour_copie == null || $devoir->date_prise_copie_professeur == null || $devoir->date_retour_copie_apres_correction == null || $devoir->date_prise_copie_etudiants == null)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      Actions
                                    </button>
                                  </h5>
                                </div>
  
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body">
                                      @if ($devoir->date_depot_sujet == null)
                                          <button type="button" data-toggle="modal" data-target="#modalDepotSujet" class="btn btn-success">Dépot du sujet</button>
                                      @endif
                                      @if ($devoir->date_depot_sujet != null && $devoir->date_prise_sujet == null)
                                          <button type="button" data-toggle="modal" data-target="#modalPriseSujet" class="btn btn-success">Prise des sujets pour composition</button>
                                      @endif
                                      @if ($devoir->date_prise_sujet != null && $devoir->date_retour_copie == null)
                                          <button type="button" data-toggle="modal" data-target="#modalRenvoiCopieApresCompo" class="btn btn-success">Renvoi des copies après composition</button>
                                      @endif
                                      @if ($devoir->date_retour_copie != null && $devoir->date_prise_copie_professeur == null)
                                          <button type="button" data-toggle="modal" data-target="#modalPriseCopiePourCorrection" class="btn btn-success">Prise des copies pour correction</button>
                                      @endif
                                      @if ($devoir->date_prise_copie_professeur != null && $devoir->date_retour_copie_apres_correction == null)
                                          <button type="button" data-toggle="modal" data-target="#modalRenvoiCopieApresCorrection" class="btn btn-success">Retour des copies après correction</button>
                                      @endif
                                      @if ($devoir->date_retour_copie_apres_correction != null && $devoir->date_prise_copie_etudiants == null)
                                          <button type="button" data-toggle="modal" data-target="#modalPriseCopieEtudiants" class="btn btn-success">Prise des copies par les étudiants</button>
                                      @endif
  
                                  </div>
                                </div>
                              </div>
                            @endif
                            
                          </div>
                          <div class="container">
                            <h2>Tracking</h2>
                           <div class="row">

                              <div class="col-md-12 col-lg-12">
                                 <div id="tracking-pre"></div>
                                 <div id="tracking">
                                    <div class="text-center tracking-status-intransit">
                                       <p class="tracking-status text-tight">Mouvements liés au devoir</p>
                                    </div>
                                    <div class="tracking-list">
                                       
                                          
                                            @if ($devoir->date_prise_copie_etudiants != null)
                                                <div class="tracking-item tracklist-valide">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/validation.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">{{date('d/m/Y',strtotime($devoir->date_prise_copie_etudiants))}}<span>{{date('H:i',strtotime($devoir->date_prise_copie_etudiants))}}</span></div>
                                                        <div class="tracking-content">COPIES RETOURNEES AUX ETUDIANTS<span>Copies remis à : {{$devoir->copie_prise_par_etudiant}} </span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_retour_copie_apres_correction != null && $devoir->date_prise_copie_etudiants == null)
                                                <div class="tracking-item tracklist-encours">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/pending.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">En attente</span></div>
                                                        <div class="tracking-content">COPIES RETOURNEES AUX ETUDIANTS<span>En attente</span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_retour_copie_apres_correction != null)
                                                <div class="tracking-item tracklist-valide">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/validation.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">{{date('d/m/Y',strtotime($devoir->date_retour_copie_apres_correction))}}<span>{{date('H:i',strtotime($devoir->date_retour_copie_apres_correction))}}</span></div>
                                                        <div class="tracking-content">RETOUR DES COPIES APRES CORRECTION<span>Copies envoyées par : {{$devoir->copie_retourne_par}} </span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_prise_copie_professeur != null && $devoir->date_retour_copie_apres_correction == null)
                                                <div class="tracking-item tracklist-encours">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/pending.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">En attente<span></span></div>
                                                        <div class="tracking-content">RETOUR DES COPIES APRES CORRECTION<span>En attente</span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_prise_copie_professeur != null)
                                                <div class="tracking-item tracklist-valide">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/validation.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">{{date('d/m/Y',strtotime($devoir->date_prise_copie_professeur))}}<span>{{date('H:i',strtotime($devoir->date_prise_copie_professeur))}}</span></div>
                                                        <div class="tracking-content">COPIES PRISE POUR CORRECTION<span>Copies prise par : {{$devoir->copie_prise_par}} </span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_retour_copie != null && $devoir->date_prise_copie_professeur == null)
                                                <div class="tracking-item tracklist-encours">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/pending.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">En attente</span></div>
                                                        <div class="tracking-content">COPIES PRISE POUR CORRECTION<span>En attente</span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_retour_copie != null)
                                                <div class="tracking-item tracklist-valide">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/validation.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                     </div>
                                                        <div class="tracking-date">{{date('d/m/Y',strtotime($devoir->date_retour_copie))}}<span>{{date('H:i',strtotime($devoir->date_retour_copie))}}</span></div>
                                                        <div class="tracking-content">COPIES RENVOYEES APRES COMPOSITION<span>Copies ramenées par : {{$devoir->copie_envoye_par}} </span></div>
                                                </div>
                                            
                                            @endif

                                            @if ($devoir->date_prise_sujet != null && $devoir->date_retour_copie == null)
                                                <div class="tracking-item tracklist-encours">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/pending.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                        <div class="tracking-date">En attente</span></div>
                                                        <div class="tracking-content">COPIES RENVOYEES APRES COMPOSITION<span>En attente</span></div>
                                                </div>
                                        
                                            @endif

                                            @if ($devoir->date_prise_sujet != null)
                                                <div class="tracking-item tracklist-valide">
                                                    <div class="tracking-icon status-intransit">
                                                        <img src="{{asset('assets/images/validation.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                        <div class="tracking-date">{{date('d/m/Y',strtotime($devoir->date_prise_sujet))}}<span>{{date('H:i',strtotime($devoir->date_prise_sujet))}}</span></div>
                                                        <div class="tracking-content">PRISE DES SUJETS POUR LA COMPOSITION<span>Sujets pris par : {{$devoir->sujet_pris_par}} </span></div>
                                                </div>
                                        
                                            @endif

                                            @if ($devoir->date_depot_sujet != null && $devoir->date_prise_sujet == null)
                                                <div class="tracking-item tracklist-encours">
                                                    <div class="tracking-icon status-intransit">
                                                       
                                                        <img src="{{asset('assets/images/pending.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                        <div class="tracking-date">En attente</span></div>
                                                        <div class="tracking-content">PRISE DES SUJETS POUR LA COMPOSITION<span>En attente</span></div>
                                                </div>
                                        
                                            @endif

                                            @if ($devoir->date_depot_sujet != null)
                                                <div class="tracking-item tracklist-valide">
                                                    <div class="tracking-icon status-intransit">
                                                       
                                                        <img src="{{asset('assets/images/validation.png')}}" style="margin-left: -4px; margin-top: -2px" width="48px" alt="" srcset="">

                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                        <div class="tracking-date">{{date('d/m/Y',strtotime($devoir->date_depot_sujet))}}<span>{{date('H:i',strtotime($devoir->date_depot_sujet))}}</span></div>
                                                        <div class="tracking-content">SUJET DEPOSEE<span>Déposé par : {{$devoir->sujet_depose_par}} </span></div>
                                                </div>
                                        
                                            @endif
                                      
                                       
                                       
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row float-right">
                            <div class="col-sm-12">
                                <a name="" id="" class="btn btn-primary" href="{{ route('devoir.index') }}" role="button">Retour</a>
                                <button type="submit" class="btn btn-success">Enregistrez</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDepotSujet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dépot de sijet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('devoir.depot-sujet') }}" method="post">
            @csrf
              <input type="hidden" name="id" value="{{$devoir->id}}">
            @php
            date_default_timezone_set("Africa/Abidjan");
            $date = date("Y-m-d H:i", time());
            @endphp
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="date_depot_sujet">Date et heure<span class="text-c-red">*</span></label>
                        <input type="text" name="date_depot_sujet" class="form-control" id="date_depot_sujet" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="par">Déposé par<span class="text-c-red">*</span></label>
                        <input type="text" name="sujet_depose_par" class="form-control" id="par">
                    </div>
                </div>
              </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>


<div class="modal fade" id="modalPriseSujet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Prise du sujet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('devoir.prise-sujet') }}" method="post">
            @csrf
              <input type="hidden" name="id" value="{{$devoir->id}}">
            @php
            date_default_timezone_set("Africa/Abidjan");
            $date = date("Y-m-d H:i", time());
            @endphp
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="date_prise_sujet">Date et heure<span class="text-c-red">*</span></label>
                        <input type="text" name="date_prise_sujet" class="form-control" id="date_prise_sujet" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                        <input type="text" name="sujet_pris_par" class="form-control" id="par">
                    </div>
                </div>
              </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>

<div class="modal fade" id="modalRenvoiCopieApresCompo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Retour des copies après composition</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('devoir.retour-copies') }}" method="post">
            @csrf
              <input type="hidden" name="id" value="{{$devoir->id}}">
            @php
            date_default_timezone_set("Africa/Abidjan");
            $date = date("Y-m-d H:i", time());
            @endphp
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="date_retour_copie">Date et heure<span class="text-c-red">*</span></label>
                        <input type="text" name="date_retour_copie" class="form-control" id="date_retour_copie" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="par">Renvoyé par<span class="text-c-red">*</span></label>
                        <input type="text" name="copie_envoye_par" class="form-control" id="par">
                    </div>
                </div>
              </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>

<div class="modal fade" id="modalPriseCopiePourCorrection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Prise des copies pour correction</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('devoir.prise-copies-prof') }}" method="post">
            @csrf
              <input type="hidden" name="id" value="{{$devoir->id}}">
            @php
            date_default_timezone_set("Africa/Abidjan");
            $date = date("Y-m-d H:i", time());
            @endphp
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="date_retour_copie">Date et heure<span class="text-c-red">*</span></label>
                        <input type="text" name="date_prise_copie_professeur" class="form-control" id="date_prise_copie_professeur" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                        <input type="text" name="copie_prise_par" class="form-control" id="par">
                    </div>
                </div>
              </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>

<div class="modal fade" id="modalRenvoiCopieApresCorrection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Arrivée des copies après correction</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('devoir.retour-copie-apres-correction') }}" method="post">
            @csrf
              <input type="hidden" name="id" value="{{$devoir->id}}">
            @php
            date_default_timezone_set("Africa/Abidjan");
            $date = date("Y-m-d H:i", time());
            @endphp
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="date_retour_copie_apres_correction">Date et heure<span class="text-c-red">*</span></label>
                        <input type="text" name="date_retour_copie_apres_correction" class="form-control" id="date_retour_copie_apres_correction" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                        <input type="text" name="copie_retourne_par" class="form-control" id="par">
                    </div>
                </div>
              </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>

<div class="modal fade" id="modalPriseCopieEtudiants" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Récupération des copies corrigée</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('devoir.prise-copie-etudiants') }}" method="post">
            @csrf
              <input type="hidden" name="id" value="{{$devoir->id}}">
            @php
            date_default_timezone_set("Africa/Abidjan");
            $date = date("Y-m-d H:i", time());
            @endphp
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="date_prise_copie_etudiants">Date et heure<span class="text-c-red">*</span></label>
                        <input type="text" name="date_prise_copie_etudiants" class="form-control" id="date_retour_copie_apres_correction" value="@php echo $date @endphp" onblur="this.type='text'" onfocus="this.type='datetime-local'">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="floating-label" for="par">Pris par<span class="text-c-red">*</span></label>
                        <input type="text" name="copie_prise_par_etudiant" class="form-control" id="par">
                    </div>
                </div>
              </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
          </form>
        </div>

      </div>
    </div>
</div>






<style>
    .modal-footer{
        border: none;
    }
    .tracking-detail {
    padding:3rem 0
    }
    #tracking {
    margin-bottom:1rem
    }
    [class*=tracking-status-] p {
    margin:0;
    font-size:1.1rem;
    color:#fff;
    text-transform:uppercase;
    text-align:center
    }
    [class*=tracking-status-] {
    padding:1.6rem 0
    }
    .tracking-status-intransit {
    background-color:#3847ce
    }
    .tracking-status-outfordelivery {
    background-color:#f5a551
    }
    .tracking-status-deliveryoffice {
    background-color:#f7dc6f
    }
    .tracking-status-delivered {
    background-color:#4cbb87
    }
    .tracking-status-attemptfail {
    background-color:#b789c7
    }
    .tracking-status-error,.tracking-status-exception {
    background-color:#d26759
    }
    .tracking-status-expired {
    background-color:#616e7d
    }
    .tracking-status-pending {
    background-color:#ccc
    }
    .tracking-status-inforeceived {
    background-color:#214977
    }
    .tracking-list {
    border:1px solid #e5e5e5
    }
    .tracking-item {
    position:relative;
    padding:2rem 1.5rem .5rem 2.5rem;
    font-size:.9rem;
    margin-left:3rem;
    min-height:5rem
    }

    .tracklist-valide{
        border-left:2px solid #17c507;
    }
    .tracklist-encours{
        border-left:2px solid #a0a79f;
    }
    .tracking-item:last-child {
    padding-bottom:4rem
    }
    .tracking-item .tracking-date {
    margin-bottom:.5rem
    }
    .tracking-item .tracking-date span {
    color:#888;
    font-size:85%;
    padding-left:.4rem
    }
    .tracking-item .tracking-content {
    padding:.5rem .8rem;
    background-color:#f4f4f4;
    border-radius:.5rem
    }
    .tracking-item .tracking-content span {
    display:block;
    color:rgb(121, 121, 121);
    font-size:85%
    }
    .tracking-item .tracking-icon {
    line-height:2.6rem;
    position:absolute;
    left:-1.3rem;
    width:2.6rem;
    height:2.6rem;
    text-align:center;
    border-radius:50%;
    font-size:1.1rem;
    background-color:#fff;
    color:#fff
    }
    .tracking-item .tracking-icon.status-sponsored {
    background-color:#f68
    }
    .tracking-item .tracking-icon.status-delivered {
    background-color:#4cbb87
    }
    .tracking-item .tracking-icon.status-outfordelivery {
    background-color:#f5a551
    }
    .tracking-item .tracking-icon.status-deliveryoffice {
    background-color:#f7dc6f
    }
    .tracking-item .tracking-icon.status-attemptfail {
    background-color:#b789c7
    }
    .tracking-item .tracking-icon.status-exception {
    background-color:#d26759
    }
    .tracking-item .tracking-icon.status-inforeceived {
    background-color:#214977
    }
    .tracking-item .tracking-icon.status-intransit {
    color:#e5e5e5;
    border:1px solid #e5e5e5;
    font-size:.6rem
    }
    @media(min-width:992px) {
    .tracking-item {
    margin-left:10rem
    }
    .tracking-item .tracking-date {
    position:absolute;
    left:-10rem;
    width:7.5rem;
    text-align:right
    }
    .tracking-item .tracking-date span {
    display:block
    }
    .tracking-item .tracking-content {
    padding:0;
    background-color:transparent
    }
    }
</style>

@endsection

@section('javascript')
<!-- select2 Js -->
<script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
<!-- form-select-custom Js -->
<script src="{{ asset('assets/js/pages/form-select-custom.js') }}"></script>
<script>
    var oldInput = <?= json_encode(session()->getOldInput()); ?>;
    console.log(oldInput);
    if (!(oldInput.length === 0)) {
        document.getElementById("matiere").value = oldInput['matiere'];
        document.getElementById("professeur").value = oldInput['professeur'];
        document.getElementById("filiere").value = oldInput['filiere'];
        document.getElementById("niveau").value = oldInput['niveau'];
        document.getElementById("salle").value = oldInput['salle'];
        document.getElementById("date").value = oldInput['date'];
        document.getElementById("surveillant").value = oldInput['surveillant'];
        document.getElementById("duree").value = oldInput['duree'];
    }


</script>
@endsection
