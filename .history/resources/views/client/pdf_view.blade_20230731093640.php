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
            <h2>Données du formulaire :</h2>
            <!-- Insérez ici les données du formulaire que vous avez collectées -->
        </div>
    </div>

    <!-- Décision -->
    <div class="row">
        <div class="col-md-12">
            <h2>Décision :</h2>
            <!-- Insérez ici la décision associée aux données du formulaire -->
        </div>
    </div>

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