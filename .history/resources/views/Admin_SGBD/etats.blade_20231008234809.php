@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États</h1>
         <form action="{{route('listedmd') }}" method="post">  
          @csrf
        <!-- Afficher les états sous forme de cases à cocher -->
        <div class="row ">
      
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de debut</label>
                    <input value="" name="fdate" type="date" class="form-control"
                        id="" aria-describedby="" placeholder="">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de fin</label>
                    <input value="" name="sdate" type="date" class="form-control"
                        id="" aria-describedby="" value="{{ $date }}" placeholder="">
                </div>
            </div>

            <div class="col">
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Etats</label>
                        <select name="status" class="form-select" id="exampleDisabledSelect1">
                            <option>Autorisée</option>
                            <option>Rejetée</option>
                            <option>Suspendu</option>
                            <option>En cours</option>
                        </select>
                    
                </div>
            </div>
            <div class="col">
                <div class="form-group">
             
                                    <button class="btn btn-outline"style="position: relative;
                    top: 56px;" type="submit"><i class="fas fa-search"
                                        style="font-size:25px;"></i></button>
                
            </div>
        </div>
     
        </div>
 </form>

        <!-- Un bouton pour soumettre les états sélectionnés -->
    </div>

@foreach ($devise as $dev )
@php
    $dev[]=$dev->devise;
    $nbr=
@endphp
@endforeach



    @endsection