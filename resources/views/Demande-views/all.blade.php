@extends(' layouts.master')
@section('css')
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
@endsection
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
                            <li class="breadcrumb-item"><a href="#">Liste des audiences</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="card-header">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Success !</strong> {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="scroll-fill" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                      <th>Nom & Prénom (s)</th>
                                      <th>Téléphone</th>
                                      <th>Date demande</th>
                                      <th>Motif</th>
                                      <th>Statut</th>
                                      <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($demandes as $demande)
                                            <tr>
                                                <td>{{ $demande->nomDemandeur }} {{ $demande->prenomDemandeur }}</td>
                                                <td>{{ $demande->tel }}</td>
                                                <td>{{ $demande->date_demande }}</td>
                                                <td>{{ $demande->motif }}</td>
                                                @if ($demande->decision === 1 || $demande->decision === true)
                                                   <td>Accepter</td>
                                                @endif
                                                @if ($demande->decision === 0 || $demande->decision === false)
                                                   <td>Rejetter</td>
                                                @endif
                                                @if ($demande->decision === null)
                                                   <td>Pas encore traité</td>
                                                @endif
                                                <td>
                                                    <a type="button"
                                                    href="{{ route('demande.show', ['id'=>$demande->idDemande]) }}"

                                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i>
                                                </a>
                                                @if ($demande->decision === null)
                                                    <a type="button"
                                                        id="edit"
                                                        href="{{ route('demande.validate.view', ['id'=>$demande->idDemande]) }}"
                                                        class="btn btn-success btn-sm"><i class="fa fa-check"></i>
                                                    </a>
                                                @endif
                                                @if ($demande->decision === null)
                                                    <a type="button"
                                                            href="{{ route('demande.rejetter.view', ['id'=>$demande->idDemande]) }}"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                                                    </a>
                                                @endif
                                                @if ($demande->decision === null)
                                                    <a type="button"
                                                            href="{{ route('demande.suppression.view', ['id'=>$demande->idDemande]) }}"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    </a>
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
        </div>




@endsection


@section("javascript")


   <!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></>
<script src="assets/js/plugins/select.bootstrap4.min.js"></script>
<script src="assets/js/plugins/dataTables.select.min.js"></script>
<script src="assets/js/pages/data-autofill-custom.js"></script>

<script src="assets/js/plugins/bootstrap-notify.min.js"></script>
<script src="assets/js/pages/ac-notification.js"></script>

@endsection()
