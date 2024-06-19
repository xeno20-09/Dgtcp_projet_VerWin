@extends('layout.chef_bureau.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($admin as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} </a>
    @endforeach
</h1>

    <div class="container">
        @php
            $test = 'Devise';
        @endphp
        <br>
        <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => $test]) }}">Impression</a>
        <br><br>

        <div id="mon-chart"></div>

        <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
    </div>

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Devise', 'Montant Total'], // Deux colonnes : Devise et Montant Total
                @foreach ($categories as $category)
                    @foreach ($codeToDevise as $clef => $valeur)
                        @if ($category->devise == $valeur)
                            @php $category->devise = $clef; @endphp
                        @endif
                    @endforeach
                    ['{{ $category->devise }}', {{ $category->total }}],
                @endforeach

            ]);

            var options = {
                chart: {
                    title: 'Performance des Devises - Montant Total',
                    subtitle: 'Montant Total par Devise',
                },
                bars: 'vertical', // Direction des barres
                width: 700, // Largeur du graphique en pixels
                height: 800, // Hauteur du graphique en pixels
                colors: ['#FF5733', '#33FF57', '#3377FF',
                '#FF33FF'], // Couleurs des barres (vous pouvez ajouter ou supprimer des couleurs)
                hAxis: {
                    title: 'Devises', // Titre de l'axe horizontal
                },
                vAxis: {
                    title: 'Montant Total', // Titre de l'axe vertical
                    minValue: 0, // Valeur minimale de l'axe vertical
                },
                legend: {
                    position: 'top'
                }, // Position de la légende
            };

            var chart = new google.charts.Bar(document.getElementById('mon-chart'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection
