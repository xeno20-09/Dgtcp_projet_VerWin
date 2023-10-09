<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>

@section('script')

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Catégorie' ]
      @foreach ($categorie as $category) // On parcourt les catégories
      [ {{ $category->devise }} ]
      @endforeach
    ]);

    var options = {
      chart: {
        title: 'Performance Catégories - Produits - Ventes',
        subtitle: 'Produits, Ventes pour chaque catégorie',
      },
      bars: 'vertical' // Direction "verticale" pour les bars
    };

    var chart = new google.charts.Bar(document.getElementById('mon-chart'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>


@endsection

</html>