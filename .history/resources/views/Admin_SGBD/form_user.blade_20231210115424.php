@extends('layout.Admin.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        @foreach ($user as $item_c)
            <h1> N° user {{ $item_c->id }} </h1>


            <form action="{{ route('store_user', $item_c->id) }}" method="Post" class="card-body cardbody-color p-lg-5">

                @csrf

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Name:</label>
                            <input value="{{ $item_c['firstname'] }} {{ $item_c['lastname'] }}" name="name"
                                type="text" class="form-control" id="" placeholder="" disabled>
                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Poste:</label>
                            <select value="{{ $item_c->poste }}" name="poste" class="form-select"
                                id="exampleDisabledSelect1">
                                <option value="Agent de saisir">Agent de saisir</option>
                                <option value="Vérificateur">Vérificateur</option>
                                <option value="Chef division">Chef division</option>
                                <option value="Chef service">Chef service</option>
                                <option value="Directeur">Directeur</option>
                                <option value="Client">Client</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Email:</label>
                            <input value="{{ $item_c->email }}" name="Email" type="text" class="form-control"
                                id="" placeholder="" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Inscrit le:</label>
                            <input value="{{ $item_c->created_at }}" name="date" type="text" class="form-control"
                                id="" placeholder="" disabled>

                        </div>
                    </div>




                </div>






                <br>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        @endforeach







    </div>


    <br>
    <br>
@endsection
