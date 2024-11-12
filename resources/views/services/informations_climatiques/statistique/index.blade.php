@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('page-title')
    Statistiques
@endsection
@section('ariane')
    {{-- <li class="breadcrumb-item">
        <a href="/admin">Acceuil</a>
    </li> --}}
    {{-- <li class="breadcrumb-item">
   <a href="#">Utilisateurs</a>
</li> --}}

    <li class="breadcrumb-item active">Campagne
    </li>
@endsection

@section('main_content')
    <section class="users-list-wrapper section">

    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
@endsection
