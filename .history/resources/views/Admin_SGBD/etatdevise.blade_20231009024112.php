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

<a href="lesdevis"><button class="btn btn-primary">Situation sur les devises</button></a>
<a href="lespays"><button class="btn btn-primary">Situation sur les pays</button></a>
<a href="lessocietes"><button class="btn btn-primary">Situation sur les entreprises</button></a>



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
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom de la société</th>
                    <th>Montant total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $dat)
                @if ( $dat->nomsociete!=0)
                   <tr>
                        <td>{{ $dat->nomsociete }}</td>
                        <td>{{ $dat->total }}</td>
                    </tr>  
                @endif
                   
                @endforeach
            </tbody>
        </table>
    </div>

    @endsection