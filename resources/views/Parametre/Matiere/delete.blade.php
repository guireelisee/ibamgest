@extends(' layouts.master')
@section('css')
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
@endsection
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
                            <h5 class="m-b-10">Matières</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('matiere.index') }}">Matières</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('matiere.index') }}">Liste des matières</a></li>
                            <li class="breadcrumb-item"><a href="#">suppression d'une matière</a></li>

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
                        <div class="container">
                            <form action="{{route('matiere.destroy')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$matiere[0]->idMatiere}}" name="idMatiere">
                                <div class="container" style="text-align: center">
                                    <p style="font-size: 17px">Confirmez-vous la suppression de la matière ?</p>
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                    <a href="{{route('matiere.index')}}" class="btn btn-primary">Retour</a>
                                </div>
                            </form>
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
