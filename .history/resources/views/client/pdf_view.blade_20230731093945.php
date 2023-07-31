@extends('layout.pdf.header')
@section('content')



<!DOCTYPE html>
<html>
<head>
    <title>Exemple de PDF</title>
    <!-- Inclure les fichiers CSS de Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <!-- En-tête avec les deux images -->
    <div class="row">
        <div class="col-md-6">
          <img src="https://i.goopics.net/bxxd94.png" style="height:60px" alt="" />
        </div>
        <div class="col-md-6">
          <img src="https://i.goopics.net/1y3z56.png"  style="height:60px; position:relative;left:200px;" alt="" />
        </div>
      
    </div>

    <!-- Données du formulaire -->
    <div class="row">
        <div class="col-md-12">
          @foreach ($demande as $item)
          <div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">
          
              <h3 class="card-header">N°Dossier :{{ $item->numero_doss }}</h3>
              <table class="table table-bordered">
                  <tr>
                      <td>Date d'enregistrement:</td>
                      <td>{{ $item->date }}</td>
                  </tr>
                  <tr>
                      <td>Nature des produits:</td>
                      <td>{{ $item->nature_p }}</td>
                  </tr>
                  <tr>
                      <td>Nature des opérations:</td>
                      <td>{{ $item->nature_op }}</td>
                  </tr>
                  <tr>
                      <td>Montant en FCFA:</td>
                      <td>{{ $item->montant }}</td>
                  </tr>
                  <tr>
                      <td>Contre montant:</td>
                      <td>{{ $item->montant_con }}{{ $item->devise }}</td>
                  </tr>
                  <!-- Ajoutez ici les autres lignes pour les autres champs du formulaire -->
                  <tr>
                      <td>Nom du client:</td>
                      <td>{{ $item->nom_client }}</td>
                  </tr>
                  <tr>
                      <td>Prénom du client:</td>
                      <td>{{ $item->prenom_client }}</td>
                  </tr>
                  <tr>
                      <td>Profession du client:</td>
                      <td>{{ $item->profess_client }}</td>
                  </tr>
                  <tr>
                      <td>Téléphone du client:</td>
                      <td>{{ $item->tel_client }}</td>
                  </tr>
                  <tr>
                      <td>Banque du client:</td>
                      <td>{{ $item->banque_client }}</td>
                  </tr>
                  <tr>
                      <td>Numéro de compte du client:</td>
                      <td>{{ $item->num_compt_client }}</td>
                  </tr>
                  <tr>
                      <td>Nom du bénéficiaire:</td>
                      <td>{{ $item['nom_benefi'] }}</td>
                  </tr>
                  <tr>
                      <td>Prénom du bénéficiaire:</td>
                      <td>{{ $item['prenom_benefi'] }}</td>
                  </tr>
                  <tr>
                      <td>Banque du bénéficiaire:</td>
                      <td>{{ $item['banque_benefi'] }}</td>
                  </tr>
                  <tr>
                      <td>Pays du bénéficiaire:</td>
                      <td>{{ $item['pays_benefi'] }}</td>
                  </tr>
                  <tr>
                      <td>Numéro de compte du bénéficiaire:</td>
                      <td>{{ $item['num_compt_benefi'] }}</td>
                  </tr>
                 
              </table>
          </div>
         
        </div>
    </div>

    <!-- Décision -->
    <div class="row">
        <div class="col-md-12">
            <h2>Décision :</h2>
            <tr>
              <td>Statut de la demande:</td>
              <td style="background-color:#cc3f3f">{{ $item['status_dmd'] }}</td>
          </tr>
          <tr>
              <td>Motif:</td>
              <td style="background-color:#ccab3f">{{ $item['motif'] }}</td>
          </tr>
                </div>
    </div>
 @endforeach
    <!-- Signature -->
    <div class="row">
        <div class="col-md-12">
            <h2>Signature :</h2>
            DAMF
        </div>
    </div>
</body>
</html>











</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
