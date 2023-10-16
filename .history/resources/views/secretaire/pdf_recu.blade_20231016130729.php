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
                <td>{{ $deman['numero_doss'] }}</td>
                <td>{{ $deman['date'] }}</td>
                <td>{{ $deman['nature_p'] }}</td>
                <td>{{ $deman['nature_op'] }}</td>
                <td>{{ $deman['montant'] }} ({{ $deman['devise'] }})</td>
                <td>{{ $deman['montant_con'] }}(FCFA)</td>
                @if ($deman->nom_client)
                <td>{{ $deman['nom_client'] }}</td>
                <td>{{ $deman['prenom_client'] }}</td>
                <td>{{ $deman['profess_client'] }}</td>
                <td>{{ $deman['tel_client'] }}</td>
                <td>{{ $deman['banque_client'] }}</td>
                <td>{{ $deman['num_compt_client'] }}</td>
                @endif
                @if ($deman->nomsociete)
                <td>{{ $deman['nomsociete'] }}</td>
                <td>{{ $deman['categorie'] }}</td>

                <td>{{ $deman['adresse'] }}</td>

                <td>{{ $deman['tel_client'] }}</td>
                <td>{{ $deman['banque_client'] }}</td>
                <td>{{ $deman['num_compt_client'] }}</td>
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