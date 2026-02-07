<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="px-5 py-4 container-fluid">

            <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => 'Société']) }}">
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
                    data.addColumn('string', 'Nom de la société');
                    data.addColumn('number', 'Montant');
                    data.addColumn('string', 'Devise');

                    data.addRows([
                        @php
                            $currentSociete = null;
                            $totaux = [];
                        @endphp

                        @foreach ($group as $dat)

                            @if (!empty($dat->nomsociete))

                                {{-- changement de société → afficher les totaux --}}
                                @if ($currentSociete !== null && $currentSociete !== $dat->nomsociete)
                                    @foreach ($totaux as $devise => $montant)
                                        [
                                            "TOTAL {{ $currentSociete }}",
                                            {{ $montant }},
                                            "{{ $devise }}"
                                        ],
                                    @endforeach

                                    @php $totaux = []; @endphp
                                @endif

                                @php
                                    $currentSociete = $dat->nomsociete;

                                    if (!isset($totaux[$dat->devise])) {
                                        $totaux[$dat->devise] = 0;
                                    }

                                    $totaux[$dat->devise] += $dat->total;
                                @endphp

                                {{-- ligne détail --}}
                                    [
                                        "{{ $dat->nomsociete }}",
                                        {{ $dat->total }},
                                        "{{ $dat->devise }}"
                                    ],
                            @endif
                        @endforeach

                        {{-- derniers totaux --}}
                        @if ($currentSociete !== null)
                            @foreach ($totaux as $devise => $montant)
                                [
                                    "TOTAL {{ $currentSociete }}",
                                    {{ $montant }},
                                    "{{ $devise }}"
                                ],
                            @endforeach
                        @endif
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
