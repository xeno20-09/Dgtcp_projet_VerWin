
<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="px-5 py-4 container-fluid">

            <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => 'Pays']) }}">
                Impression
            </a>

            <br><br>

            <div id="mon-chart"></div>

            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Retour</a>

            <script src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                google.charts.load('current', {
                    packages: ['table']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Pays');
                    data.addColumn('number', 'Montant');
                    data.addColumn('string', 'Devise');
                    data.addColumn('number', 'Montant total');

                    data.addRows([
                        @foreach ($grouped as $dataa)

                            @php
                                $montant = 0;
                                $deviseLabel = '';
                                $totalMontant = 0;

                                foreach ($devise as $d) {
                                    if ($d->nationalite === $dataa->nationalite) {
                                        $montant = $d->montant;
                                        $deviseLabel = $d->devise;
                                    }
                                }

                                foreach ($devise as $subD) {
                                    if ($subD->nationalite === $dataa->nationalite) {
                                        $totalMontant += $subD->montant;
                                    }
                                }
                            @endphp

                                [
                                    "{{ $dataa->nationalite }}",
                                    {{ $montant }},
                                    "{{ $deviseLabel }}",
                                    {{ $totalMontant }}
                                ],
                        @endforeach
                    ]);

                    var chart = new google.visualization.Table(
                        document.getElementById('mon-chart')
                    );

                    chart.draw(data, {
                        showRowNumber: true,
                        width: '100%',
                        height: '100%'
                    });
                }
            </script>

        </div>
    </main>
</x-app-layout>
