@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/louma-mbay/commandes">Commandes</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Commandes</a>
    </li>
@endsection


<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->

                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Total(FCFA)</th>
                                <th>Prénom et Nom sur la facture</th>
                                <th>Méthode de Paiement</th>
                                <th>Liste produits</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($orders)
                                @foreach ($orders as $item)
                                    <tr>

                                        <td>{{ $item['created_at_commande'] }}</td>

                                        <td>

                                            @if ($item['statut'] == 1)
                                                <span class='chip red lighten-5'>
                                                    <span class='red-text'>En Cours
                                                    </span>
                                                </span>
                                            @elseif ($item['statut'] == 2)
                                                <span class='chip green lighten-5'>
                                                    <span class='green-text'>Terminé
                                                    </span>
                                                </span>
                                            @else
                                                {{ $item['statut'] }}
                                            @endif

                                        </td>

                                        <td>{{ $item['montant'] }}</td>

                                        {{-- <td>{{ $item['customer_id'] }}</td> --}}

                                        <td>{{ $item['prenom_client'] }} {{ $item['nom_client'] }}</td>

                                        <td>
                                            @if ($item['id_paiement'] == 1)
                                                PayeTech
                                            @else
                                                À la livraison
                                            @endif
                                        </td>

                                        <td><a href="/louma-mbay/commandes/listeProduits/{{ $item['id_commande'] }}"
                                                class="btn green waves-effect waves-light btn-sm ml-3">Liste Produits</a>
                                        </td>

                                        @if ($item['statut'] == 1)
                                            <td>
                                                <a href='#'  id="{{ $item['id_commande'] }}" class='fermer_commande'>
                                                    <span class='chip green lighten-5'>
                                                        <span class='green-text'>Cloturer
                                                        </span>
                                                    </span>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Total(FCFA)</th>
                                <th>Prénom et Nom sur la facture</th>
                                <th>Méthode de Paiement</th>
                                <th>Liste produits</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
<script src="{{ asset('assets\js\providers\set_state.js') }}"></script>
@endsection
