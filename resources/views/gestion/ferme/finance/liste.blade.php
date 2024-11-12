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
        <a href="/ferme/finance/decaissement">Decaissement</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste
    </li>
@endsection
<section class="users-list-wrapper section">
    <div class="">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col m6"><a href="#afaire" class="active">A Faire</a></li>
                            <li class="tab col m6"><a href="#effectif">Effectif</a></li>
                        </ul>
                    </div>
                    <div class="divider mb-3"></div>
                    <!-- datatable start -->
                    <div id="afaire">
                        <div class="responsive-table">
                            <table  id="statsTable" class="table display striped col s12" >
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        @if ($_SESSION['profil'] == 'COMPTABLE' || $_SESSION['profil'] == 'MANAGER')
                                            <th>Ajouter </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($eb_valider)
                                        @foreach ($eb_valider as $entities)
                                            <tr>
                                                <td> {{ $entities->produit }} </td>
                                                <td>{{ $entities->description }}</td>
                                                <td>{{ date('d/m/Y', strtotime($entities->created_at)) }}</td>
                                                @if ($_SESSION['profil'] == 'COMPTABLE' || $_SESSION['profil'] == 'MANAGER') 
                                                    <td>
                                                        <a href='{{ url("/ferme/finance/decaissement/create/$entities->id") }}'
                                                            class="btn-small indigo">Decaissement
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="effectif">
                        <div class="responsive-table ">
                            <table id="" class="table data-table col s12" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        {{-- <th>Expression de besoin</th> --}}
                                        <th>Montant(CFA)</th>
                                        <th>Payement</th>
                                        <th>Justificatif</th>
                                        <th>Date</th>
                                        {{-- <th>Action </th> --}}
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @isset($decaissement)
                                        @foreach ($decaissement as $entities)
                                            <tr>
                                                <td> {{ $entities->produit }} </td>
                                                <td>{{ $entities->montant }}</td>
                                                <td>{{ $entities->paiement }}</td>
                                                <td class="">
                                                    @if (strcmp($entities->fichier, '') == 0)
                                                        ---
                                                    @else
                                                        <a href="{{ asset('storage/' . $entities->fichier) }}"
                                                            target="_blank">
                                                            <i class="material-icons green-text ">file_download</i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($entities->date_creation)) }}</td>
                                                {{-- <td> non disponible </td> --}}
                                                {{-- <td>
                                                    <a href='{{ url("/ferme/dec/edit/$entities->id") }}' class="px-1"><i
                                                            class="material-icons orange-text ">edit</i></a>
                                                   
                                                    </a>
    
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
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
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>


{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}



{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}

{{-- <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script> --}}

{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
