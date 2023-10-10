{{-- @extends('layout.pdf.header')
@section('content') --}}
<div class="table-responsive">
    <table class="table table-bordered">
            <thead>
                <tr>
    
                <th scope="col">N°Dossier:</th>
               <th scope="col">Date:</th>
                <th scope="col">Montant:</th>
                <th scope="col">Contre Montant en FCFA:</th>
                <th scope="col">Status:</th>
    
            </tr>
        </thead>
        <tbody>

            @foreach ($demande as $item)
                <tr class="table">
          <td> {{ $item->numero_doss }}</td>
         <td> {{ $item->date }}</td>
        <td> {{ $item['montant'] }} {{ $item['devise'] }}</td>
         <td>{{ $item['montant_con'] }}</td>
        <td>{{ $item->status_dmd }}</td>
    </tr>
    @endforeach
    </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>

{{-- @endsection --}}