@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États</h1>
         <form action="{{route('listedmd') }}" method="post">  
          @csrf
        <!-- Afficher les états sous forme de cases à cocher -->
        <div class="row ">
      
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de debut</label>
                    <input value="" name="fdate" type="date" class="form-control"
                        id="" aria-describedby="" placeholder="">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de fin</label>
                    <input value="" name="sdate" type="date" class="form-control"
                        id="" aria-describedby="" value="{{ $date }}" placeholder="">
                </div>
            </div>

            <div class="col">
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Etats</label>
                        <select name="status" class="form-select" id="exampleDisabledSelect1">
                            <option>Autorisée</option>
                            <option>Rejetée</option>
                            <option>Suspendu</option>
                            <option>En cours</option>
                        </select>
                    
                </div>
            </div>
            <div class="col">
                <div class="form-group">
             
                                    <button class="btn btn-outline"style="position: relative;
                    top: 56px;" type="submit"><i class="fas fa-search"
                                        style="font-size:25px;"></i></button>
                
            </div>
        </div>
     
        </div>
 </form>

        <!-- Un bouton pour soumettre les états sélectionnés -->
    </div>

    @foreach ($devise as $dev )
    <p>{{ $dev->devise }}</p>
    <p>{{ $dev->montant }}</p>

@endforeach
@foreach ($groupedDemandes as $data )

    <p>{{ $data->devise ." ". $data->total}}</p>
   

@endforeach



<div class="table-responsive">
    <style>
        .table-responsive {
overflow-x: auto;
max-width: 100%;
}

    </style>
    <table class="table-bordered">
        <thead>
            <tr>
                <th>N° Dossier</th>
                <th>Date d'enregistrement</th>
                <th>Nature des produits</th>
                <th>Nature des opérations</th>
                <th>Montant (Devise)</th>
                <th>Contre montant (FCFA)</th>
                @foreach ($demande as $item)
                @if ($item->nom_client)
                <th>Nom du client</th>
                <th>Prénom du client</th>
                <th>Profession du client</th>
                <th>Téléphone du client</th>
                <th>Banque du client</th>
                <th>Numéro de compte du client</th>
                @endif
                @endforeach
                @foreach ($demande as $item)
                @if ($item->nomsociete)
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
    {{--             <th>Motif</th>
                <th>Vu par le vérificateur</th>
                <th>Vu par le chef division</th>
                <th>Date de décision</th>
                <th>Vu par le chef bureau</th>
                <th>Vu par le DAMF</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($demande as $item)
                <tr>
                    <td>{{ $item->numero_doss }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->nature_p }}</td>
                    <td>{{ $item->nature_op }}</td>
                    <td>{{ $item->montant }}</td>
                    <td>{{ $item->montant_con }}({{ $item->devise }})</td>
          
                </tr>
            @endforeach
        </tbody>
    </table>


    @endsection