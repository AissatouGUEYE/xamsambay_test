@extends('layouts.master')
@section('page-title')
    @if ($_SESSION['role'] == 'COMMISSION_CESSION')
        {{ __('Distribution Intrants aux OP') }}
    @elseif($_SESSION['role'] == 'OP')
        {{ __("Accuse Reception d'Intrants") }}
    @else
        Reception Intrant CC/OP
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
                {{ __('Distribution Intrants aux OP') }}
            @elseif($_SESSION['role'] == 'OP')
                {{ __('Reception Intrants') }}
            @else
                {{ __('Reception Intrants') }}
            @endif
            {{-- {{ __('Reception Intrants') }} --}}

        </a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        @if ($_SESSION['nom_type_entite'] == 'COMMISSION_CESSION')
            <div class="card">
                <div class="card-content">
                    <div id="image-card" class="section">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h4 class="header">{{ __('Distribution aux OP') }}</h4>
                            </div>
                            <div class="col s12 m6 l6 mt-2" style="text-align: right">
                                <a type="button" class="btn green waves-effect waves-light btn-sm ml-3"
                                    href="{{ route('receptions.create.1') }}">
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
                                        {{--                                    <th>Produit</th> --}}
                                        {{--                                    <th>Type Intrant</th> --}}
                                        <th>Distribution</th>
                                        {{--                                    <th>Besoin Exprime</th> --}}
                                        <th>Point de chute</th>
                                        <th>Receptionneur</th>
                                        <th>Quantite livree(CC)</th>
                                        <th>Quantite Recue(OP)</th>
                                        <th>Date Livraison</th>
                                        <th>Date Reception</th>
                                        <th>Justificatif</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($receptions)
                                        @foreach ($receptions as $item)
                                            <tr>
                                                <td>{{ $item->type_intrant_dist }}: {{ $item->produit_dist }}</td>
                                                {{--                                            <td></td> --}}
                                                <td>{{ $item->commission_nom_entite }}</td>
                                                <td>
                                                    {{ $item->libelle_grp }}
                                                </td>
                                                <td>{{ $item->qte_reçue }} {{ $item->unite_cc }}</td>
                                                <td>{{ $item->qte_livree }} {{ $item->unite_op }}</td>
                                                <td>{{ $item->date_livraison }}</td>
                                                <td>
                                                    @if ($item->date_reception != null)
                                                        {{ $item->date_reception }}
                                                    @else
                                                        ---
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (strcmp($item->facture, '') == 0)
                                                        -
                                                    @else
                                                        <a href="{{ asset('storage/' . $item->facture) }}" target="_blank">
                                                            <i class="material-icons green-text ">file_download</i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->date_reception == null)
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
                                                    @if ($_SESSION['nom_type_entite'] == 'OP')
                                                        @if ($item->date_reception == null)
                                                            <a href="{{ route('receptions.validate', $item->id) }}"
                                                                class="chip yellow">Valider</a>
                                                        @endif
                                                    @else
                                                        ---
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Distribution</th>
                                        {{--                                    <th>Besoin Exprime</th> --}}
                                        <th>Point de chute</th>
                                        <th>Receptionneur</th>
                                        <th>Quantite livree</th>
                                        <th>Quantite Recue</th>
                                        <th>Date Livraison</th>
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
    @endsection
