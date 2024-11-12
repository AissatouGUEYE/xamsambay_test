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
    Productions
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/productions/liste">Productions</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Productions</a>
    </li>
@endsection

{{-- @if (in_array($_SESSION['role'], ['AUOP', 'UOP', 'ONG', 'ADMIN', 'SUPERADMIN']))
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            <div class="card-panel">
                <div class="row">
                    <form method="POST" action="{{ url('/productions/aggregation/filter') }}">

                        @csrf

                        <div class="col s12 m12 l10">
                            <label for="grp-list">Groupement</label>
                            <div class="input-field">
                                <select class="form-control" name="grp-list"> --}}

                                    {{-- @if (isset($grp_filter_libelle) && isset($grp_filter_id))

                                        @if (strcmp($grp_filter_libelle, 'null') == 0)
                                            <option value=null>Pas de filtre</option>
                                            @foreach ($groupements as $item)
                                                <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($groupements as $item)
                                                @if ($item['id_groupement'] == $grp_filter_id)
                                                    <option value="{{ $item['id_groupement'] }}" selected>
                                                        {{ $item['libelle'] }}</option>
                                                @else
                                                    <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <option value=null>Pas de filtre</option>
                                        @endif
                                    @else
                                        <option value=null>Pas de filtre</option>
                                        @foreach ($groupements as $item)
                                            <option value="{{ $item['id_groupement'] }}">{{ $item['libelle'] }}
                                            </option>
                                        @endforeach

                                    @endif --}}


                                {{-- </select>
                            </div>
                        </div>

                        <div class="col s12 m12 l2 display-flex align-items-center show-btn">
                            <button type="submit" class="btn block indigo waves-effect waves-light ml-1"><i
                                    class="material-icons">filter_list</i></button>


                        </div>
                    </form>

                </div>
            </div>

        </div>
@endif --}}

<div class="row">
    <div class="col s12">
        <ul class="collapsible collapsible-accordion">

            @foreach ($my_array as $groupement)
                @if (!empty($groupement))
                    <li>
                        <div class="collapsible-header"><i class="material-icons">group</i> {{ key($groupement) }} </div>
                        <div class="collapsible-body">
                            <table class="table" id="data-table-simple">
                                <thead>
                                    <tr>
                                        {{-- <th>Groupement</th> --}}
                                        <th>Produit</th>
                                        <th>Quantité totale</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td colspan="3">
                                            <div class="collapse" id="{{ key($groupement) }}">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach (current($groupement) as $produit)
                                                            @if (!empty($produit))
                                                                @foreach($produit as $nom => $quantite)
                                                                    <tr>
                                                                        {{-- <td></td> --}}
                                                                        {{-- <td></td> --}}
                                                                        <td>{{ $nom }}</td>
                                                                        <td>{{ $quantite[0]['quantite_totale'] }} Tonnes</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</div>

            {{-- <table class="table" id="data-table-simple">
                <thead>
                    <tr>
                        <th>Groupement</th>
                        <th>Produit</th>
                        <th>Quantité totale</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($my_array as $groupement)
                        @if (!empty($groupement))
                            <tr>
                                <td><button class="btn btn-link" data-toggle="collapse"
                                        data-target="#{{ key($groupement) }}">{{ key($groupement) }}</button></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="collapse" id="{{ key($groupement) }}">
                                        <table class="table">
                                            <tbody>
                                                @foreach (current($groupement) as $produit)
                                                    @foreach($produit as $nom => $quantite)
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{ $nom }}</td>
                                                            <td>{{ $quantite[0]['quantite_totale'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table> --}}


</section>
@endsection

@section('other-js-script')
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
<script src="{{ asset('assets/js/providers/message.js') }}"></script>

{{-- <script src="{{ asset('assets\js\providers\produits.js') }}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\productions\message.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\productions\producteur.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\productions\delete.js') }}"></script>
@endsection
