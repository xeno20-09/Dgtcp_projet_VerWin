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
            <img src="{{ asset('chemin_vers_image1.jpg') }}" alt="Image 1">
        </div>
        <div class="col-md-6">
            <img src="{{ asset('chemin_vers_image2.jpg') }}" alt="Image 2">
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
                  <tr>
                      <td>Statut de la demande:</td>
                      <td style="background-color:#cc3f3f">{{ $item['status_dmd'] }}</td>
                  </tr>
                  <tr>
                      <td>Motif:</td>
                      <td style="background-color:#ccab3f">{{ $item['motif'] }}</td>
                  </tr>
              </table>
          </div>
         
        </div>
    </div>

    <!-- Décision -->
    <div class="row">
        <div class="col-md-12">
            <h2>Décision :</h2>
            <!-- Insérez ici la décision associée aux données du formulaire -->
        </div>
    </div>
 @endforeach
    <!-- Signature -->
    <div class="row">
        <div class="col-md-12">
            <h2>Signature :</h2>
            <!-- Insérez ici l'image de la signature ou tout autre contenu de signature -->
        </div>
    </div>
</body>
</html>
















</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection

<style>
    *{
list-style: none;
    }
    .card {
  background-color: #dee2e6;
  border: 1px solid #dee2e6;
  padding: 20px;
  display: flex;
  flex-direction: row;
  max-width: fit-content;
}

.card-header {
  font-size: 18px;
  font-weight: bold;
  background-color: #59cc3f;
  padding: 10px;
  margin-bottom: 10px;
}

.list-group-item {
  padding: 8px;
  border: none;
  background-color: transparent;
}



.list-group-item:last-child {
  margin-bottom: 0;
}

.list-group-item::before {
  color: #0d6efd;
  font-weight: bold;
  display: inline-block;
  width: 1em;
  margin-left: -1em;
}

ul.list-group-flush {
  list-style-type: none;
  padding-left: 0;
}

.gap-3 > li {
  margin-bottom: 15px;
}

</style>