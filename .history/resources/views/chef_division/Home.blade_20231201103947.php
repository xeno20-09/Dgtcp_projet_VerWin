@extends('layout.chef_division.header')
@section('content')
<h1 style="text-align: center;">
  @foreach ($user as $item)
  <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}   <span class="badge rounded-pill badge-notification bg-danger"
    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
  @endforeach
</h1>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-clock"></i> Demandes en cours</h5>
          <p class="card-text">Nombre de demandes en attente</p>
          <span class="badge bg-primary">{{$le_n_dmd_c}}</span>
     {{--      <a style="width: auto; height:fit-content;" href="" class="btn btn-primary">Voir</a> --}}

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-check"></i> Demandes validées</h5>
          <p class="card-text">Nombre de demandes acceptées</p>
          <span class="badge bg-success">{{$le_n_dmd_v}}</span>
     {{--      <a style="width: auto; height:fit-content;" href="" class="btn btn-success">Voir</a> --}}
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-times"></i> Demandes rejetées</h5>
          <p class="card-text">Nombre de demandes refusées</p>
          <span class="badge bg-danger">{{$le_n_dmd_e}}</span>
       {{--    <a style="width: auto; height:fit-content;" href="" class="btn btn-danger">Voir</a>
   --}}      </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-pause"></i> Demandes suspendus</h5>
          <p class="card-text">Nombre de demandes suspendu</p>
          <span class="badge bg-warning">{{$le_n_dmd_s}}</span>
        {{--   <a style="width: auto; height:fit-content;" href="" class="btn btn-warning">Voir</a>
   --}}      </div>
      </div>
    </div>
  </div>
  <br><br>
  <div style="position:relative;display:flex;flex-direction:row;">
    @foreach ($user as $item)

    <a href="{{ route('devises', $item->id) }}"><button type="button" class="btn btn-danger"><i class="fas fa-exclamation"></i> Mettre à jour les devises</button></a>
  @endforeach
  <button type="button" style="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertionModal">
    Ajouter une devise             
  </button>
  
  </div>

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
</div>

@endsection