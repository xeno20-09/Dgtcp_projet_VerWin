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
              
                    @foreach($demande as $item)

                    @if ($item->nom)
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
                    <th>Profession du client</th>
                    <th>Téléphone du client</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    @endif
                    @endforeach
                    @foreach($demande as $item)

                    @if ($item['type_prs']=='morale')
                    <th>Nom societé</th>
                    <th>Categorie</th>
                    <th>Adresse</th>
                    <th>Téléphone </th>

                    <th>Banque</th>
                    
                    <th>Numéro de compte </th>
                    @endif
                 @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($demande as $item)
                <td>{{ $item['numero_doss'] }}</td>
                <td>{{ $item['date'] }}</td>
                <td>{{ $item['nature_p'] }}</td>
                <td>{{ $item['nature_op'] }}</td>
                <td>{{ $item['montant'] }} ({{ $item['devise'] }})</td>
                <td>{{ $item['montant_con'] }}(FCFA)</td>
                @if ($item->nom_client)
                <td>{{ $item['nom_client'] }}</td>
                <td>{{ $item['prenom_client'] }}</td>
                <td>{{ $item['profess_client'] }}</td>
                <td>{{ $item['tel_client'] }}</td>
                <td>{{ $item['banque_client'] }}</td>
                <td>{{ $item['num_compt_client'] }}</td>
                @endif
                @if ($item->nomsociete)
                <td>{{ $item['nomsociete'] }}</td>
                <td>{{ $item['categorie'] }}</td>

                <td>{{ $item['adresse'] }}</td>

                <td>{{ $item['tel_client'] }}</td>
                <td>{{ $item['banque_client'] }}</td>
                <td>{{ $item['num_compt_client'] }}</td>
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