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
        <a href="/listeferme">Vente</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Details Vente
    </li>
@endsection
<div class="section users-view">

    <!-- users view card data start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m12">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Acteur : {{ $vente->prenom }} {{ strtoupper($vente->nom) }}</td>
                                <td></td>
                                <td>Mail:{{ $vente->email }}</td>
                                <td></td>
                                <td>Adresse: {{ $vente->localite }},
                                    {{ strtolower($vente->commune) }},{{ $vente->pays }}</td>
                            </tr>

                            <tr>
                                <td>Produit: {{ $vente->produit }}</td>
                                <td></td>
                                <td>Quantite: {{ $vente->quantite }} {{ $vente->unite }}</td>
                                <td></td>
                                <td>Prix de vente: {{ $vente->prix_vente }}FCFA</td>
                                <td></td>
                                {{-- @if ($vente->payer == 0)
                                    <td>Statut: <span class=" users-view-status chip red lighten-5 red-text">Non
                                            Paye</span></td>
                                @else
                                    <td>Statut: <span
                                            class=" users-view-status chip green lighten-5 green-text">Paye</span>
                                    </td>
                                @endif --}}
                                <td>Justificatif :
                                    @if (strcmp($vente->justificatif, '') == 0)
                                    -
                                @else
                                    <a href="{{ asset('storage/' . $vente->justificatif) }}" target="_blank" right>
                                        <i class="material-icons green-text ">file_download</i>
                                    </a>
                                @endif

                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script> --}}

{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
{{-- <script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script> --}}
@endsection
