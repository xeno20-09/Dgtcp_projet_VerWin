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
    <style>
        img {
            height: 50px;
        }
        .card-header {
            background-color: #3fcc96;
            color: white;
            padding: 10px;
            margin: 0;
        }
        .table {
            background-color: #f5f5f5;
        }
        td {
            padding: 10px;
        }
        .signature-cell {
            background-color: #3fcc96;
            color: white;
            padding: 10px;
            width: 20%;
            text-align: center;
        }
    </style>
    <title></title>
</head>
<body>

  <div  style="display:flex;flex-direction:row;justify-content:space-between;">
    
          <img src="https://i.ibb.co/Mfk8tbX/MEF-removebg-preview.png" style="height:80px;" alt="" />
             
       
          <img src="https://i.ibb.co/LR4pkMQ/iso.jpg"  style="height:80px;margin-left:150px;" alt="" />
      
    
          <img src="https://i.ibb.co/H7xhBVk/dgtcp-removebg-preview.png" style="height:80px;margin-left:100px;" alt="" />
      
  </div>

    <!-- Données du formulaire -->
    <div class="row">
        <div class="col-md-12">
            <h2></h2>
            @foreach ($demande as $item)
            <div style="max-width: fit-content;" class="card-primary mb-3 d-flex flex-row">
              <div class=" " style="">
                <h2 class="card-header">N°Dossier :{{ $item->numero_doss }}</h2>
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
             
                  <tr>
                    <td>Prénom du client:</td>
                    <td>{{ $item-> prenom_client }}</td>
                  </tr>
                  
                  <tr>
                    <td>Profession du client:</td>
                    <td>{{ $item-> profess_client }}</td>                      
                  </tr> 
                  
                  <tr>
                    <td>Téléphone du client:</td>
                    <td>{{ $item-> tel_client }}</td>
                  </tr> 
                  
                  <tr>
                    <td>Banque du client:</td>
                    <td>{{ $item-> banque_client }}</td>
                  </tr> 
                  
                  <tr>
                    <td>Numéro de compte du client:</td>
                    <td>{{ $item-> num_compt_client }}</td>
                  </tr> 
                  
                  <tr>
                    <td>Nom du beneficiaire:</td>
                    <td>{{ $item['nom_benefi'] }}</td>
                  </tr>  
                  
                  <tr>
                    <td>Prenom du beneficiaire:</td>
                    <td>{{ $item['prenom_benefi'] }}</td>
                  </tr> 
                  
                  <tr>
                  <td>Banque du beneficiaire:</td>
                  <td> {{ $item['banque_benefi'] }}</td>
                  </tr> 
                  
                  <tr>
                    <td>Pays du beneficiaire:</td>
                    <td>{{ $item['pays_benifi'] }}</td>
                  </tr> 
                  
                  <tr>
                  <td>Numero de compte du beneficiaire:</td>
                  <td>{{ $item['num_compt_benefi'] }}</td>
                  </tr> 
                </table>
            </div>
            @endforeach
        </div>
      </div>
    </div>

    <!-- Décision -->
    <div class="row">
        <div class="col-md-12">
            <h2>Décision :</h2>
            <table  class="table table-bordered">
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
                <tr>
                    <td class="signature-cell">Signature :</td>
                    <td>DAMF</td>
                </tr>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
