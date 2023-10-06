@extends('layout.chef_division.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}   <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>

        <table class="table ">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
          
                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Date:</th>
                    <th scope="col">Nom Secretaire:</th>
                    <th scope="col">Nom Verificateur:</th>

              
                    <th scope="col">Status:</th>
                    <th scope="col">Actions</span></th>

                </tr>
            </thead>
            <tbody>

                @foreach ($demande as $item)
                   <?php
                        $verif = $item['status_dmd'];
                        $motif=$item['motif']
                        ?>
    
                 {{--    @if ($verif == 'En cours')
                    <tr class="table-primary">
                        <td> {{ $item->numero_doss }}</td>
                        <td> {{ $item->nom_client }}</td>
                        <td> {{ $item->prenom_client }}</td>
                        <td> {{ $item['montant'] }}</td>
                        <td>{{ $item['devise'] }}</td>
                        <td>{{ $item['montant_con'] }}</td>
                        <td> {{ $item->date }}</td>
                        @foreach ($jointure as $itemc)
                            <td> {{ $itemc->name }}</td>
                            @break
                        @endforeach
                        @foreach ($jointure1 as $itemd)
                        <td> {{ $itemd->name }}</td>
                        @break
                    @endforeach
                          <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->prenom_benefi }}</td>
                        <td>{{ $item->status_dmd }}</td>

                        
<td>

    <a href="{{ route('formulairecd_demande_mj', ['id' => $item['id']]) }} " class="table-link">
        <span class="fa-stack">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
        </span>
    </a>

</td>
<td>
    <a style="width: auto; height:fit-content;"
        href="{{ url('detailles_demandes', ['id' => $item->id]) }}"
        class="btn btn-primary">Voir</a>
</td>
                    </tr>
                    @elseif($verif == 'Autorisée') --}}
                    <tr class="table-success">
                            <td> {{ $item->numero_doss }}</td>
                        
                            <td> {{ $item['montant'] }}</td>
                            <td>{{ $item['devise'] }}</td>
                            <td>{{ $item['montant_con'] }}</td>
                            <td> {{ $item->date }}</td>
                    
                        @foreach ($jointure as $itemc)
                        <td> {{ $itemc->firstname }} {{ $itemc->lastname}} </td>                       @break
                @endforeach
                @foreach ($jointure1 as $itemd)
                    <td> {{ $itemd->firstname }} {{ $itemd->lastname}} </td>                   @break
            @endforeach
                          
                        <td>{{ $item->status_dmd }}</td>

                        
<td>

    <a href="{{ route('formulairecd_demande_mj', ['id' => $item['id']]) }} " class="table-link">
        <span class="fa-stack">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
        </span>
    </a>

</td>
<td>
    <a style="width: auto; height:fit-content;"
        href="{{ url('detailles_demandes', ['id' => $item->id]) }}"
        class="btn btn-primary">Voir</a>
</td>
                    </tr>
                       {{--      @elseif($verif == 'Suspendu')
                            <tr class="table-warning">  <td> {{ $item->numero_doss }}</td>
                                <td> {{ $item->nom_client }}</td>
                                <td> {{ $item->prenom_client }}</td>
                                <td> {{ $item['montant'] }}</td>
                                <td>{{ $item['devise'] }}</td>
                                <td>{{ $item['montant_con'] }}</td>
                                <td> {{ $item->date }}</td>
                                @foreach ($jointure as $itemc)
                                    <td> {{ $itemc->name }}</td>
                                @break
                                @endforeach
                                @foreach ($jointure1 as $itemd)
                                <td> {{ $itemd->name }}</td>
                                @break
                            @endforeach
                                  <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->prenom_benefi }}</td>
                        <td>{{ $item->status_dmd }}</td>
                        
<td>

    <a href="{{ route('formulairecd_demande_mj', ['id' => $item['id']]) }} " class="table-link">
        <span class="fa-stack">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
        </span>
    </a>

</td>
<td>
    <a style="width: auto; height:fit-content;"
        href="{{ url('detailles_demandes', ['id' => $item->id]) }}"
        class="btn btn-primary">Voir</a>
</td>
                    </tr>
                                

                </tr>
                @elseif($motif == 'Rejetée pour incorformité au niveau des montants')
                <tr class="table-dark"> <td> {{ $item->numero_doss }}</td>
                    <td> {{ $item->nom_client }}</td>
                    <td> {{ $item->prenom_client }}</td>
                    <td> {{ $item['montant'] }}</td>
                    <td>{{ $item['devise'] }}</td>
                    <td>{{ $item['montant_con'] }}</td>
                    <td> {{ $item->date }}</td>
                    @foreach ($jointure as $itemc)
                        <td> {{ $itemc->name }}</td>
                    @break
                    @endforeach
                    @foreach ($jointure1 as $itemd)
                    <td> {{ $itemd->name }}</td>
                    @break
                @endforeach
                      <td>{{ $item->nom_benefi }}</td>
        <td>{{ $item->prenom_benefi }}</td>
            <td>{{ $item->status_dmd }}</td>
            
<td>

<a href="{{ route('formulairecd_demande_mj', ['id' => $item['id']]) }} " class="table-link">
<span class="fa-stack">
<i class="fa fa-square fa-stack-2x"></i>
<i class="fas fa-pen fa-stack-1x fa-inverse"></i>
</span>
</a>

</td>
<td>
<a style="width: auto; height:fit-content;"
href="{{ url('detailles_demandes', ['id' => $item->id]) }}"
class="btn btn-primary">Voir</a>
</td>
        </tr>
    
                                @else
                                <tr class="table-danger">
                                      <td> {{ $item->numero_doss }}</td>
                                    <td> {{ $item->nom_client }}</td>
                                    <td> {{ $item->prenom_client }}</td>
                                    <td> {{ $item['montant'] }}</td>
                                    <td>{{ $item['devise'] }}</td>
                                    <td>{{ $item['montant_con'] }}</td>
                                    <td> {{ $item->date }}</td>
                                    @foreach ($jointure as $itemc)
                                        <td> {{ $itemc->name }}</td>
                                    @break
                                    @endforeach
                                    @foreach ($jointure1 as $itemd)
                                    <td> {{ $itemd->name }}</td>
                                    @break
                                @endforeach
                                      <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->prenom_benefi }}</td>
                        <td>{{ $item->status_dmd }}</td>
                        
<td>

    <a href="{{ route('formulairecd_demande_mj', ['id' => $item['id']]) }} " class="table-link">
        <span class="fa-stack">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
        </span>
    </a>

</td>
<td>
    <a style="width: auto; height:fit-content;"
        href="{{ url('detailles_demandes', ['id' => $item->id]) }}"
        class="btn btn-primary">Voir</a>
</td>
                    </tr>
    
                    @endif
 --}}                @endforeach
            </tbody>
</table>

</div>

<br>
<br>
@endsection
