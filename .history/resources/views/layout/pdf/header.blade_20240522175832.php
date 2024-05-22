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
        {{-- <img style="height:50px;" src="{{ asset('images/whiteOfficialLogo.png') }}" alt="Mon Image">
        <img style="height:50px;" src="{{ asset('images/iso.jpg') }}" alt="Mon Image">

        <img style="height:50px;" src="{{ asset('images/logo_DGTCP_2_blanc.png') }}" alt="Mon Image"> --}}
        {{-- <img src="https://i.ibb.co/Mfk8tbX/MEF-removebg-preview.png" style="height:50px;" alt="" />


        <img src="https://i.ibb.co/LR4pkMQ/iso.jpg" style="height:50px;margin-left:150px;" alt="" />


        <img src="https://i.ibb.co/H7xhBVk/dgtcp-removebg-preview.png" style="height:50px;margin-left:200px;" alt="" />
        --}}

        <img src="https://i.ibb.co/FggZsM2/logo-DGTCP-2-blanc-removebg-preview.png"
            style="height:50px;margin-left:200px;" alt="logo-DGTCP-2-blanc-removebg-preview">
        <img src="https://i.ibb.co/Sr7WJ3w/iso.jpg" alt="iso" style="height:50px;margin-left:150px;">

        <img src="https://i.ibb.co/8bK4YTm/white-Official-Logo-removebg-preview.png" >
            <img src="https://i.ibb.co/vwVQTCb/1.jpg" alt="1" border="0">

            <img src="https://i.ibb.co/mbbqYPz/2.jpg" alt="2" border="0">
            <img src="https://i.ibb.co/TY3L6CF/3.jpg" alt="3" style="height:50px;"
            alt="white-Official-Logo-removebg-preview">

    </div>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">




        </nav>
    </header>
    <main class="py-4">


        @yield('content')
    </main>

</body>

</html>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    header {
        padding: 10px;
        background-color: #ccc53f;
    }

    #id_img {
        display: flex;
        justify-content: space-between;

    }



    main {
        padding: 20px;
    }

    .table {
        border: 1px solid #3fcc3f;
        margin-bottom: 30px;
    }

    .table thead {
        background-color: #cc3f3f;
        color: white;
    }

    .table th,
    .table td {
        padding: 8px;
    }

    .table-danger th,
    .table-danger td {
        background-color: #cc3f3f;
    }

    #footer {
        background-color: #ccc53f;
        color: white;
        padding: 20px;
        text-align: center;
    }
</style>