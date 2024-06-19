@extends('layout.Admin.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($admin as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} </a>
    @endforeach
</h1>
<div class="container">
    <a class="btn btn-primary" href="{{ URL::to('/user/pdf') }}">Etat sur les utilisateurs en PDF</a>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead>
                            <tr>
                                <th><span>Utilisateur</span></th>
                                <th><span>Crée le </span></th>
                                <th><span>Poste</span></th>
                                <th class="text-center"><span>Status</span></th>
                                <th><span>Email</span></th>
                                <th><span>Actions</span></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            @if ()
                                
                            @endif
                            <tr>
                                <td>
                                    <img src="{{ asset('images/user.png') }}" alt="">
                                    <a href="#" class="user-link">{{ $item['firstname'] }}
                                        {{ $item['lastname'] }}</a>
                                    <span class="user-subhead">{{ $item['poste'] }}</span>
                                </td>
                                <td>
                                    {{ $item['created_at'] }}
                                </td>
                
                                
                                <td class="text-center">
                                    <span class="label label-warning">{{ $item['poste'] }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="label label-warning">{{ $item['poste'] }}</span>
                                </td>
                                <td>
                                    <a href="#">{{ $item['email'] }}</a>
                                </td>
                                <td style="width: 20%;">
                                    <a href="{{ route('check_user', ['id' => $item->id]) }}" class="table-link">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fas fa-check fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="{{ route('modify_user', ['id' => $item['id']]) }} " class="table-link">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="{{ route('delete_user', ['id' => $item->id]) }}" class="table-link ">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>



    @if ($user->hasPages())
    <nav aria-label="Page navigation example">

        <ul class="pagination justify-content-end">

            @if ($user->onFirstPage())
            <li class="page-item disabled">

                <a class="page-link" href="#" tabindex="-1">Précédent</a>

            </li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $user->previousPageUrl() }}">Previous</a></li>
            @endif



            @foreach ($user as $element)
            @if (is_string($element))
            <li class="page-item disabled">{{ $element }}</li>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $user->currentPage())
            <li class="page-item active">

                <a class="page-link">{{ $page }}</a>

            </li>
            @else
            <li class="page-item">

                <a class="page-link" href="{{ $url }}">{{ $page }}</a>

            </li>
            @endif
            @endforeach
            @endif
            @endforeach



            @if ($user->hasMorePages())
            <li class="page-item">

                <a class="page-link" href="{{ $user->nextPageUrl() }}" rel="next">Suivant</a>

            </li>
            @else
            <li class="page-item disabled">

                <a class="page-link" href="#">Next</a>

            </li>
            @endif

        </ul>
        @endif


</div>
@endsection





<style>
    .user-list tbody td>img {
        position: relative;
        max-width: 50px;
        float: left;
        margin-right: 15px;
    }

    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 60px;
    }

    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }

    /* TABLES */
    .table {
        border-collapse: separate;
    }

    .table-hover>tbody>tr:hover>td,
    .table-hover>tbody>tr:hover>th {
        background-color: #eee;
    }

    .table thead>tr>th {
        border-bottom: 1px solid #C2C2C2;
        padding-bottom: 0;
    }

    .table tbody>tr>td {
        font-size: 0.875em;
        background: #f5f5f5;
        border-top: 10px solid #fff;
        vertical-align: middle;
        padding: 12px 8px;
    }

    .table tbody>tr>td:first-child,
    .table thead>tr>th:first-child {
        padding-left: 20px;
    }

    .table thead>tr>th span {
        border-bottom: 2px solid #C2C2C2;
        display: inline-block;
        padding: 0 5px;
        padding-bottom: 5px;
        font-weight: normal;
    }

    .table thead>tr>th>a span {
        color: #344644;
    }

    .table thead>tr>th>a span:after {
        content: "\f0dc";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        margin-left: 5px;
        font-size: 0.75em;
    }

    .table thead>tr>th>a.asc span:after {
        content: "\f0dd";
    }

    .table thead>tr>th>a.desc span:after {
        content: "\f0de";
    }

    .table thead>tr>th>a:hover span {
        text-decoration: none;
        color: #2bb6a3;
        border-color: #2bb6a3;
    }

    .table.table-hover tbody>tr>td {
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
    }

    .table tbody tr td .call-type {
        display: block;
        font-size: 0.75em;
        text-align: center;
    }

    .table tbody tr td .first-line {
        line-height: 1.5;
        font-weight: 400;
        font-size: 1.125em;
    }

    .table tbody tr td .first-line span {
        font-size: 0.875em;
        color: #969696;
        font-weight: 300;
    }

    .table tbody tr td .second-line {
        font-size: 0.875em;
        line-height: 1.2;
    }

    .table a.table-link {
        margin: 0 5px;
        font-size: 1.125em;
    }

    .table a.table-link:hover {
        text-decoration: none;
        color: #2aa493;
    }

    .table a.table-link.danger {
        color: #fe635f;
    }

    .table a.table-link.danger:hover {
        color: #dd504c;
    }

    .table-products tbody>tr>td {
        background: none;
        border: none;
        border-bottom: 1px solid #ebebeb;
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
        position: relative;
    }

    .table-products tbody>tr:hover>td {
        text-decoration: none;
        background-color: #f6f6f6;
    }

    .table-products .name {
        display: block;
        font-weight: 600;
        padding-bottom: 7px;
    }

    .table-products .price {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }

    .table-products .price>i {
        color: #8dc859;
    }

    .table-products .warranty {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }

    .table-products .warranty>i {
        color: #f1c40f;
    }

    .table tbody>tr.table-line-fb>td {
        background-color: #9daccb;
        color: #262525;
    }

    .table tbody>tr.table-line-twitter>td {
        background-color: #9fccff;
        color: #262525;
    }

    .table tbody>tr.table-line-plus>td {
        background-color: #eea59c;
        color: #262525;
    }

    .table-stats .status-social-icon {
        font-size: 1.9em;
        vertical-align: bottom;
    }

    .table-stats .table-line-fb .status-social-icon {
        color: #556484;
    }

    .table-stats .table-line-twitter .status-social-icon {
        color: #5885b8;
    }

    .table-stats .table-line-plus .status-social-icon {
        color: #a75d54;
    }
</style>