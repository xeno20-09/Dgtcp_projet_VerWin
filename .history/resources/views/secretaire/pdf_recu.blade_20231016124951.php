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
                    @if ($type_prs=='Physique')
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
                    <th>Profession du client</th>
                    <th>Téléphone du client</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    @endif
             
                    @if ($type_prs=='')
                    <th>Nom societé</th>
                    <th>Categorie</th>
                    <th>Adresse</th>
                    <th>Téléphone </th>

                    <th>Banque</th>
                    
                    <th>Numéro de compte </th>
                    @endif
                    @endforeach
                    <th>Pieces jointes</th>
                    @if ($pieces)
    
                    <th>References pieces:</th>
                    <th>Montant initial:</th>
                    <th>Montant ligne:</th>
                    <th>Montant restant:</th>
                    
@endif

                    <th>Nom du beneficiaire</th>
                    <th>Prenom du beneficiaire</th>
                    <th>Banque du beneficiaire</th>
                    <th>Pays du beneficiaire</th>
                    <th>Numéro de compte du beneficiaire</th>
                    <th>Position de la demande</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->poste }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
               
                @endforeach
                 
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection