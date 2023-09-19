@extends('layout.secretaire.header')
@section('content')
    @foreach ($info as $row1)
        @if ($row1 == 0)
            <div class="alert alert-danger">
                <strong>Votre recherche a {{ "request()->input('query')" }} retournée {{ $row1 }}
                    resultat</strong>
                <div class="progress-bar"></div>
            </div>
        @break

    @else
        <div class="alert alert-success">
            <strong>Votre recherche a "{{ $query }}" retournée {{ $row1 }} resultat(s) </strong>
            <div class="progress-bar"></div>
        </div>
        <h3 class="card-header">N°Dossier :{{ $row1->numero_doss }}</h3>
        <div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">
            <ul class="list-group list-group-flush flex-column gap-3">
                <li class="list-group-item">Date d'enregistrement: {{ $row1->date }}</li>
                <li class="list-group-item">Nature des produits: {{ $row1->nature_p }}</li>
                <li class="list-group-item">Nature des opérations: {{ $row1->nature_op }}</li>
                <li class="list-group-item">Montant en FCFA: {{ $row1->montant }}</li>
                <li class="list-group-item">Contre montant: {{ $row1->montant_con }}</li>
                <li class="list-group-item">Devise: {{ $row1->devise }}</li>
                <li class="list-group-item">Nom du client: {{ $row1->nom_client }}</li>
                <li class="list-group-item">Prénom du client: {{ $row1->prenom_client }}</li>
                <li class="list-group-item">Profession du client: {{ $row1->profess_client }}</li>
                <li class="list-group-item">Téléphone du client: {{ $row1->tel_client }}</li>
                <li class="list-group-item">Banque du client: {{ $row1->banque_client }}</li>
                <li class="list-group-item">Numéro de compte du client: {{ $row1->num_compt_client }}</li>

            </ul>


        </div>
    @endif
@endforeach

@foreach ($user as $item)
    <a style="width: auto; height:fit-content;" href="{{ url('HSecretaire') }}" class="btn btn-primary">Statistique</a>
@endforeach
@endsection

<style>
.progress-bar {
    width: 100%;
    height: 5px;
    background-color: blue;
    position: relative;
    animation: progress 30s linear;
}

@keyframes progress {
    0% {
        width: 100%;
    }

    100% {
        width: 0%;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let alertDiv = document.querySelector('.alert');
        let progressBar = document.querySelector('.progress-bar');
        if (alertDiv && progressBar) {
            setTimeout(function() {
                alertDiv.style.display = 'none';
            }, 7000);
        }
    });
</script>
