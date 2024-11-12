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
        <a href="/ferme/finance/caisse">Caisse</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Details Transaction
    </li>
@endsection
<div class="section users-view">

    <!-- users view card data start -->
    <div class="card" >
        <div class="card-content mt-6" >
            <div class="row">
                <div class="col s12 m12">
                    <table class="striped">
                        <tbody>
                            <h4>{{ $caisse->type_operation }}</h4>
                            <tr>
                                <td></td>
                                {{-- <td></td> --}}
                                <td>Acteur : {{ $caisse->prenom }} {{ strtoupper($caisse->nom) }}</td>
                                <td></td>
                                <td>Mail:{{ $caisse->email }}</td>
                                <td></td>
                                <td>Adresse: {{ $caisse->localite }},
                                    {{ strtolower($caisse->commune) }},{{ $caisse->pays }}</td>
                            </tr>

                            <tr>
                                <td></td>
                                
                                {{-- <td>Type transaction: {{ $caisse->type_operation }}</td>
                                <td></td> --}}
                                
                                <td>Montant: {{ $caisse->montant }} FCFA</td>
                                <td></td>
                                <td>Date: {{ date('d/m/Y', strtotime($caisse->created_at)) }}</td>
                                <td></td>
                                <td>Justificatif :
                                    @if (strcmp($caisse->justificatif, '') == 0)
                                    -
                                @else
                                    <a href="{{ asset('storage/' . $caisse->justificatif) }}" target="_blank" right>
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
@endsection
