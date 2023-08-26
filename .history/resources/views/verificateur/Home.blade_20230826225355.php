@extends('layout.verificateur.header')
@section('content')
<h1 style="text-align: center;">
  @foreach ($user as $item)
  <a class="nav-link" href="#"> Mr/Mrs {{ $item->name}}  <span class="badge rounded-pill badge-notification bg-danger"
    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
  @endforeach
</h1>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-clock"></i> Demandes en cours</h5>
          <p class="card-text">Nombre de demandes en attente de traitement</p>
          <span class="badge bg-primary">{{$le_n_dmd_c}}</span>
          <a style="width: auto; height:fit-content;" href="" class="btn btn-primary">Voir</a>

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-check"></i> Demandes validées</h5>
          <p class="card-text">Nombre de demandes acceptées</p>
          <span class="badge bg-success">{{$le_n_dmd_v}}</span>
          <a style="width: auto; height:fit-content;" href="" class="btn btn-success">Voir</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-times"></i> Demandes rejetées</h5>
          <p class="card-text">Nombre de demandes refusées</p>
          <span class="badge bg-danger">{{$le_n_dmd_e}}</span>
          <a style="width: auto; height:fit-content;" href="" class="btn btn-danger">Voir</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-pause"></i> Demandes suspendus</h5>
          <p class="card-text">Nombre de demandes suspendu</p>
          <span class="badge bg-warning">{{$le_n_dmd_s}}</span>
          <a style="width: auto; height:fit-content;" href="" class="btn btn-warning">Voir</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection