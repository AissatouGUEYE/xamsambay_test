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
        <a href="/ferme/finance/vente">Vente</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste
    </li>
@endsection



<section class="users-list-wrapper section">

    <div class="users-list-table">
        <div class="card ">
            <div class="card-content mt-4">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col m6"><a href="#disponible" class="active">Stocks</a></li>
                            <li class="tab col m6"><a href="#vente">Ventes effectuées</a></li>
                        </ul>
                    </div>
                    <div class="divider mb-3"></div>

                    <!-- datatable start -->
                    <div id="disponible">


                        <div class="responsive-table">
                            <table id="statsTable" class="table display striped">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantite</th>
                                        <th>Unite</th>
                                        <th>Prix en gros (FCFA)</th>
                                        <th>Prix detaillant (FCFA)</th>
                                        @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'RESPONSABLE COMMERCIAL'  || $_SESSION['profil'] == 'COMPTABLE')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($stock)
                                        @foreach ($stock as $entities)
                                            <tr>
                                                <td>{{ $entities->produit }} </td>
                                                <td>{{ $entities->quantite }}</td>
                                                <td>{{ $entities->unite }}</td>
                                                <td>{{ $entities->prix_en_gros }}</td>
                                                <td>{{ $entities->prix_detaillant }}</td>
                                                @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'RESPONSABLE COMMERCIAL' || $_SESSION['profil'] == 'COMPTABLE')
                                                    <td>
                                                        <a href='{{ url("/ferme/finance/vente/create/$entities->id") }}'
                                                            class="btn-small indigo">Débiter</a>
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="vente">
                        <div class="responsive-table ">
                            <table id="" class="table data-table col s12" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantite</th>
                                        <th>Unite</th>
                                        <th>Prix de vente</th>
                                        <th>Total(FCFA)</th>
                                        <th>Justificatif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($vente)
                                        @foreach ($vente as $entities)
                                            <tr>
                                                <td> {{ $entities->produit }} </td>
                                                <td>{{ $entities->quantite }}</td>
                                                <td>{{ $entities->unite }}</td>
                                                <td>{{ $entities->prix_vente }}</td>
                                                <td>
                                                   {{$entities->prix_vente  * $entities->quantite}}
                                                </td>
                                                <td>
                                                    @if (strcmp($entities->justificatif, '') == 0)
                                                        -
                                                    @else
                                                        <a href="{{ asset('storage/' . $entities->justificatif) }}"
                                                            target="_blank">
                                                            <i class="material-icons green-text ">file_download</i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>

                                                    <a id="{{ $entities->id }}"
                                                        href='{{ url("/ferme/finance/vente/view/$entities->id") }}'>
                                                        <i class="material-icons">visibility
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script>

{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
