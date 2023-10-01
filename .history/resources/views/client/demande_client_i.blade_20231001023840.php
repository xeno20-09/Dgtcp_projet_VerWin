
@extends('layout.client.header')
@section('content')
<h1 style="text-align: center;">
  @foreach ($user as $item)
  <a class="nav-link" href="#"> Mr/Mrs {{ $item->name}} </a>
  @endforeach
</h1>
<div class="container">
<div class="alert alert-danger" role="alert">
  {{ Session::get('message') }}

  La demande du client n'existe pas.
</div>
@foreach ($user as $item)
  <a style="width: auto; height:fit-content;" href="{{ url('Client')}}" class="btn btn-primary">Home</a>
  @endforeach
</div>

@endsection