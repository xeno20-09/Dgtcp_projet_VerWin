<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title></title>
</head>

<body>
    <div class="d-flex justify-content-between align-items-center text-center p-3 bg-primary text-center text-white"
        style="background-color: rgba(0, 0, 0, 0.2);">
        <img src="{{ asset('images/whiteOfficialLogo.png') }}" alt="Mon Image">
        <img src="{{ asset('images/logo_DGTCP_2_blanc.png') }}" alt="Mon Image">
    </div>

    <div class="container mt-4">
        <div class="alert alert-primary" role="alert">
            Bienvenue sur SAC !
        </div>
        <p>Vous venez de créer un compte sur SAC. Pour activer votre compte, il vous suffit de cliquer sur ce lien :</p>


        <a href="{{ route('login') }}" class="btn btn-primary  text-white">Valider mon compte</a>


        <p>Si vous n'êtes pas à l'origine de la création de ce compte, ne tenez pas compte de cet email. Le compte sera
            automatiquement supprimé.</p>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-center text-white">
        <div class="d-flex justify-content-between align-items-center text-center p-3"
            style="background-color: rgba(0, 0, 0, 0.2);">
            <a style="text-decoration: none;" href="https://finances.bj/">
                <img style="width: 60px;height: 60px;" src="{{ asset('images/iso.jpg') }}" alt="Mon Image">
            </a>
            <span class="text-white">© 2023 Ananyos</span>
        </div>
    </footer>
    <!-- Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-mD+R+teG5dH/wS9TQgG7bhkFt+OHx6lBo8BwHVGsHFKfkuCm29Db/W1yjwvBLRn5" crossorigin="anonymous">
    </script>
</body>

</html>
