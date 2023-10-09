@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États</h1>
        <div class="table-responsive">
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
        </div>

</div>
@endsection