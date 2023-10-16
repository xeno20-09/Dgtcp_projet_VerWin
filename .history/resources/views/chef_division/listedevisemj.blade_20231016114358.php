
<div class="table-responsive">
    <style>
        .table-responsive {
overflow-x: auto;
max-width: 100%;
}

    </style>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Devise</th>
                <th>Valeur</th>

            </tr>
    </thead>
    <tbody>
        @foreach ($devises as $dev)
        @if ($dev->date!=$ladate)
        <tr  style="background-color: #797676; ">
            <td>{{ $dev->date}}</td>
            <td>{{ $dev->devise }}</td>
            <td>{{ $dev->valeur }}</td>
        </tr>
        @else
        <tr  style="background-color: #007bff; ">
            <td>{{ $dev->date}}</td>
            <td>{{ $dev->devise }}</td>
            <td>{{ $dev->valeur }}</td>
        </tr>
        @endif
        
        @endforeach
    </tbody>
</table>

</div>

<br>
<br>
@endsection