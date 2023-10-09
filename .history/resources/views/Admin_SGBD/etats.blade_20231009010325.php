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
    <td>{{ $total }}</td>

    <div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Devise</th>
                <th>Montant</th>
                <th>Montant Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $lastDevise = null; // Initialisez la variable pour suivre la devise actuelle
                $totalDevise = 0; // Initialisez la variable pour le total de la devise actuelle
            @endphp
    
            @foreach ($groupedDemandes as $devise => $demandesParDevise)
                @foreach ($demandesParDevise as $demande)
                    <tr>
                        <td>{{ $demande->date }}</td>
                        <td>{{ $devise }}</td>
                        <td>{{ $demande->montant }}</td>
                        <td></td> <!-- Réservez cette cellule pour le montant total -->
                    </tr>
                    @php
                        $lastDevise = $devise; // Mettez à jour la devise actuelle
                        $totalDevise += $demande->montant; // Ajoutez le montant à la devise actuelle
                    @endphp
                @endforeach

                <!-- Affichez le total de la devise actuelle sous le groupe de devises -->
                <tr>
                    <td></td>
                    <td>Total {{ $lastDevise }}</td>
                    <td></td> <!-- Laissez cette cellule vide pour le montant individuel -->
                    <td>{{ $totalDevise }}</td>
                </tr>
                
                @php
                    $totalDevise = 0; // Réinitialisez le total pour la prochaine devise
                @endphp
            @endforeach
        </tbody>
    </table>
</div>

        




    @endsection