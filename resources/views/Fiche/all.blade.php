@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
@endsection

@section('title')
| Demandes de salle
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
                            <h5 class="m-b-10">Demandes de salle</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Liste des salles</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @can('admin')
        <div class="col-sm-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success">
                        <h5>{{ $message }}</h5>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="scroll-fill" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>

                                    <th>Date d'arrivée</th>
                                    <th>Salle</th>
                                    <th>Motif</th>
                                    <th>Expéditeur</th>
                                    <th>SP</th>
                                    <th>Directeur</th>
                                    <th>Scolarité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                <tr>
                                    <td>Le {{date('d/m/Y à H:i', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->salle->nom}}</td>
                                    <td>{{$fiche->motif}}</td>
                                    <td>{{$fiche->nom_exp }}</td>

                                    @if (empty($fiche->sp))
                                    <td><div name="" class="btn btn-primary btn-sm text-white">En attente</div></td>
                                    <td><div name="" id="" class="btn btn-warning btn-sm text-white">En attente</div></td>
                                    <td><div name="" id="" class="btn btn-warning btn-sm text-white">En attente</div></td>
                                    @endif

                                    @if (!empty($fiche->sp) && empty($fiche->dir))
                                    <td><div name="" id="" class="btn btn-success btn-sm text-white">{{$fiche->sp}}</div></td>
                                    <td><div name="" id="" class="btn btn-primary btn-sm text-white">En attente</div></td>
                                    <td><div name="" id="" class="btn btn-warning btn-sm text-white">En attente</div></td>
                                    @endif

                                    @if (!empty($fiche->sp) && !empty($fiche->dir) && empty($fiche->scolarite))
                                    <td><div name="" id="" class="btn btn-success btn-sm text-white">{{$fiche->sp}}</div></td>
                                    <td><div name="" id="" class="btn btn-success btn-sm text-white">{{$fiche->dir}}</div></td>
                                    <td><div name="" id="" class="btn btn-primary btn-sm text-white">En attente</div></td>
                                    @endif

                                    @if (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite))
                                    <td><div name="" id="" class="btn btn-success btn-sm text-white">{{$fiche->sp}}</div></td>
                                    <td><div name="" id="" class="btn btn-success btn-sm text-white">{{$fiche->dir}}</div></td>
                                    <td><div name="" id="" class="btn btn-success btn-sm text-white">{{$fiche->scolarite}}
                                    le {{date('d/m/Y à H:i', strtotime($fiche->date_validation))}}
                                    </div></td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('secretaire')
        <div class="col-sm-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ $message }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="scroll-fill" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <tr>

                                        <th>Date d'arrivée</th>
                                        <th>Salle</th>
                                        <th>Motif</th>
                                        <th>Expéditeur</th>
                                        <th>Secretaire</th>
                                        <th>Statut</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                <tr>
                                    <td>Le {{date('d/m/Y à H:i', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->salle->nom}}</td>
                                    <td>{{$fiche->motif}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp }}</td>

                                    <td>
                                        @if(!$fiche->secretaire && empty($fiche->deleted_at))
                                        <a class="btn btn-secondary btn-sm" href="{{ route('fiche.edit',$fiche) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-success btn-sm" href="{{ route('fiche.validate',$fiche) }}"><i class="fas fa-check"></i></a>
                                        <form action="{{ route('fiche.destroy', $fiche)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm confirm-modal" type="submit" data-name=""><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endif
                                        @if($fiche->secretaire && empty($fiche->deleted_at))
                                        <div name="" class="btn btn-success btn-sm text-white">Validé</div>
                                        @endif
                                        @if(!empty($fiche->deleted_at))
                                        <div name="" class="btn btn-danger btn-sm text-white">Annulée</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$fiche->secretaire && empty($fiche->deleted_at))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente de la validation</div>
                                        @endif
                                        @if(empty($fiche->sp) && $fiche->secretaire && empty($fiche->deleted_at))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente chez le SP</div>
                                        @endif
                                        @if(!empty($fiche->sp) && empty($fiche->dir) && empty($fiche->deleted_at))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente chez le directeur</div>
                                        @endif
                                        @if(!empty($fiche->sp) && !empty($fiche->dir) && empty($fiche->scolarite) && empty($fiche->deleted_at))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente à la scolarité</div>
                                        @endif
                                        @if(!empty($fiche->scolarite))
                                        <div name="" class="btn btn-success btn-sm text-white">{{$fiche->scolarite}}
                                            @if (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite))
                                            le {{date('d/m/Y à H:i', strtotime($fiche->date_validation))}}
                                            @endif
                                        </div>
                                        @endif
                                        @if(!empty($fiche->deleted_at))
                                        <div name="" class="btn btn-danger btn-sm text-white">Annulée</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('secretaire_permanent')
        <div class="col-sm-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ $message }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="scroll-fill" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <tr>

                                        <th>Date d'arrivée</th>
                                        <th>Salle</th>
                                        <th>Motif</th>
                                        <th>Expéditeur</th>
                                        <th>SP</th>
                                        <th>Statut</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                @if ($fiche->secretaire && empty($fiche->deleted_at))
                                <tr>
                                    <td>Le {{date('d/m/Y à H:i', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->salle->nom}}</td>
                                    <td>{{$fiche->motif}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp }}</td>

                                    <td>
                                        @if(empty($fiche->sp))
                                        <a class="btn btn-success btn-sm" href="{{ route('fiche.edit',$fiche) }}"><i class="fas fa-check"></i>&ensp;Valider</a>
                                        @else
                                        <div name="" class="btn btn-success btn-sm text-white">{{$fiche->sp}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(empty($fiche->sp))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente de validation</div>
                                        @endif
                                        @if(!empty($fiche->sp) && empty($fiche->dir))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente chez le directeur</div>
                                        @endif
                                        @if(!empty($fiche->dir) && empty($fiche->scolarite))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente à la scolarité</div>
                                        @endif
                                        @if(!empty($fiche->scolarite))
                                        <div name="" class="btn btn-success btn-sm text-white">{{$fiche->scolarite}}
                                            @if (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite))
                                            le {{date('d/m/Y à H:i', strtotime($fiche->date_validation))}}
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('directeur')
        <div class="col-sm-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ $message }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="scroll-fill" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <tr>

                                        <th>Date d'arrivée</th>
                                        <th>Salle</th>
                                        <th>Motif</th>
                                        <th>Expéditeur</th>
                                        <th>Directeur</th>
                                        <th>Statut</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                @if (!empty($fiche->sp) && empty($fiche->deleted_at))
                                <tr>
                                    <td>Le {{date('d/m/Y à H:i', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->salle->nom}}</td>
                                    <td>{{$fiche->motif}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp }}</td>

                                    <td>
                                        @if(empty($fiche->dir))
                                        <a class="btn btn-success btn-sm" href="{{ route('fiche.edit',$fiche) }}"><i class="fas fa-check"></i>&ensp;Valider</a>
                                        @else
                                        <div name="" class="btn btn-success btn-sm text-white">{{$fiche->dir}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(empty($fiche->dir))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente de validation</div>
                                        @endif
                                        @if(!empty($fiche->dir) && empty($fiche->scolarite))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente à la scolarité</div>
                                        @endif
                                        @if(!empty($fiche->scolarite))
                                        <div name="" class="btn btn-success btn-sm text-white">{{$fiche->scolarite}}
                                            @if (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite))
                                            le {{date('d/m/Y à H:i', strtotime($fiche->date_validation))}}
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('scolarite')
        <div class="col-sm-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="card-header">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ $message }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="scroll-fill" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <tr>

                                        <th>Date d'arrivée</th>
                                        <th>Salle</th>
                                        <th>Motif</th>
                                        <th>Expéditeur</th>
                                        <th>Scolarité</th>
                                        <th>Statut</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                @if (!empty($fiche->dir) && empty($fiche->deleted_at))
                                <tr>
                                    <td>Le {{date('d/m/Y à H:i', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->salle->nom}}</td>
                                    <td>{{$fiche->motif}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp }}</td>

                                    <td>
                                        @if(empty($fiche->scolarite))
                                        <a class="btn btn-success btn-sm" href="{{ route('fiche.edit',$fiche) }}"><i class="fas fa-check"></i>&ensp;Valider</a>
                                        @else
                                        <div name="" class="btn btn-success btn-sm text-white">{{$fiche->scolarite}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(empty($fiche->scolarite))
                                        <div name="" class="btn btn-warning btn-sm text-white">En attente de validation</div>
                                        @else
                                        <div name="" class="btn btn-success btn-sm text-white">
                                            @if ($fiche->accepte == true)
                                                Validé
                                            @else
                                                Refusé
                                            @endif
                                            @if (!empty($fiche->sp) && !empty($fiche->dir) && !empty($fiche->scolarite))
                                            le {{date('d/m/Y à H:i', strtotime($fiche->date_validation))}}
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('demandeur')
        <div class="row">
            @foreach ($fiches as $fiche)
                <div class="col-md-4">
                    <div class="card user-card user-card-1">
                        <div class="card-header border-0 p-2 pb-0">
                            <div class="cover-img-block" style="text-align: center">
                                <img src="{{asset('assets/images/demande.png')}}" width="55px" alt="" class="img-fluid">
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <h6>Demande soumis le : <span style="color: rgb(131, 131, 131)">{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</span> </h6>
                            <h6>Salle demandée :<span style="color: rgb(131, 131, 131)"> {{ $fiche->salle->nom }}</span></h6>

                            <h6>Motif :<span style="color: rgb(131, 131, 131)">{{ $fiche->motif }}</span></h6>
                            <h6>Début de l'occupation :
                                <span style="color: rgb(131, 131, 131)">{{date('d/m/Y', strtotime($fiche->date_debut_occupation))}} à {{date('H:i', strtotime($fiche->date_fin_occupation))}}</span>

                            </h6>

                            <h6>Fin de l'occupation :
                                <span style="color: rgb(131, 131, 131)">{{date('d/m/Y', strtotime($fiche->date_fin_occupation))}} à {{date('H:i', strtotime($fiche->date_fin_occupation))}}</span>

                            </h6>

                            @if ($fiche->accepte === 1 || $fiche->accepte === true)
                                <button class="btn btn-block btn-success">Salle accordée</button>
                            @endif
                            @if ($fiche->accepte === 0 || $fiche->accepte === false)
                                <button class="btn btn-block btn-danger">Salle refusée</button>
                            @endif
                            @if ($fiche->accepte === null)
                                <button class="btn btn-block btn-warning">En attente de reponse</button>
                            @endif

                        </div>

                        <div class="card-body hover-data text-white">
                            <div class="">
                                @if ($fiche->accepte === 0 || $fiche->accepte === false)
                                    <h6 class="text-white">Motif de refus : {{ $fiche->scolarite }}</h6>
                                @endif

                                @if ($fiche->accepte === null)
                                <h4 class="text-white">Actions</h4>

                                <form action="{{ route('fiche.destroy', $fiche)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm confirm-modal" type="submit" data-name=""><i class="fas fa-trash"></i></button>
                                </form>
                                @endif


                            </div>
                        </div>
                    </div>





                </div>


            @endforeach

            <div class="card user-card user-card-1">
                <br>

        </div>
        @endcan



        @endsection

        @section("javascript")

        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/select.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/dataTables.select.min.js"></script>
        <script src="assets/js/pages/data-autofill-custom.js"></script>
        @include('layouts.confirm-modal')

        @endsection()
