<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="mon-chart"></div>

</body>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
  var data = google.visualization.arrayToDataTable([
      ['Catégorie', 'Valeur'],
for
      @foreach ($categories as $category)
      [{{ $category->devise }}, {{ $category->total}}], // Ajoutez la valeur appropriée ici
      @endforeach
    ]);

    var options = {
      chart: {
        title: 'Performance Catégories - Produits - Ventes',
        subtitle: 'Produits, Ventes pour chaque catégorie',
      },
      bars: 'vertical'
    };/* 
    var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };
 */
    var chart = new google.charts.Bar(document.getElementById('mon-chart'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>



</html>