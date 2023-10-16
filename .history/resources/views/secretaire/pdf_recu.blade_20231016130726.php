@extends('layout.pdf.header')
@section('content')
<h1>Récépissé</h1>
    <div class="d-flex justify-content-end mb-4">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th>N° Dossier</th>
                    <th>Date d'enregistrement</th>
                    <th>Nature des produits</th>
                    <th>Nature des opérations</th>
                    <th>Montant (Devise)</th>
                    <th>Contre montant (FCFA)</th>
              

                    @if ($demande->nom_client)
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
                    <th>Profession du client</th>
                    <th>Téléphone du client</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    @endif
                 
                    @if ($demande->nomsociete)
                    <th>Nom societé</th>
                    <th>Categorie</th>
                    <th>Adresse</th>
                    <th>Téléphone </th>

                    <th>Banque</th>
                    
                    <th>Numéro de compte </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <td>{{ $['numero_doss'] }}</td>
                <td>{{ $['date'] }}</td>
                <td>{{ $['nature_p'] }}</td>
                <td>{{ $['nature_op'] }}</td>
                <td>{{ $['montant'] }} ({{ $['devise'] }})</td>
                <td>{{ $['montant_con'] }}(FCFA)</td>
                @if ($->nom_client)
                <td>{{ $['nom_client'] }}</td>
                <td>{{ $['prenom_client'] }}</td>
                <td>{{ $['profess_client'] }}</td>
                <td>{{ $['tel_client'] }}</td>
                <td>{{ $['banque_client'] }}</td>
                <td>{{ $['num_compt_client'] }}</td>
                @endif
                @if ($->nomsociete)
                <td>{{ $['nomsociete'] }}</td>
                <td>{{ $['categorie'] }}</td>

                <td>{{ $['adresse'] }}</td>

                <td>{{ $['tel_client'] }}</td>
                <td>{{ $['banque_client'] }}</td>
                <td>{{ $['num_compt_client'] }}</td>
@endif
                <td>
               
                @endforeach
                 
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection