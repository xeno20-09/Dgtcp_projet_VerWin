@extends('layout.chef_division.header')
@section('content')

<button type="button" style="position: relative;top: 100px; left:100px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertionModal">
    Ajouter une devise             
 </button>

 <div class="modal fade" id="insertionModal" tabindex="-1" aria-labelledby="insertionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertionModalLabel">Ajouter de la devise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @foreach ($user as $item)
            <form action="{{ route('adddevises', ['id' => $item->id]) }}" method="POST" class="card-body cardbody-color p-lg-5">
               @endforeach
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="devise">Devise</label>
                        <input type="text" class="form-control" id="devise" name="devise" placeholder="Entrez le nom de la devise" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}  <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
     

 {{--        <a href="{{ route('adddevises', ['id' => $item->id]) }}" data-bs-toggle="modal">
            <button type="button" data-bs-toggle="modal" class="btn btn-primary">Ajouter une devise</button>
        </a> --}}

          
            
            <form action="{{ route('addcours', ['id' => $item->id]) }}" method="Post"
                class="card-body cardbody-color p-lg-5">

                @csrf
                <legend>Cours des devises contre Franc CFA à appliquer aux transferts</legend>

                <div class="row">
                    <hr>


                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Date </label>
                            <input  name="date" type="date" class="form-control"
                                id="" aria-describedby="" placeholder="Date">
                        </div>
                    </div>
                    <div class="col">                        
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Devises</label>
                            <select style="top: 0px;" class="form-select position-relative" name="devise"
                            aria-label="Default select example" required>
                            <option value="null">devises?</option>
                            @foreach ($devise as $name )
                            <option value="{{$name->nom}}">{{$name->nom}}</option>
                            @endforeach
   
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Valeurs</label>

                            <input value="" name="valeur" type="text" class="form-control" id="" placeholder="Cours">

                           

                        </div>
                    </div>

                </div>
             



                <br>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
           
       

            <div class="table-responsive">
                <style>
                    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }
    
                </style>
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th>Devise</th>
                            <th>Valeur</th>
                        </tr>
                </thead>
                <tbody>
                    @foreach ($devise as $dev)
                        <tr>
                            <td>{{ $item->devise }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->nature_p }}</td>
                            <td>{{ $item->nature_op }}</td>
                            <td>{{ $item->montant }}</td>
                            <td>{{ $item->montant_con }} ({{ $item->devise }})</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
    </div>




    </div>


    <br>
    <br>
@endsection
