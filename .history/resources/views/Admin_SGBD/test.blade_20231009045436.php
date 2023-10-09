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
      ['Catégorie', 'Valeur'], // Deux colonnes : Catégorie et Valeur
      @for ($i = 0; $i < count($categories); $i++)
      ['{{ $categories[$i]->devise }}', {{ $categories[$i]->total }}], // Ajoutez la valeur appropriée ici
      @endfor
    ]);

    var options = {
        chart: {
    title: 'Performance Catégories - Produits - Ventes',
    subtitle: 'Produits, Ventes pour chaque catégorie',
  },
  bars: 'vertical', // Direction des barres
  width: 800, // Largeur du graphique en pixels
  height: 400, // Hauteur du graphique en pixels
  colors: ['#FF5733', '#33FF57'], // Couleurs des barres
  hAxis: {
    title: 'Catégories', // Titre de l'axe horizontal
  },
  vAxis: {
    title: 'Valeur', // Titre de l'axe vertical
    minValue: 0, // Valeur minimale de l'axe vertical
  },
  legend: { position: 'top' }, // Position de la légende
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