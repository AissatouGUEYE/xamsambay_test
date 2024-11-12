@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
    @php
        // dd($users);
    @endphp
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">

        <a href="/cc/expression-de-besoin">Expression De Besoin</a>

    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Listes des Expressions de besoin
    </li>
@endsection

{{-- @php
    if (request()->session()->exists('message2')) {
        $message = request()->session()->pull('message2', '');
        request()->session()->forget('message2');
    }
@endphp --}}

<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">

            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="statsTable" class="table display striped">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Commune</th>
                                <th>Produit</th>
                                <th>Variete</th>
                                <th>Formule</th>
                                <th>Quantite</th>
                                <th>Statut</th>
                                <th>Etat</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($eb)
                                @foreach ($eb as $item)
                                    <tr>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->commune_profil }}</td>
                                        
                                        <td>{{ $item->produit }}</td>
                                        <td>{{ $item->variete }}</td>
                                        <td>{{ $item->formule_engrais }} </td>
                                        <td>{{ $item->qte }} {{ $item->unite }}</td>
                                        <td>
                                            @if ($item->statut == 0)
                                                <a id="{{ $item->id }}" href='#' class='statut-eb'><span
                                                        class='chip orange lighten-5'><span
                                                            class='orange-text'>Soumis</span></span></a>
                                            @elseif ($item->statut == 1)
                                                <a id="{{ $item->id }}" href='#'><span
                                                        class='chip green lighten-5'><span
                                                            class='green-text'>Accepté</span></span></a>
                                            @else
                                                <a id="{{ $item->id }}" href='#'><span
                                                        class='chip red lighten-5'><span
                                                            class='red-text'>Rejeté</span></span></a>
                                            @endif
                                        </td>
                                        <td>

                                            @if ($item->etat == 0)
                                                <a id="{{ $item->id }}" href='#' class='traiter-eb'><span
                                                        class='chip red lighten-5'><span class='red-text'>Non
                                                            Traité</span></span></a>
                                            @else
                                                <a id="{{ $item->id }}" href='#' class='non_traiter-eb'><span
                                                        class='chip green lighten-5'><span
                                                            class='green-text'>Traité</span></span></a>
                                            @endif
                                        </td>

                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Description</th>
                                <th>Commune</th>
                                <th>Produit</th>
                                <th>Variete</th>
                                <th>Formule</th>
                                <th>Quantite</th>
                                <th>Statut</th>
                                <th>Etat</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
            {{-- @isset($message)
                <input type="text" name="texto2" id="texto2" value="{{ $message }}" hidden>
            @endisset --}}
        </div>
    </div>
</section>
@endsection

@section('other-js-script')

@endsection
