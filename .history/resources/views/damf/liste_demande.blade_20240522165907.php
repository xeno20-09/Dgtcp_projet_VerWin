@extends('layout.damf.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
        <h1>Liste des demandes approuvés </h1>

        <table class="table ">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Date:</th>
                    <th scope="col">Nom Secretaire:</th>
                    <th scope="col">Nom Verificateur:</th>
                    <th scope="col">Nom Chef Division:</th>
                    <th scope="col">Nom Chef Service:</th>

                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Status:</th>
                    <th scope="col">Actions</span></th>


                </tr>
            </thead>
            <tbody>

                @foreach ($demande as $item)
                    <tr class="table-success">

                        <td> {{ $item->numero_doss }}</td>
                        <td> {{ $item->date }}</td>
                        @foreach ($jointure as $itemc)
                            <td> {{ $itemc->firstname }} {{ $itemc->lastname }} </td>
                        @break
                    @endforeach
                    @foreach ($jointure1 as $itemd)
                        <td> {{ $itemd->firstname }} {{ $itemd->lastname }} </td>
                    @break
                @endforeach
                @foreach ($jointure2 as $iteme)
                    <td> {{ $iteme->firstname }} {{ $iteme->lastname }} </td>
                @break
            @endforeach
            @foreach ($jointure3 as $iteme)
                <td> {{ $iteme->firstname }} {{ $iteme->lastname }} </td>
            @break
        @endforeach

        <td> {{ $item['montant'] }}</td>
        <td>{{ $item['devise'] }}</td>
        <td>{{ $item['montant_con'] }}</td>
        <td>{{ $item->status_dmd }}</td>
        <td>

            <a href="{{ route('formulaireda_demande_mj', ['id' => $item['id']]) }} " class="table-link">
                <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                </span>
            </a>

        </td>

        <td>
            <a style="width: auto; height:fit-content;"
                href="{{ route('detailles_dmd', ['id' => $item->id]) }}" class="btn btn-primary">Voir</a>
        </td>




    </tr>
@endforeach
</tbody>
</table>

</div>


<br>
<br>
@endsection
