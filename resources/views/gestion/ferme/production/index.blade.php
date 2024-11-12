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
        <a href="/ferme/production">Production</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des produits
    </li>
@endsection

@include('gestion.ferme.production.create')

<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['profil'] == 'MANAGER')
                        <div class=" display-flex align-items-center show-btn  ">
                            <a style="margin-left: 90px" type="button"
                                class="modal-trigger btn green waves-effect waves-light btn-sm " href="#create-produit">
                                <i class="material-icons">add_circle
                                </i>Produit

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
                                <th>Description</th>
                                <th>Image</th>
                                <th>Type activité</th>
                                @if ($_SESSION['profil'] == 'MANAGER')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($prod)
                                @foreach ($prod as $entities)
                                    <tr>

                                        <td>{{ $entities->produit }}</td>
                                        <td>{{ $entities->description }}</td>
                                        {{-- @php
                                        @endphp --}}
                                        @php

                                            if (!$entities->image) {
                                                // $image = asset('storage/produits/new.jpg');
                                                $image = 'https://th.bing.com/th/id/OIP.RUQqQNG6p4c6JQoGATu7owAAAA?rs=1&pid=ImgDetMain';
                                            } elseif (substr($entities->image, 0, 5) === 'https') {
                                                $image = $entities->image;
                                            } else {
                                                $image = asset('storage/' . $entities->image);
                                            }

                                        @endphp
                                        <td>
                                            <img src="{{ $image }}" style="width:50px ;height:50px" alt="">
                                        </td>
                                        <td>{{ $entities->libelle }} </td>
                                        @if ($_SESSION['profil'] == 'MANAGER')
                                            <td>
                                                {{-- <a href='{{ url("ferme/produit/show/$entities->id") }}'>
                                                <i class="material-icons">visibility</i>
                                            </a> --}}
                                                <a href='{{ url("/ferme/production/edit/$entities->id_produit") }}'
                                                    class="px-1"><i class="material-icons orange-text ">edit</i>
                                                </a>
                                                <a id="{{ $entities->id_produit }}" href="#"
                                                    class="px-1 supprimer_produit">
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
</section>

@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
<script src="{{ asset('assets/js/providers/ferme_activite.js') }}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>
@endsection
