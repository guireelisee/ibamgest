
@section('css')
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/plugins/select.bootstrap4.min.css">

@endsection
<div class="titre" style="text-align: center">
    <h1>Liste des demandes d'audience</h1>
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

                        </tr>
                    @endforeach


                </tbody>
        </table>
    </div>
</div>

<style>
    *{
        background-color: white;
    }

    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>

<script>
    window.print();
    window.addEventListener('afterprint', (event) => {
        window.history.back();
    });

</script>
