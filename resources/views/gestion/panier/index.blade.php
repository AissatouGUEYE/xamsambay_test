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
        <a href="/monpanier">Paniers</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Produits</a>
    </li>
@endsection
@include('gestion.panier.valider_commande')
<section class="users-list-wrapper section">

    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    <div class=" display-flex align-items-center show-btn  ">
                        <a style="margin-left: 90px" type="button"
                            class=" modal-trigger btn green waves-effect waves-light btn-sm " href="#valider_commande">
                            <i class="material-icons">done
                            </i>Valider
                        </a>
                    </div>
                </form>
            </div>
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Boutique</th>
                                <th>Quantite</th>
                                <th>Unite</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <tr>
                                <td>Poulet</td>
                                <td>Sama Boutique</td>
                                <td>10</td>
                                <td>Pieces</td>
                                <td>30000</td>
                                <td>
                                    <a class="px-1 " id=""
                                        href='#'>
                                        <i class="material-icons  orange-text ">edit</i>
                                    </a>
                                    <a href="#" class=" px-1" id="">
                                        <i class="material-icons red-text ">delete</i>
                                    </a>
                                </td>

                            </tr>

                        </tbody>
                    </table>
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

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#myTable').DataTable();
    });
</script>
@endsection
