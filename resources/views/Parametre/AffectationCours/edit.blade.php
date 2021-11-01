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
                        <form method="POST" action="{{ route('affectation-cours.update',$affectation) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="filiere" id="filiere" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE FILIERE ---</option>
                                            <option value="{{$affectation->filiere->id}}" selected>{{$affectation->filiere->nom_filiere}}</option>
                                            @foreach ($filieres as $filiere)
                                            @if ($filiere->id !== $affectation->filiere->id)
                                            <option value="{{$filiere->id}}">{{$filiere->nom_filiere}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="niveau" id="niveau" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN NIVEAU ---</option>
                                            <option value="{{$affectation->niveau}}" selected>{{$affectation->niveau}}</option>
                                            @foreach ($niveaux as $niveau)
                                            @if ($niveau !== $affectation->niveau)
                                            <option value="{{$niveau}}">{{$niveau}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="matiere" id="matiere" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UNE MATIERE ---</option>
                                            <option value="{{$affectation->matiere->id}}" selected>{{$affectation->matiere->nom_matiere}}</option>
                                            @foreach ($matieres as $matiere)
                                            @if ($matiere->id !== $affectation->matiere->id)
                                            <option value="{{$matiere->id}}">{{$filiere->nom_matiere}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select name="professeur" id="professeur" class="form-control js-example-responsive">
                                            <option value="" disabled>--- SELECTIONNEZ UN PROFESSEUR ---</option>
                                            <option value="{{$affectation->professeur->id}}" selected>{{$affectation->professeur->nom .' '.$affectation->professeur->prenom}}</option>
                                            @foreach ($professeurs as $professeur)
                                            @if ($professeur->id !== $affectation->professeur->id)
                                            <option value="{{$professeur->id}}">{{$professeur->nom .' '.$professeur->prenom}}</option>
                                            @endif
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
        document.getElementById("nom").value = oldInput['nom'];
        document.getElementById("prenom").value = oldInput['prenom'];
        document.getElementById("phone").value = oldInput['phone'];
        document.getElementById("email").value = oldInput['email'];
        document.getElementById("civilite").value = oldInput['civilite'];
        document.getElementById("matricule").value = oldInput['matricule'];
        document.getElementById("titre").value = oldInput['titre'];
    }


</script>
@endsection
