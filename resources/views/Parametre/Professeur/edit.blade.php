@extends('layouts.master')

@section('title')
| Demandes de professeur
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
                            <h5 class="m-b-10">Demandes de professeur</h5>
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
                        <form method="POST" action="{{ route('professeur.update',$professeur) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="civilite">Civilité<span class="text-c-red">&nbsp*</span></label>
                                        <select name="civilite" id="civilite" class="form-control">
                                            <option value="" disabled>--- SELECTIONNEZ UNE CIVILITÉ ---</option>
                                            <option value="Mr">Monsieur</option>
                                            <option value="Mme">Madame</option>
                                            <option value="Mlle">Mademoiselle</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="nom">Nom<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="nom" class="form-control" id="nom" value="{{$professeur->nom}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="prenom">Prénom(s)<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="prenom" class="form-control" id="prenom" value="{{$professeur->prenom}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="matricule">Matricule<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="matricule" class="form-control" id="matricule" value="{{$professeur->matricule}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="titre">Titre<span class="text-c-red">&nbsp*</span></label>
                                        <input type="text" name="titre" class="form-control" id="titre" value="{{$professeur->titre}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">(+226)</span>
                                        </div>
                                        <input type="text" class="form-control mob_no" id="phone" name="phone" placeholder="Téléphone" value="{{$professeur->phone}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="email">Email<span class="text-c-red">&nbsp*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{$professeur->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-sm-12">
                                    <a name="" id="" class="btn btn-primary" href="{{ route('professeur.index') }}" role="button">Retour</a>
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
