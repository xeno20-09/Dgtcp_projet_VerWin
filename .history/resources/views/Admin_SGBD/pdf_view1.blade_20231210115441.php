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
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <title>SAC</title>
    <link rel="icon" href="https://i.ibb.co/ZV8gVN8/pieces-de-monnaie.png" type="image/x-icon">
</head>

<body>

    <div style="display:flex;flex-direction:row;justify-content:space-between;">

        <img src="https://i.ibb.co/Mfk8tbX/MEF-removebg-preview.png" style="height:50px;" alt="" />


        <img src="https://i.ibb.co/LR4pkMQ/iso.jpg" style="height:50px;margin-left:150px;" alt="" />


        <img src="https://i.ibb.co/H7xhBVk/dgtcp-removebg-preview.png" style="height:50px;margin-left:200px;"
            alt="" />

    </div>
    <br>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">

        </nav>
    </header>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Date:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Status:</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($demande as $item)
                    <tr class="table">
                        <td> {{ $item->numero_doss }}</td>
                        <td> {{ $item->date }}</td>
                        <td> {{ $item['montant'] }} {{ $item['devise'] }}</td>
                        <td>{{ $item['montant_con'] }}</td>
                        <td>{{ $item->status_dmd }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
<style>
    img {
        height: 50px;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    header {
        padding: 10px;
        background-color: #ccc53f;
    }




    main {
        padding: 20px;
    }

    .table {
        border: 1px solid #3fcc3f;
        margin-bottom: 30px;
    }
</style>

{{-- @endsection --}}
