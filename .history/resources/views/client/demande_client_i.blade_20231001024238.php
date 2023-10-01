
@extends('layout.client.header')
@section('content')

<h1 style="text-align: center;">
  @foreach ($user as $item)
  <a class="nav-link" href="#"> Mr/Mrs {{ $item->name}} </a>
  @endforeach
</h1>
<div class="container">
  @if(Session::has('message'))

<div class="alert alert-danger" role="alert">
  @php
    use Illuminate\Support\Facades\Session;
    {{ Session::get('message') }}

@endphp

</div>
@endif
@foreach ($user as $item)
  <a style="width: auto; height:fit-content;" href="{{ url('Client')}}" class="btn btn-primary">Home</a>
  @endforeach
</div>

@endsection