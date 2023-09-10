@extends('layout.client.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($user as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item->name}} </a>
    @endforeach
</h1>
<div class="container">
    @if ($pic=1)

        @else
    @endif
    @foreach ($user as $item)
  <a style="width: auto; height:fit-content;" href="{{ url('Client')}}" class="btn btn-primary">Home</a>
  @endforeach
</div>

@endsection