@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vente/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    Produits
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/louma-mbay/produits">Produit</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Produits</a>
    </li>
@endsection

@include('gestion.produits.create')
<section class="users-list-wrapper section">

    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                        <div class=" display-flex align-items-center show-btn  ">
                            <a style=" color:green" type="button"
                                class=" modal-trigger btn white waves-effect waves-light btn-sm " href="#creer_produit">
                                <i style="color:green" class="material-icons">add
                                </i>Produit
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="row align-items-end mt-10 right ">
            <div class="mt-5 input-group display-flex">
                <select class=" browser-default" id="product" name="produit">
                    <option value=null>Pas de filtre</option>
                    @foreach ($data_prod as $item)
                        <option value="{{ $item['id'] }}">{{ $item['produit'] }}</option>
                    @endforeach
                    <option value="" disabled selected>-- Recherche Produit--</option>
                </select>

                

            </div>
        </div>
    </div>



    <section class="menu" id="menu">

        <div class="box-container " id="card-prod">
            @foreach ($data as $item)
                <div class="box">
                    <div class="image"
                        style=" display: flex;
                    justify-content: center;
                    align-items: center;">
                        @php

                            if (!$item['image']) {
                                $image = asset('storage/produits/new.jpg');
                            } elseif (substr($item['image'], 0, 5) === 'https') {
                                $image = $item['image'];
                            } else {
                                $image = asset('storage/' . $item['image']);
                            }

                        @endphp

                        <img src="{{ $image }} " style="height:150px; width:180px " alt="">
                    </div>
                    <div class="content">
                        <div class="">
                            @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                                <span class="price right">
                                    <a title="modifier" style="color: white; display:block" class="px-1 btn yellow "
                                        href="/louma-mbay/produits/modifier/{{ $item['id'] }}">
                                        <i class="material-icons orange-text ">edit</i>
                                    </a>
                                    <a href="#" id="{{ $item['id'] }}" class="px-1 delete_prod btn red mb-10">
                                        <i class="material-icons white-text ">delete</i>
                                    </a>
                                </span>
                            @endif

                            <h5
                                style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;
                            overflow: hidden;
                            text-overflow: ellipsis;'>
                                {{ $item['produit'] }}</h5>
                            <h6> {{ $item['cat_produit'] }}</h6>
                            @php
                                $id = $item['id'];
                            @endphp
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ajaxloader" style="display:none ;margin-left:50%; margin-right:50%; margin-top:40px">
            <img class="mx-auto mt-30 mb-30  d-block" src="{{ asset('assets/images/loader/loader-13.svg') }}"
                alt="">
        </div>

        <ul class="pagination right">
            @if ($page > 1)
                <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                <li class="list_active go-page " id="li_1"><a href="#!">1</a></li>

                @for ($i = 1; $i < $page; $i++)
                    <li class="waves-effect go-page" id="li_{{ $i + 1 }}"><a
                            href="#">{{ $i + 1 }}</a></li>
                @endfor
            @endif
        </ul>

    </section>
@endsection

@section('other-js-script')
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
    <script src="{{ asset('assets/js/providers/panier.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/scripts/customizer.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets\js\providers\entity.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {

            $('#myTable').DataTable();
        });
    </script>
@endsection
