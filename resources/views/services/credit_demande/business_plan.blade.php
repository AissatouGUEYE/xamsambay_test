@extends('layouts.master')
@section('other-css-files')
@endsection
@section('page-title')
    Credit Agricol
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a class="" href="{{ route('credit.loan') }}">Credit Agricol</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text" href="#">Business Plan</a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        @php
            ddd($business);
        @endphp

        <div class="row">
            <div class="card">
                BP Data
                Icon to Download BP
            </div>
        </div>

    </div>
@endsection
@section('other-js-script')
@endsection
