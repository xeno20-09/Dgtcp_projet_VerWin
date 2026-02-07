<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            @php
                $test = 'Devise';
            @endphp
            <br>
            <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => $test]) }}">Impression</a>
            <br><br>

            <div id="mon-chart"></div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
            <script src="https://www.gstatic.com/charts/loader.js"></script>

            <script>
                google.charts.load('current', {
                    'packages': ['bar']
                });

                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    // Define the chart to be drawn.
                    var data = google.visualization.arrayToDataTable([
                        ['Devise', 'Montant Total'],

                        @foreach ($categories as $category)
                            @foreach ($codeToDevise as $clef => $valeur)
                                @if ($category->devise == $valeur)
                                    @php $category->devise = $clef; @endphp
                                @endif
                            @endforeach
                            ["{{ $category->devise }}", {{ $category->total }}],
                        @endforeach

                    ]);

                    var options = {
                        title: 'Performance des Devises - Montant Total',
                        hAxis: {
                            title: 'Devise'
                        },
                        vAxis: {
                            title: 'Montant Total'
                        },
                    };

                    // Instantiate and draw the chart.
                    // var chart = new google.visualization.BarChart(document.getElementById('mon-chart'));
                    var chart = new google.charts.Bar(document.getElementById('mon-chart'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
        </div>
    </main>
</x-app-layout>
