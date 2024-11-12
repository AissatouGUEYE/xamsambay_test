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
    Commandes
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
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>ID Produit</th> --}}
                                <th>Nom</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Image</th>
                                {{-- <th class="text-center">Actions</th>   --}}
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($products)
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        {{-- <td>{{ $item['product_id'] }}</td> --}}

                                        <td>{{ $item['produit'] }}</td>
                                        <td>{{ $item['quantite'] }} {{ $item['unite_stock']}}</td>

                                        <td>{{ $item['prix_produit'] *  $item['quantite']  }}</td>
                                        <td><img src="{{ asset('storage/' .$item['image_produit']) }}" style="width:100px;height:100px;"></td>

                                        {{-- <td>
                                        <a href="/louma-mbay/produits/{{ $item['id'] }}">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="/louma-mbay/produits/modifier/{{ $item['id'] }}">
                                            <i class="material-icons orange-text ">edit</i>
                                        </a>
                                        <a href="/louma-mbay/produits/supprimer/{{ $item['id'] }}" class="px-1">
                                            <i class="material-icons red-text ">delete</i>
                                        </a>
                                    </td> --}}

                                        {{-- <td class="text-center"><a href="/modifierProduit/{{ $item['id'] }}" class='btn btn-info btn-sm btnEditer'>Editer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/supprimerProduit/{{ $item['id'] }}" class='btn btn-danger btn-sm btnSupprimer'>Supprimer</a></td> --}}
                                    </tr>
                                @endforeach
                            @endisset

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

        $("#myTable").DataTable({
            responsive: true,
            dom: "Bfrtip",
            buttons: ["colvis", "excel", "print"],
            stateSave: true,
            buttons: true,
            language: {
                decimal: "",
                emptyTable: "Pas de données trouvées",
                info: "_START_ à _END_ sur _TOTAL_ entrees",
                infoEmpty: "0 sur 0 entrees",
                infoFiltered: "(filtered from _MAX_ total entries)",
                infoPostFix: "",
                thousands: ",",
                // lengthMenu: "liste _MENU_ entrees",
                loadingRecords: "Chargement...",
                processing: "",
                search: "Recherche:",
                zeroRecords: "No matching records found",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent",
                },
                aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending",
                },
            },
        });

    });
</script>
@endsection
