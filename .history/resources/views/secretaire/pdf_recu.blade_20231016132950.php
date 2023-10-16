@extends('layout.pdf.header')
@section('content')
<h1>Récépissé</h1>
    <div class="d-flex justify-content-end mb-4">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th>N° Dossier</th>
                    <th>Date </th>
               
                    <th>Montant (Devise)</th>
                    <th>Montant (FCFA)</th>
              

                    @if ($demande->nom_client)
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
          
                    @endif
                 
                    @if ($demande->nomsociete)
                    <th>Nom societé</th>
                    <th>Categorie</th>
            
                    @endif

                </tr>
            </thead>
            <tbody>
                <td>{{ $demande['numero_doss'] }}</td>
                <td>{{ $demande['date'] }}</td>

                <td>{{ $demande['montant'] }} ({{ $demande['devise'] }})</td>
                <td>{{ $demande['montant_con'] }}(FCFA)</td>
                @if ($demande->nom_client)
                <td>{{ $demande['nom_client'] }}</td>
                <td>{{ $demande['prenom_client'] }}</td>
    
                @endif
                @if ($demande->nomsociete)
                <td>{{ $demande['nomsociete'] }}</td>
                <td>{{ $demande['categorie'] }}</td>

@endif
                 
            </tbody>
        </table>
        @php
            $dateOrigine = new DateTime($demande['date']);
// Ajoute 2 jours
$dateModifiee = $dateOrigine->modify('+2 days');
$ladate=$dateModifiee->format('d');
echo "<h3>Votre demande sera prête dans $ladate</h3>";

        @endphp
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection