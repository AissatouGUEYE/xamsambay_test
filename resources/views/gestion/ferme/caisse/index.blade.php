@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}"> --}}

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
    <li class="breadcrumb-item active" style="color:#ffe900">Liste
    </li>
@endsection
<section class="users-list-wrapper section">
    <div class="">
        <div class="card">
            <div class="card-content mt-5 ">
                <div class="row ">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col m6"><a href="#transaction" class="active">Transactions</a></li>
                            <li class="tab col m6"><a href="#caisse">Caisse</a></li>
                        </ul>
                    </div>
                    <div class="divider mb-3"></div>

                    <!-- datatable start -->
                    <div id="transaction">
                        <div class=" display-flex align-items-center right">
                            <h5>
                                <i class="material-icons">trending_up
                                </i>Solde : {{$somme}} FCFA
                            </h5>
                        </div>
                        <div class="responsive-table">
                            <table id="statsTable" class="table display striped">
                                <thead>
                                    <tr>
                                        <th>Entrees-Sorties</th>
                                        <th>Montant (FCFA)</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($caisse)
                                        @foreach ($caisse as $entities)
                                            <tr>
                                                <td>{{ $entities->type_operation }} </td>

                                                <td>
                                                    @if ($entities->type_operation == 'Décaissement')
                                                        - {{ $entities->montant }}
                                                    @else
                                                        {{ $entities->montant }}
                                                    @endif

                                                </td>
                                                <td>

                                                    {{ date('d/m/Y', strtotime($entities->created_at)) }}
                                                </td>

                                                <td>

                                                    <a 
                                                        href='{{ url("/ferme/finance/caisse/view/$entities->id") }}'>
                                                        <i class="material-icons">visibility
                                                        </i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                                <tfoot> <tr>
                                    <th>Entrees-Sorties</th>
                                    <th>Montant (FCFA)</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr></tfoot>
                            </table>
                        </div>

                    </div>
                    <div id="caisse">
                        <div class=" display-flex align-items-center right">
                            <h5>
                                <i class="material-icons">trending_up
                                </i>Solde : {{$somme}} FCFA
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="caisseForm" action={{ route('ferme.caisse.create') }}  enctype="multipart/form-data" >
                                @csrf
                                <div class="input-field col s12">
                                    <div class="input-field col s12">
                                        <input id="montant" type="text" class="montant" name="montant">
                                        <label class="active" for="montant">Montant </label>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Justificatif</span>
                                            <input type="file" name="fichier" class="filename" >
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="fichier" class="filename" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <div class="row" id="load"></div>
                                        <div class="col s12 display-flex justify-content-end mt-1">

                                            <a href='#' class='caisseBtn'>
                                                <span class='chip' style="background-color: transparent !important">
                                                    <span class='green-text'>

                                                        <i class="btn indigo" title="valider">Enregistrer</i>
                                                    </span>
                                                </span>
                                            </a>

                                            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}


{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}


{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}

{{-- <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script> --}}
<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>

{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
