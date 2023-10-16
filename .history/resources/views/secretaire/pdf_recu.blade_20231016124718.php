@extends('layout.pdf.header')
@section('content')
<h1>récépissé</h1>
    <div class="d-flex justify-content-end mb-4">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger ">
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Poste</th>
                    <th scope="col">Date d'inscription</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->poste }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
               
                @endforeach
                 
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection