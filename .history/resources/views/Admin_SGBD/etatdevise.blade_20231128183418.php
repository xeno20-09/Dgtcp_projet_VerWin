@extends('layout.chef_bureau.header')
@section('content')
<h1 style="text-align: center;">
  @foreach ($user as $item)
  <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}   <span class="badge rounded-pill badge-notification bg-danger"
    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
  @endforeach

    <div class="container">
        <h1>Gestion des États sur les devises</h1>
        @php
        $test='Devise';
   @endphp
   <br>
   <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => $test]) }}">Impression</a>
<br><br>
  {{--       <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Devise</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedDemandes as $data)
                        <tr>
                            <td>{{ $data->devise }}</td>
                            <td>{{ $data->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}



        <div id="mon-chart"></div>

        <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

     
    </div>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Devise', 'Montant Total'], // Deux colonnes : Devise et Montant Total
      @for ($i = 0; $i < count($categories); $i++)
      @for($codeToDevise as $clef => $valeur)
      @if ($categories[$i]->devise==$valeur)
      $categories[$i]->devise=$clef
      @endif
        {{ $clef }}
    @endfor     
     ['{{ $categories[$i]->devise }}', {{ $categories[$i]->total }}], // Ajoutez la valeur appropriée ici
      @endfor
    ]);

    var options = {
      chart: {
        title: 'Performance des Devises - Montant Total',
        subtitle: 'Montant Total par Devise',
      },
      bars: 'vertical', // Direction des barres
      width: 1000, // Largeur du graphique en pixels
      height: 1000, // Hauteur du graphique en pixels
      colors: ['#FF5733', '#33FF57', '#3377FF', '#FF33FF'], // Couleurs des barres (vous pouvez ajouter ou supprimer des couleurs)
      hAxis: {
        title: 'Devise', // Titre de l'axe horizontal
      },
      vAxis: {
        title: 'Montant Total', // Titre de l'axe vertical
        minValue: 0, // Valeur minimale de l'axe vertical
      },
      legend: { position: 'top' }, // Position de la légende
    };

    var chart = new google.charts.Bar(document.getElementById('mon-chart'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
@endsection