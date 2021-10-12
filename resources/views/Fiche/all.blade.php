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
                                    <th>N°</th>
                                    <th>Date d'arrivée</th>
                                    <th>Expéditeur</th>
                                    <th>SP</th>
                                    <th>Directeur</th>
                                    <th>Scolarité</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                <tr>
                                    <td>{{$fiche->id}}</td>
                                    <td>{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->nom_exp }}</td>

                                    @if ($fiche->sp == "")
                                    <td><a name="" class="btn btn-primary text-white" href="{{ route('fiche.edit', $fiche->id) }}">En attente</a></td>
                                    <td><a name="" id="" class="btn btn-warning text-white" href="#">NULL</a></td>
                                    <td><a name="" id="" class="btn btn-warning text-white" href="#">NULL</a></td>
                                    <td><a name="" id="" class="btn btn-warning text-white" href="#">En attente</a></td>
                                    @endif

                                    @if ($fiche->sp != "" && $fiche->dir == "")
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">{{$fiche->sp}}</a></td>
                                    <td><a name="" id="" class="btn btn-primary text-white" href="{{ route('fiche.edit', $fiche->id) }}">En attente</a></td>
                                    <td><a name="" id="" class="btn btn-warning text-white" href="#">NULL</a></td>
                                    <td><a name="" id="" class="btn btn-warning text-white" href="#">En attente</a></td>
                                    @endif

                                    @if ($fiche->sp != "" && $fiche->dir != "" && $fiche->scolarite == "")
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">{{$fiche->sp}}</a></td>
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">{{$fiche->dir}}</a></td>
                                    <td><a name="" id="" class="btn btn-primary text-white" href="{{ route('fiche.edit', $fiche->id) }}">En attente</a></td>
                                    <td><a name="" id="" class="btn btn-warning text-white" href="#">En attente</a></td>
                                    @endif

                                    @if ($fiche->sp != "" && $fiche->dir != "" && $fiche->scolarite != "")
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">{{$fiche->sp}}</a></td>
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">{{$fiche->dir}}</a></td>
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">{{$fiche->scolarite}}</a></td>
                                    <td><a name="" id="" class="btn btn-success text-white" href="#">Terminé</a></td>
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
        {{-- <div class="row">
            <div class="col-sm-4">
                <div class="card statustic-card">
                    <div class="card-body text-center">
                        <h5 class="text-left">Demandes en attente</h5>
                        <span class="d-block text-c-blue f-36">{{$compteurs['en_cours_sp']+$compteurs['en_cours_dir']+$compteurs['en_cours_scolarite']}}</span>
                        <p class="m-b-0">Total</p>
                        <div class="progress">
                            <div class="progress-bar bg-c-blue" style="width:56%"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue border-0">
                        <h6 class="text-white m-b-0"></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card statustic-card">
                    <div class="card-body text-center">
                        <h5 class="text-left">Demandes annulées</h5>
                        <span class="d-block text-c-blue f-36">0</span>
                        <p class="m-b-0">Total</p>
                        <div class="progress">
                            <div class="progress-bar bg-c-red" style="width:56%"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-red border-0">
                        <h6 class="text-white m-b-0"></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card statustic-card">
                    <div class="card-body text-center">
                        <h5 class="text-left">Demandes validées</h5>
                        <span class="d-block text-c-blue f-36">{{$compteurs['validate']}}</span>
                        <p class="m-b-0">Total</p>
                        <div class="progress">
                            <div class="progress-bar bg-c-green" style="width:56%"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-green border-0">
                        <h6 class="text-white m-b-0"></h6>
                    </div>
                </div>
            </div>
        </div> --}}
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
                                    <th>Date d'arrivée</th>
                                    <th>Expéditeur</th>
                                    <th>Secretaire Permanent</th>
                                    <th>Directeur</th>
                                    <th>Scolarité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                <tr>
                                    <td>{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp}}</td>
                                    <td>
                                        @if (!$fiche->delete)
                                        @if (empty($fiche->sp))
                                        <form method="POST" action="{{ route('fiche.destroy', $fiche->id)}}">
                                            @csrf()
                                            @method("DELETE")
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-danger"><i class="feather icon-trash">&nbsp;</i>En attente</span>
                                            </button>
                                        </form>
                                        @else
                                        {{$fiche->sp }}
                                        @endif
                                        @else
                                        <div class="badge badge-danger">Annulée</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$fiche->delete)
                                        @if (empty($fiche->dir))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>
                                        @else
                                        {{$fiche->dir }}
                                        @endif
                                        @else
                                        <div class="badge badge-danger">Annulée</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$fiche->delete)
                                        @if (empty($fiche->scolarite))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>                                        @else
                                        {{$fiche->scolarite }}
                                        @endif
                                        @else
                                        <div class="badge badge-danger">Annulée</div>
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
                                    <th>Date d'arrivée</th>
                                    <th>Expéditeur</th>
                                    <th>Secretaire Permanent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                @if (!$fiche->delete)
                                <tr>
                                    <td>{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp}}</td>
                                    <td>
                                        @if (empty($fiche->sp))
                                        <a href="{{ route('fiche.edit', $fiche->id) }}">
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                            </button>
                                        </a>
                                        @elseif(empty($fiche->dir))
                                        <a href="{{ route('fiche.edit', $fiche->id) }}">
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> {{$fiche->sp }}</span>
                                            </button>
                                        </a>
                                        @else
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> {{$fiche->sp }}</span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
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
                                    <th>Date d'arrivée</th>
                                    <th>Expéditeur</th>
                                    <th>Secretaire Permanent</th>
                                    <th>Directeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                @if (!$fiche->delete)
                                <tr>
                                    <td>{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp}}</td>
                                    <td>
                                        @if (empty($fiche->sp))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>
                                        @else
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> {{$fiche->sp }}</span>
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($fiche->sp))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>
                                        @elseif (empty($fiche->dir) && !empty($fiche->sp))
                                        <a href="{{ route('fiche.edit', $fiche->id) }}">
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                            </button>
                                        </a>
                                        @elseif(empty($fiche->scolarite))
                                        <a href="{{ route('fiche.edit', $fiche->id) }}">
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> {{$fiche->dir }}</span>
                                            </button>
                                        </a>
                                        @else
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> {{$fiche->dir }}</span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
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
                                    <th>Date d'arrivée</th>
                                    <th>Expéditeur</th>
                                    <th>Secretaire Permanent</th>
                                    <th>Directeur</th>
                                    <th>Scolarité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fiches as $fiche)
                                @if (!$fiche->delete)
                                <tr>
                                    <td>{{date('d/m/Y', strtotime($fiche->date_arrivee))}}</td>
                                    <td>{{$fiche->nom_exp . ' '. $fiche->prenom_exp}}</td>
                                    <td>
                                        @if (empty($fiche->sp))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>
                                        @else
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary">{{$fiche->sp }}</span>
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($fiche->dir))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled >
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>
                                        @else
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary">{{$fiche->dir }}</span>
                                        </button>
                                        @endif

                                    </td>
                                    <td>
                                        @if (empty($fiche->dir))
                                        <button type="submit" class="col-sm-12 btn btn-sm" disabled>
                                            <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i>En attente</span>
                                        </button>
                                        @elseif(!empty($fiche->dir) && empty($fiche->scolarite))
                                        <a href="{{ route('fiche.edit', $fiche->id) }}">
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> En attente</span>
                                            </button>
                                        </a>
                                        @else
                                        <a href="{{ route('fiche.edit', $fiche->id) }}">
                                            <button type="submit" class="col-sm-12 btn btn-sm">
                                                <span class="badge badge-primary"><i class="feather icon-edit">&nbsp;</i> {{$fiche->scolarite}}</span>
                                            </button>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan







        @endsection

        @section("javascript")

        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/select.bootstrap4.min.js"></script>
        <script src="assets/js/plugins/dataTables.select.min.js"></script>
        <script src="assets/js/pages/data-autofill-custom.js"></script>
        @endsection()
