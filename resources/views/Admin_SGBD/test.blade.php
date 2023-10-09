<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Graphique des Devises</title>
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
      ['Devise', 'Montant Total'], // Deux colonnes : Devise et Montant Total
      @for ($i = 0; $i < count($categories); $i++)
      ['{{ $categories[$i]->devise }}', {{ $categories[$i]->total }}], // Ajoutez la valeur appropriée ici
      @endfor
    ]);

    var options = {
      chart: {
        title: 'Performance des Devises - Montant Total',
        subtitle: 'Montant Total par Devise',
      },
      bars: 'vertical', // Direction des barres
      width: 400, // Largeur du graphique en pixels
      height: 400, // Hauteur du graphique en pixels
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
</html>
