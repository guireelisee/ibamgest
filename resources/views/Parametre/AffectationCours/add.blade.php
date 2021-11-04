@extends('layouts.master')

@section('title')
| Affectation des cours
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
                            <h5 class="m-b-10">Affectation des cours</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Affectation d'un cours</a></li>
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
                        <form method="POST" action="{{ route('affectation-cours.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="filiere" id="filiere" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE FILIERE ---</option>
                                            @foreach ($filieres as $filiere)
                                            <option value="{{$filiere->id}}">{{$filiere->nom_filiere}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="niveau" id="niveau" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN NIVEAU ---</option>
                                            <option value="Licence I">Licence I</option>
                                            <option value="Licence II">Licence II</option>
                                            <option value="Licence III">Licence III</option>
                                            <option value="Master I">Master I</option>
                                            <option value="Master II">Master II</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="matiere" id="matiere" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE MATIERE ---</option>
                                            @foreach ($matieres as $matiere)
                                            <option value="{{$matiere->id}}">{{$matiere->nom_matiere}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="professeur" id="professeur" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN PROFESSEUR ---</option>
                                            @foreach ($professeurs as $professeur)
                                            <option value="{{$professeur->id}}">{{$professeur->nom .' '.$professeur->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-sm-12">
                                    <a name="" id="" class="btn btn-primary" href="{{ route('affectation-cours.index') }}" role="button">Retour</a>
                                    <button type="submit" class="btn btn-success">Enregistrez</button>
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

@section('javascript')
<script>
    var oldInput = <?= json_encode(session()->getOldInput()); ?>;
    console.log(oldInput);
    if (!(oldInput.length === 0)) {
        document.getElementById("matiere").value = oldInput['matiere'];
        document.getElementById("professeur").value = oldInput['professeur'];
        document.getElementById("filiere").value = oldInput['filiere'];
        document.getElementById("niveau").value = oldInput['niveau'];
    }


</script>
@endsection
