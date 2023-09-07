<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <title></title>
</head>
<body>
    <div class="container mt-4">
        <h1>Gestion des États</h1>
        
        <!-- Afficher les états sous forme de cases à cocher -->
        <div class="row">
         
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de debut</label>
                    <input value="" name="date_depot" type="date" class="form-control"
                        id="" aria-describedby="" placeholder="">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de fin</label>
                    <input value="" name="date_depot" type="date" class="form-control"
                        id="" aria-describedby="" placeholder="">
                </div>
            </div>

            <div class="col">
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Example disabled select</label>
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
                    <button class="btn btn-primary mt-6" id="submitBtn">Valider</button>

                
            </div>
        </div>

        </div>


        <!-- Un bouton pour soumettre les états sélectionnés -->
    </div>

<!-- Footer -->
<footer class="bg-primary text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
  
  
      <!-- Section: Form -->
      <section class="">
        <form action="">
          <!--Grid row-->
          <div class="row d-flex justify-content-center">
            <!--Grid column-->
            <!--      <div class="col-auto">
              <p class="pt-2">
                <strong>Sign up for our newsletter</strong>
              </p>
            </div> -->
            <!--Grid column-->
  
            <!--Grid column-->
            <!--    <div class="col-md-5 col-12"> -->
            <!-- Email input -->
            <!--    <div class="form-outline form-white mb-4">
                <input type="email" id="form5Example21" class="form-control" />
                <label class="form-label" for="form5Example21">Email address</label>
              </div>
            </div> -->
            <!--Grid column-->
  
            <!--Grid column-->
            <!--   <div class="col-auto"> -->
            <!-- Submit button -->
            <!--     <button type="submit" class="btn btn-outline-light mb-4">
                Subscribe
              </button>
            </div> -->
            <!--Grid column-->
          </div>
          <!--Grid row-->
        </form>
      </section>
      <!-- Section: Form -->
  
      <!-- Section: Text -->
      <section class="mb-4">
        <p style="gap: 150px;display: inline-flex;">
  
          <img src="{{ asset('images/logo_DGTCP_2_blanc.png') }}" alt="Mon Image">
          <img style="width: 60px;height: 60px;" src="{{ asset('images/iso.jpg') }}" alt="Mon Image">
  
        </p>
      </section>
      <!-- Section: Text -->
  
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Actualités</h5>
  
            <ul class="list-unstyled mb-0">
              <li id="menu-item-574" class="menu-item menu-item-type-post_type_archive menu-item-object-communiques menu-item-574 nav-item"><a href="https://finances.bj/communiques/" class="nav-link">Communiqués</a></li>
              <li id="menu-item-1475" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1475 nav-item"><a href="https://finances.bj/category/non-classifiee/rapports/" class="nav-link">Rapports</a></li>
              <li id="menu-item-1474" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1474 nav-item"><a href="https://finances.bj/category/non-classifiee/presse/" class="nav-link">Point de Presse</a></li>
  
  
            </ul>
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Médiathèque</h5>
  
            <ul class="list-unstyled mb-0">
              <li id="menu-item-5723" class="menu-item menu-item-type-taxonomy menu-item-object-type_document menu-item-5723 nav-item"><a href="https://finances.bj/type_document/finances-publiques/" class="nav-link">Finances publiques</a></li>
              <li id="menu-item-5724" class="menu-item menu-item-type-taxonomy menu-item-object-type_document menu-item-5724 nav-item"><a href="https://finances.bj/type_document/textes-et-lois/" class="nav-link">Textes et lois</a></li>
  
  
            </ul>
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Le Ministère</h5>
  
            <ul class="list-unstyled mb-0">
              <li id="menu-item-243" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-243 nav-item"><a href="https://finances.bj/le-ministre/" class="nav-link">Le Ministre</a></li>
              <li id="menu-item-244" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-244 nav-item"><a href="https://finances.bj/decret-du-ministere/" class="nav-link">Décret du Ministère</a></li>
              <li id="menu-item-245" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-245 nav-item"><a href="https://finances.bj/?page_id=225" class="nav-link">Cabinet du Ministre</a></li>
  
  
            </ul>
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Services</h5>
  
            <ul class="list-unstyled mb-0">
              <li>
                <i class="service-icon icon-registration"></i>
                <a style="text-decoration:none; color:white;" href="https://finances.bj/services/attestation-daffiliation-au-fnrb/">
                  Attestation d’affiliation au FNRB
                </a>
              </li>
              <li>
                <i class="service-icon  icon-attestation"></i>
                <a style="text-decoration:none; color:white;" href="https://finances.bj/services/autorisation-de-change-pour-reglement-de-prestataire-de-services-par-une-association/">
                  Autorisation de change pour règlement de...
                </a>
              </li>
              <li>
                <i class="service-icon icon-company"></i>
                <a style="text-decoration:none; color:white;" href="https://finances.bj/services/agrement-de-change-manuel-pour-les-personnes-morales/">
                  Agrément de change manuel pour les personnes morales
                </a>
              </li>
              <li>
                <i class="service-icon icon-group"></i>
                <a style="text-decoration:none; color:white;" href="https://finances.bj/services/agrement-de-change-manuel-pour-les-personnes-physiques/">
                  Agrément de change manuel pour les personnes physiques
                </a>
              </li>
  
              <li>
                <i class="service-icon icon-classroom"></i>
                <a style="text-decoration:none; color:white;" href="https://finances.bj/services/autorisation-de-change-pour-reglement-frais-de-scolarite-renouvellement-dinscription-2/">
                  Autorisation de change pour règlement frais de scolarité...
                </a>
              </li>
  
              <li>
                <i class="service-icon icon-full-family"></i>
                <a style="text-decoration:none; color:white;" href="https://finances.bj/services/autorisation-de-change-pour-le-reglement-des-cotisations-au-profit-des-organisations-internationales/">
                  Autorisation de change pour le règlement des cotisations ...
                </a>
              </li>
            </ul>
  
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
  
      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>
  
      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>
  
      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>
  
      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
  
      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
    </section>
    <!-- Section: Social media -->
    <!-- Copyright -->
    <div class="d-flex justify-content-between align-items-center text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      <a style="text-decoration: none;" href="https://finances.bj/">
        <img src="{{ asset('images/whiteOfficialLogo.png') }}" alt="Mon Image">
      </a>
      <span class="text-white">© 2023 Copyright: Ananyos@2023</span>
    </div>
  
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  </body>
  </html>