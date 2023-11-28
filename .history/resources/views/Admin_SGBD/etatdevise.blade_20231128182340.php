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
      $codeToDevise = [
            "AED" => "Dirham des Émirats arabes unis",
            /*   "AFN" => "Afghani afghan",
            "ALL" => "Lek albanais",
            "AMD" => "Dram arménien",
            "ANG" => "Florin des Antilles néerlandaises",
            "AOA" => "Kwanza angolais",
            "ARS" => "Peso argentin",
            "AUD" => "Dollar australien",
            "AWG" => "Florin arubais",
            "AZN" => "Manat azéri",
            "BAM" => "Mark convertible de Bosnie-Herzégovine",
            "BBD" => "Dollar barbadien",
            "BDT" => "Taka bangladais",
            "BGN" => "Lev bulgare",
            "BHD" => "Dinar bahreïni",
            "BIF" => "Franc burundais",
            "BMD" => "Dollar bermudien",
            "BND" => "Dollar de Brunei",
            "BOB" => "Boliviano bolivien",
            "BRL" => "Réel brésilien",
            "BSD" => "Dollar bahaméen",
            "BTN" => "Ngultrum bhoutanais",
            "BWP" => "Pula botswanaise",
            "BYN" => "Rouble biélorusse",
            "BZD" => "Dollar bélizien",
           */  "CAD" => "Dollar canadien",
            /*  "CDF" => "Franc congolais",
            "CHF" => "Franc suisse",
            "CLP" => "Peso chilien", */
            "CNY" => "Yuan chinois",
            /*   "COP" => "Peso colombien",
            "CRC" => "Colón costaricien",
            "CUP" => "Peso cubain",
            "CVE" => "Escudo capverdien",
            "CZK" => "Couronne tchèque",
            "DJF" => "Franc djiboutien",
            "DKK" => "Couronne danoise",
            "DOP" => "Peso dominicain",
           */  "DZD" => "Dinar algérien",
            "EGP" => "Livre égyptienne",
            /*     "ERN" => "Nakfa érythréen",
            "ETB" => "Birr éthiopien", */
            "EUR" => "Euro",
            /* "FJD" => "Dollar fidjien",
            "FKP" => "Livre des îles Malouines",
             */ "GBP" => "Livre sterling",
            /* "GEL" => "Lari géorgien",
            "GGP" => "Livre de Guernesey",
             */ "GHS" => "Cedi ghanéen",
            /* "GIP" => "Livre de Gibraltar",
            "GMD" => "Dalasi gambien",
             */ "GNF" => "Franc guinéen",
            "GTQ" => "Quetzal guatémaltèque",
            /*  "GYD" => "Dollar guyanais",
            "HKD" => "Dollar de Hong Kong",
            "HNL" => "Lempira hondurien",
            "HRK" => "Kuna croate",
            "HTG" => "Gourde haïtienne",
            "HUF" => "Forint hongrois",
            "IDR" => "Roupie indonésienne",
            "ILS" => "Nouveau shekel israélien",
            "IMP" => "Livre de l'île de Man",
            "INR" => "Roupie indienne",
            "IQD" => "Dinar irakien",
            "IRR" => "Rial iranien",
            "ISK" => "Couronne islandaise",
            "JEP" => "Livre de Jersey",
            "JMD" => "Dollar jamaïcain",
            "JOD" => "Dinar jordanien",
            */ "JPY" => "Yen japonais",
            /*  "KES" => "Shilling kényan",
            "KGS" => "Som kirghize",
            "KHR" => "Riel cambodgien",
            "KMF" => "Franc comorien",
            "KPW" => "Won nord-coréen",
            "KRW" => "Won sud-coréen",
            "KWD" => "Dinar koweïtien",
            "KYD" => "Dollar des îles Caïmans",
            "KZT" => "Tenge kazakh",
            "LAK" => "Kip lao",
            "LBP" => "Livre libanaise",
            "LKR" => "Roupie srilankaise",
            "LRD" => "Dollar libérien",
            "LSL" => "Loti lesothan",
            "LTL" => "Litas lituanien",
            "LVL" => "Lats letton",
            "LYD" => "Dinar libyen",
            "MAD" => "Dirham marocain",
            "MDL" => "Leu moldave",
            "MGA" => "Ariary malgache",
            "MKD" => "Denar macédonien",
            "MMK" => "Kyat birman",
            "MNT" => "Tugrik mongol",
            "MOP" => "Pataca de Macao",
            "MRO" => "Ouguiya mauritanien",
            "MUR" => "Roupie mauricienne",
            "MVR" => "Rufiyaa maldivienne",
            "MWK" => "Kwacha malawien",
            "MXN" => "Peso mexicain",
            "MYR" => "Ringgit malais",
            "MZN" => "Métical mozambicain",
            "NAD" => "Dollar namibien",
            */ "NGN" => "Naira nigérian",
            /*  "NIO" => "Cordoba nicaraguayen",
            "NOK" => "Couronne norvégienne",
            "NPR" => "Roupie népalaise",
            */ "NZD" => "Dollar néo-zélandais",
            /*    "OMR" => "Rial omanais",
            "PAB" => "Balboa panaméen",
            "PEN" => "Nouveau sol péruvien",
            "PGK" => "Kina papouanéoguinéen",
            "PHP" => "Peso philippin",
            "PKR" => "Roupie pakistanaise",
            "PLN" => "Zloty polonais",
            "PYG" => "Guarani paraguayen",
            "QAR" => "Rial qatari",
            "RON" => "Leu roumain",
            "RSD" => "Dinar serbe",
            "RUB" => "Rouble russe", */
            "RWF" => "Franc rwandais",
            "SAR" => "Riyal saoudien",
            /*  "SBD" => "Dollar des îles Salomon",
            "SCR" => "Roupie des Seychelles",
            "SDG" => "Livre soudanaise",
            "SEK" => "Couronne suédoise",
            "SGD" => "Dollar de Singapour",
            "SHP" => "Livre de Sainte-Hélène",
            "SLE" => "Leone sierra-léonais",
            "SOS" => "Shilling somalien",
            "SRD" => "Dollar du Surinam",
            "STD" => "Dobra santoméen",
            "SSP" => "Livre sud-soudanaise",
            "SYP" => "Livre syrienne",
            "SZL" => "Lilangeni swazi",
            "THB" => "Baht thaïlandais",
            "TJS" => "Somoni tadjik",
            "TMT" => "Manat turkmène",
            "TND" => "Dinar tunisien",
            "TOP" => "Pa'anga tongan",
            "TRY" => "Livre turque",
            "TTD" => "Dollar de Trinité-et-Tobago",
            "TWD" => "Dollar taïwanais",
            "TZS" => "Shilling tanzanien",
            "UAH" => "Hryvnia ukrainienne",
            "UGX" => "Shilling ougandais",
            "UYU" => "Peso uruguayen",
            "UZS" => "Som ouzbek",
            "VES" => "Bolivar vénézuélien",
            "VND" => "Dong vietnamien",
            "VUV" => "Vatu vanuatais",
            "WST" => "Tala samoan",

            */ "XAF" => "Franc CFA d'Afrique centrale",
            "USD" => "Dollar des États-Unis",

            /*  "YER" => "Rial yéménite",
            "ZAR" => "Rand sud-africain",
            "ZMW" => "Kwacha zambien",
            "ZWL" => "Dollar zimbabwéen", */
        ];

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
      width: 800, // Largeur du graphique en pixels
      height: 500, // Hauteur du graphique en pixels
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