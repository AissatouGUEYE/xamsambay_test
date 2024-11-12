@extends('layouts.master')
@section('page-title')
    @if ($_SESSION['role'] == 'COMMISSION_CESSION')
        Validation Reception Intrants
    @else
        @if ($_SESSION['nom_entite'] == 'FIA')
            Distribution Intrants
        @else
            Distributions FIA->CC
        @endif
    @endif
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">{{ __('Accueil') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{--        <a href="locale/en">English</a>/ --}}
        {{--        <a href="locale/fr">French</a>/ --}}
        <a href="#" style="color:#ffe900">
            @if ($_SESSION['role'] == 'COMMISSION_CESSION')
                {{ __('Receptions') }}
            @else
                @if ($_SESSION['nom_entite'] == 'FIA')
                    {{ __('Distributions') }}
                @else
                    Distribution FIA/CC
                @endif
            @endif
        </a>
    </li>
@endsection

@section('main_content')
    <div class="users-list-table">
        @if ($_SESSION['nom_entite'] == 'FIA')
            <div class="card">
                <div class="card-content">
                    <div id="image-card" class="section">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h4 class="header">{{ __('Liste de Distribution') }}</h4>
                            </div>
                            <div class="col s12 m6 l6 mt-2" style="text-align: right">
                                <a type="button" class="btn green waves-effect waves-light btn-sm ml-3"
                                    href="{{ route('distributions.create') }}">
                                    <i class="material-icons mt-2">add_circle</i>
                                    <span>{{ __('Distribution') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-content">
                <div id="image-card" class="section">
                    <div class="row">
                        <div class="responsive-table">
                            <table id="statsTable" class="table display striped">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Type Intrant</th>
                                        <th>Quantite Notifiee(FIA)</th>
                                        <th>Quantite Placee(CC)</th>
                                        <th>Stock</th>
                                        <th>Quantite Vendue (CC->OP)</th>
                                        @if ($_SESSION['role'] != 'COMMISSION_CESSION')
                                            <th>Point de chute</th>
                                        @endif
                                        <th>Commune</th>
                                        <th>Fournisseur</th>
                                        <th>Date Envoi</th>
                                        <th>Date Reception</th>
                                        <th>Justificatif</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($distributions)
                                        @foreach ($distributions as $stat)
                                            <tr>
                                                <td>{{ $stat->nom_produit }}</td>
                                                <td>{{ $stat->type_intrant }}</td>
                                                <td>{{ $stat->qte_notifiee }} {{ $stat->unite }} </td>

                                                <td>
                                                    @if ($stat->qte_placee != null)
                                                        {{ $stat->qte_placee }} {{ $stat->unite }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>

                                                    {{ $stat->stock }} {{ $stat->unite }} .

                                                </td>

                                                <td>
                                                    @if ($stat->qte_vendue != null)
                                                        {{ $stat->qte_vendue }} {{ $stat->unite }}
                                                    @else
                                                        -
                                                    @endif

                                                </td>

                                                @if ($_SESSION['role'] != 'COMMISSION_CESSION')
                                                    <td>
                                                        {{ $stat->commission_nom_entite }}
                                                    </td>
                                                @endif

                                                <td>{{ $stat->commission_commune }}</td>
                                                <td>{{ $stat->telephone_fia }}</td>
                                                <td>{{ $stat->date_livraison }}</td>
                                                <td>{{ $stat->date_reception }}</td>
                                                <td>
                                                    @if (strcmp($stat->justificatif, '') == 0)
                                                        -
                                                    @else
                                                        <a href="{{ asset('storage/' . $stat->justificatif) }}"
                                                            target="_blank">
                                                            <i class="material-icons green-text ">file_download</i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($stat->cc_id_profil == null)
                                                        <span class="chip yellow p-2 rounded">
                                                            Initié
                                                        </span>
                                                    @else
                                                        <span class="chip green  p-2 rounded">

                                                            Validé
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($stat->cc_id_profil == null && $_SESSION['role'] == 'COMMISSION_CESSION')
                                                        <a href="{{ route('distributions.valider.cc', $stat->id) }}"
                                                            class="btn-small indigo">Valider</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Type Intrant</th>
                                        <th>Quantite Notifiee(FIA)</th>
                                        <th>Quantite Placee(CC)</th>
                                        <th>Stock</th>
                                        <th>Quantite Vendue (CC->OP)</th>
                                        @if ($_SESSION['role'] != 'COMMISSION_CESSION')
                                            <th>Point de chute</th>
                                        @endif
                                        <th>Commune</th>
                                        <th>Fournisseur</th>
                                        <th>Date Envoi</th>
                                        <th>Date Reception</th>
                                        <th>Justificatif</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
