@extends('layout.chef_division.header')
@section('content')


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
           
       





    </div>


    <br>
    <br>
@endsection
