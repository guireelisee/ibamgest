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
                            <li class="breadcrumb-item"><a href="{{ route('demande.index') }}">Liste des audiences</a></li>
                            <li class="breadcrumb-item"><a href="#">Confirmation d'une audience</a></li>

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
                    @elseif ($errors->any())
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
                        <div class="container">
                            <form action="{{route('demande.validate')}}" method="POST">
                                @csrf
                                @php
                                date_default_timezone_set("Africa/Abidjan");
                                $date = date("Y-m-d", time());
                                @endphp
                                <input type="hidden" value="{{$demande[0]->idDemande}}" name="idDemande">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dateR" class="floating-label">Date réponse</label>
                                                <input type="text" class="form-control" onblur="this.type='text'" onfocus="this.type='date'" value='@php echo $date @endphp' name="dateR" id="dateR">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dateA" class="floating-label">Date audience</label>
                                                <input type="text" class="form-control" onblur="this.type='text'" onfocus="this.type='date'" name="dateA" id="dateA">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heureA" class="floating-label">Heure audience</label>
                                                <input type="text" class="form-control" onblur="this.type='text'" onfocus="this.type='time'" name="heureA" id="heureA">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nom" class="floating-label">Nom</label>
                                                <input type="text" readonly value="{{$demande[0]->nomDemandeur}}" class="form-control" name="nom" id="nom">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="prenom" class="floating-label">Prénom (s)</label>
                                                <input type="text" readonly value="{{$demande[0]->prenomDemandeur}}" class="form-control" name="prenom" id="prenom">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tel" class="floating-label">Téléphone</label>
                                                <input type="tel" readonly value="{{$demande[0]->tel}}" class="form-control" name="tel" id="tel">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="service" class="floating-label">Adresse/Service</label>
                                                <input type="service" readonly value="{{$demande[0]->service}}" class="form-control" name="service" id="service">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="prof" class="floating-label">Profession</label>
                                                <input type="text"readonly value="{{$demande[0]->profession}}" class="form-control" name="prof" id="prof">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dateD" class="floating-label">Date demande</label>
                                                <input type="text" class="form-control" readonly value="{{$demande[0]->date_demande}}" onblur="this.type='text'" onfocus="this.type='date'" name="dateD" id="dateD">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="motif" class="floating-label">Motif</label>
                                                <textarea rows="5" class="form-control" readonly value="{{$demande[0]->motif}}" name="motif" id="motif"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="row float-right">
                                    <div class="col-md-12">
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

                <script>
                var oldInput = <?= json_encode(session()->getOldInput()); ?>;
                console.log(oldInput);
                if (!(oldInput.length === 0)) {
                    document.getElementById("dateR").value = oldInput['dateR'];
                    document.getElementById("dateA").value = oldInput['dateA'];
                    document.getElementById("heureA").value = oldInput['heureA'];
                }
            </script>

    @endsection()
