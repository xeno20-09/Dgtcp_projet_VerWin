@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nationalité</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped as $dataa)
                        <tr>
                            <td>{{ $dataa->nationalite }}</td>
                            <td>{{ $dataa->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        