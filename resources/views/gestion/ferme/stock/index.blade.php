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
        <a href="/ferme/stock">Production</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des stocks
    </li>
@endsection

@include('gestion.ferme.stock.create')
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card ">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['profil'] == 'MANAGER')
                        <div class=" display-flex align-items-center show-btn  ">
                            <a style="margin-left: 90px" type="button"
                                class=" modal-trigger btn green waves-effect waves-light btn-sm "
                                href="#create-stock">
                                <i class="material-icons">add_circle
                                </i>Stock
                            </a>                           
                        </div>
                    @endif
                </form>
            </div>
            <div class="card-content mt-4">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantite</th>
                                <th>Unite</th>
                                <th>Prix en gros (FCFA)</th>
                                <th>Prix detaillant (FCFA)</th>

                                @if ($_SESSION['profil'] == 'MANAGER')
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
                                        @if ($_SESSION['profil'] == 'MANAGER')
                                            <td>

                                                
                                                <a class="px-1 " id="{{ $entities->id }}"
                                                    href='{{ url("/ferme/stock/edit/$entities->id") }}'>
                                                    <i class="material-icons  orange-text ">edit</i>
                                                </a>
                                                <a href="#" class="px-1 suprrimer_stock" id="{{ $entities->id }}">
                                                    <i class="material-icons red-text ">delete</i>
                                                </a>
                                            </td>
                                        @endif
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

    {{-- @include('gestion.ferme.stock.edit') --}}
</section>

@endsection

@section('other-js-script')
<script src="{{ asset('assets\js\providers\ferme_activite.js')}}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->


{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
