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

        <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="addnewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addnewModalLabel">Ajouter une devise</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                          {!! Form::open(['url' => 'adddevise']) !!}
                              <div class="mb-3">
                                  {!! Form::label('Devise', 'Devise') !!}
                                  {!! Form::text('Devise', '', ['class' => 'form-control', 'placeholder' => 'Input Devise', 'required']) !!}
                              </div>
                        
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      {!! Form::close() !!}
                  </div>
              </div>
            </div>
        </div>
    


    </div>

    <br>
    <br>
@endsection
