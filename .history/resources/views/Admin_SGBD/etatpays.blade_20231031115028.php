@extends('layout.Admin.header')

@section('content')
<div class="container">
    <h1>Gestion des États sur les pays</h1>
    @php
        $test = 'Pays';
    @endphp
    <br>
    <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => $test]) }}">Impression</a>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nationalité</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped as $dataa)
                    <tr>
                        
                        <td>{{ $dataa->nationalite }}</td>
                        <td>
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach ($devise as $d)
                                        @if ($dataa->nationalite == $d->nationalite)
                                            <tr>
                                                <td>{{ $d->montant }} {{ $d->devise }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                                $totalMontant = 0; // Initialiser la somme des montants
                            @endphp

                            @foreach ($devise as $subD)
                                @if ($subD->nationalite == $dataa->nationalite)
                                    @php
                                        $totalMontant += $subD->montant; // Ajouter le montant à la somme
                                    @endphp
                                @endif
                            @endforeach

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Montant total :</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $totalMontant }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a style="width: auto; height: fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
</div>
@endsection





import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  TextEditingController _hourController = TextEditingController();
  TextEditingController _minuteController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Enregistrement de l\'heure'),
      ),
      body: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: BoxDecoration(
          image: DecorationImage(
            image: AssetImage('Lumina.png'),
            fit: BoxFit.cover,
          ),
        ),
        child: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              // Champ de texte pour l'heure
              Padding(
                padding: EdgeInsets.all(10.0),
                child: TextField(
                  controller: _hourController,
                  decoration: InputDecoration(
                    labelText: 'Heure',
                    hintText: 'HH:MM',
                  ),
                ),
              ),
              // Champ de texte pour les minutes
              Padding(
                padding: EdgeInsets.all(10.0),
                child: TextField(
                  controller: _minuteController,
                  decoration: InputDecoration(
                    labelText: 'Minutes',
                    hintText: '00',
                  ),
                ),
              ),
              // Bouton pour enregistrer
              ElevatedButton(
                onPressed: () {
                  // Récupérer l'heure et les minutes saisies
                  String hour = _hourController.text;
                  String minute = _minuteController.text;

                  // Faites quelque chose avec l'heure et les minutes, par exemple, les imprimer
                  print('Heure : $hour:$minute');
                },
                child: Text('Enregistrer'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
