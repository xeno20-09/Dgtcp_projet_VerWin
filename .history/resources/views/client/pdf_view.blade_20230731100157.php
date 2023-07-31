<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <title></title>
</head>
<body>
    <!-- En-tête avec les deux images -->
    <div style="display:flex;gap:50" class="row">
        <div class="col-md-6">
            <img src="https://i.goopics.net/bxxd94.png" style="" alt="" />
            <img src="https://i.goopics.net/1y3z56.png"  style="" alt="" />
        </div>
     
    </div>

    <!-- Données du formulaire -->
    <div class="row">
        <div class="col-md-12">
            <h2>Données du formulaire :</h2>
            @foreach ($demande as $item)
            <div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">
                <h3 class="card-header">N°Dossier :{{ $item->numero_doss }}</h3>
                <table class="table table-bordered">
                    <tr>
                        <td>Date d'enregistrement:</td>
                        <td>{{ $item->date }}</td>
                    </tr>
                    <!-- Ajoutez ici les autres lignes pour les autres champs du formulaire -->
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
                    <tr>
                        <td>Nom du client:</td>
                        <td>{{ $item->nom_client }}</td>
                    </tr>
                    <!-- Ajoutez ici les autres lignes pour les autres champs du formulaire -->
                </table>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Décision -->
    <div class="row">
        <div class="col-md-12">
            <h2>Décision :</h2>
            <table class="table table-bordered">
                @foreach ($demande as $item)
                <tr>
                    <td>Statut de la demande:</td>
                    <td style="background-color:#cc3f3f">{{ $item['status_dmd'] }}</td>
                </tr>
                <tr>
                    <td>Motif:</td>
                    <td style="background-color:#3fcc96">{{ $item['motif'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Signature -->
    <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
          <tr >
            <td>Signature :</td>
            <td style="background-color:#3fcc96;"> DAMF</td>
        </tr> 
          </table>           
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
