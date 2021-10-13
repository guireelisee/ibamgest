@extends(' layouts.master')
@section('css')
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">
@endsection
@section('title')
| Filieres
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
                            <h5 class="m-b-10">Filières</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Filières</a></li>
                            <li class="breadcrumb-item"><a href="#">Liste des filières</a></li>

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
                                      <th>Nom de la filière</th>
                                      <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($filieres as $filiere)
                                            <tr>
                                                <td>{{ $filiere->nom_filiere }}</td>
                                                <td>
                                                    <a type="button"
                                                    href="{{ route('filiere.show', ['id'=>$filiere->id]) }}"

                                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i>
                                                    </a>

                                                    <a type="button"
                                                        href="{{ route('filiere.suppression.view', ['id'=>$filiere->id]) }}"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    </a>
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
