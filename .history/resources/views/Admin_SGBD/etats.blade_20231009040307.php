@extends('layout.Admin.header')
@section('content')
<div class="container">
    <h1>Gestion des États</h1>

    <form action="{{ route('listedmd') }}" method="post" class="mb-4">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="fdate" class="form-label">Date de début</label>
                    <input value="" name="fdate" type="date" class="form-control" id="fdate">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sdate" class="form-label">Date de fin</label>
                    <input value="{{ $date }}" name="sdate" type="date" class="form-control" id="sdate">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="status" class="form-label">États</label>
                    <select name="status" class="form-select" id="status">
                        <option>Autorisée</option>
                        <option>Rejetée</option>
                        <option>Suspendu</option>
                        <option>En cours</option>
                        <option>All</option>

                    </select>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-outline mt-4" type="submit"><i class="fas fa-search" style="font-size: 25px;"></i></button>
            </div>
        </div>
    </form>

    <form action="{{ route('laliste') }}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="fdate2" class="form-label">Date de début</label>
                    <input value="" name="fdate2" type="date" class="form-control" id="fdate2">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sdate2" class="form-label">Date de fin</label>
                    <input value="{{ $date }}" name="sdate2" type="date" class="form-control" id="sdate2">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="status2" class="form-label">États</label>
                    <select name="status2" class="form-select" id="status2">
                        <option>Autorisée</option>
                        <option>Rejetée</option>
                        <option>Suspendu</option>
                        <option>En cours</option>
                        <option>All</option>

                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="devise" class="form-label">Devise</label>
                    <select name="devise" class="form-select" id="devise">
                        @foreach ($liste as $devises)
                            <option value="{{ $devises->nom }}">{{ $devises->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-outline mt-4" type="submit"><i class="fas fa-search" style="font-size: 25px;"></i></button>
            </div>
        </div>
    </form>
<br><br>
    <div class="row">
        <div class="col-md-4">
            <a href="lesdevis"><button class="btn btn-primary">Situation sur les devises</button></a>
        </div>
        <div class="col-md-4">
            <a href="lespays"><button class="btn btn-primary">Situation sur les pays</button></a>
        </div>
        <div class="col-md-4">
            <a href="lessocietes"><button class="btn btn-primary">Situation sur les entreprises</button></a>
        </div>
    </div>
</div>

@endsection
@section('script')