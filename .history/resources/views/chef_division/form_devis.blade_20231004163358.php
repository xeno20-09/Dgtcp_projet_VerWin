@extends('layout.chef_division.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
     


            <form action="" method="Post"
                class="card-body cardbody-color p-lg-5">

                @csrf
                <legend>Cours des devises contre Franc CFA à appliquer aux transferts</legend>

                <div class="row">
                    <hr>


                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Date </label>
                            <input  name="date_depot" type="date" class="form-control"
                                id="" aria-describedby="" placeholder="Date">
                        </div>
                    </div>
                    <div class="col">                        
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Devises</label>
                            <select style="top: 0px;" class="form-select position-relative" name="banque_client"
                            aria-label="Default select example" required>
            <option value="null">Selectionner une devise</option>
            <option value="Euro">Euro</option>
            <option value="Dollar us">Dollar us</option>
            <option value="Yen japonais">Yen japonais</option>
            <option value="Livre sterling">Livre sterling</option>
            <option value="Franc suisse">Franc suisse</option>
            <option value="Dollar canadien">Dollar canadien</option>
            <option value="Yuan chinois">Yuan chinois</option>
            <option value="Dirham Emirats Arabes Unis">Dirham Emirats Arabes Unis</option>     
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Valeurs</label>

                            <input value="" name="nature_pro" type="text" class="form-control"
                                id="" placeholder="Cours">

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
