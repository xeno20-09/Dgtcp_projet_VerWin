<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mettez vos balises meta, liens CSS, et autres ici -->
    <title>SAC</title>
    <link rel="icon" href="https://i.ibb.co/ZV8gVN8/pieces-de-monnaie.png" type="image/x-icon">
</head>

<body>
    <!-- Navigation -->
    @include('layout.secretaire.navbar')

    <!-- Contenu principal -->
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>

        @foreach ($user as $item)
            @include('layout.secretaire.search-form', ['item' => $item])
        @endforeach
    </div>

    <!-- Pied de page -->
    @include('layout.secretaire.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
