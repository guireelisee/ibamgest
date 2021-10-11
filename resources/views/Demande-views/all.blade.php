@extends(' layouts.master')

@section('title')
| Demandes
@endsection

@section('main-content')

<!-- [ navigation menu ] start -->
@include('partials.sidebar')
@include('partials.navbar')

<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->

<!-- [ Header ] end --



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
                            <li class="breadcrumb-item"><a href="#">Liste des audiences</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Scrolling DataTable</h5>
                    </div>
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
                                                @if ($demande->decision === 1)
                                                   <td>Accepter</td>
                                                @endif
                                                @if ($demande->decision === 0)
                                                   <td>Rejetter</td>
                                                @endif
                                                @if ($demande->decision === null)
                                                   <td>Pas encore traité</td>
                                                @endif
                                                <td>
                                                    <button type="button"
                                                        id="edit"
                                                        data-type="edit"
                                                        data-id="{{ $demande->idDemande }} "
                                                        data-nom="{{ $demande->nomDemandeur }}"
                                                        data-prenom="{{ $demande->prenomDemandeur }}"
                                                        data-tel="{{ $demande->tel }}"
                                                        data-service="{{ $demande->service }}"
                                                        data-dated="{{ $demande->date_demande }}"
                                                        data-dater="{{ $demande->date_reponse }}"
                                                        data-datea="{{ $demande->date_audience }}"
                                                        data-heurea="{{ $demande->heure_audience }}"
                                                        data-motif="{{ $demande->motif }}"
                                                        data-prof="{{ $demande->profession }}"
                                                        data-toggle="modal"
                                                        data-target="#personelmodal"
                                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i>
                                                </button>
                                                @if ($demande->decision === null)
                                                    <button type="button"
                                                        id="edit"
                                                        data-type="edit"
                                                        data-id="{{ $demande->idDemande }}"
                                                        data-toggle="modal"
                                                        data-target="#validitymodal"
                                                        class="btn btn-success btn-sm"><i class="fa fa-check"></i>
                                                    </button>
                                                @endif
                                                @if ($demande->decision === null)
                                                    <button type="button"
                                                            id="edit"
                                                            data-type="edit"
                                                            data-id="{{ $demande->idDemande }}"
                                                            data-toggle="modal"
                                                            data-target="#rejetermodal"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                                                    </button>
                                                @endif
                                                @if ($demande->decision === null)
                                                    <button type="button"
                                                            id="edit"
                                                            data-type="edit"
                                                            data-id="{{ $demande->idDemande }}"
                                                            data-toggle="modal"
                                                            data-target="#confirm-modal"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    </button>
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
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/plugins/select.bootstrap4.min.js"></script>
<script src="assets/js/plugins/dataTables.select.min.js"></script>
<script src="assets/js/pages/data-autofill-custom.js"></script>

@endsection()
