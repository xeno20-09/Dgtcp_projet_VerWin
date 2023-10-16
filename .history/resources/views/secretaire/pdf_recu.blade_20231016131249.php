@extends('layout.pdf.header')
@section('content')
<h1>Récépissé</h1>
<div class="table-responsive">
    <style>
        .table-responsive {
overflow-x: auto;
max-width: 100%;
}

    </style>
    <table class="table-bordered">
            <thead>
                <tr class="table-danger">
                    <th>N° Dossier</th>
                    <th>Date d'enregistrement</th>
               
                    <th>Montant (Devise)</th>
                    <th>Contre montant (FCFA)</th>
              

                    @if ($demande->nom_client)
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
          
                    @endif
                 
                    @if ($demande->nomsociete)
                    <th>Nom societé</th>
            
                    @endif
                </tr>
            </thead>
            <tbody>
                <td>{{ $demande['numero_doss'] }}</td>
                <td>{{ $demande['date'] }}</td>
                <td>{{ $demande['nature_p'] }}</td>
                <td>{{ $demande['nature_op'] }}</td>
                <td>{{ $demande['montant'] }} ({{ $demande['devise'] }})</td>
                <td>{{ $demande['montant_con'] }}(FCFA)</td>
                @if ($demande->nom_client)
                <td>{{ $demande['nom_client'] }}</td>
                <td>{{ $demande['prenom_client'] }}</td>
                <td>{{ $demande['profess_client'] }}</td>
                <td>{{ $demande['tel_client'] }}</td>
                <td>{{ $demande['banque_client'] }}</td>
                <td>{{ $demande['num_compt_client'] }}</td>
                @endif
                @if ($demande->nomsociete)
                <td>{{ $demande['nomsociete'] }}</td>
                <td>{{ $demande['categorie'] }}</td>

                <td>{{ $demande['adresse'] }}</td>

                <td>{{ $demande['tel_client'] }}</td>
                <td>{{ $demande['banque_client'] }}</td>
                <td>{{ $demande['num_compt_client'] }}</td>
@endif
                <td>
               
                 
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection