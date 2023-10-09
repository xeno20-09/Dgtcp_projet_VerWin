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
                    <label for="exampleSelect1" class="form-label mt-4">Devise</label>
                    <select name="devise" class="form-select" id="exampleDisabledSelect1">
                        @foreach ($liste as $devises )
                        <option value={{ $devises->nom}}>{{ $devises->nom }}</option>

                        @endforeach
                      
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

</div>

<a href=""></a>
<button class="btn btn-primary">Situation sur les devises</button>
<button class="btn btn-primary">Situation sur les pays</button>
<button class="btn btn-primary">Situation sur les entreprises</button>



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