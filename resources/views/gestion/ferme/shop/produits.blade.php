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
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/ferme/shop">Boutique</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Produits</a>
    </li>
@endsection


<section class="users-list-wrapper section">
    <div class="users-list-table ">
        <div class="card">
            <div class="row right mr-5 mt-2 ">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @if ($_SESSION['profil'] == 'MANAGER')
                        @csrf
                        <div class=" display-flex align-items-center show-btn  ">
                            <a style="margin-left: 90px; color:green" type="button"
                                href="/ferme/shop/addProduit/{{ $id }}"
                                class="btn white waves-effect waves-light btn-sm ">
                                <i style="color:green" class="material-icons">add
                                </i>Produit
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <section class="menu" id="menu">
        {{-- <div style="style=margin-top: 60px"></div> --}}
        <div class="box-container row" id="card-shop-prod">
            <input type="text" hidden value="{{ $id }}" class="shop_id">
            @foreach ($data as $item)
                <div class="box col-3">
                    @php
                        $id_boutique_produit = $item['id_boutique_produit'];
                    @endphp
                    <div class="image"
                        style=" display: flex;
                    justify-content: center;
                    align-items: center;">
                        @php
                            if (!$item['image_produit']) {
                                $image = asset('storage/produits/new.jpg');
                            } elseif (substr($item['image_produit'], 0, 5) === 'https') {
                                $image = $item['image_produit'];
                            } else {
                                $image = asset('storage/' . $item['image_produit']);
                            }

                        @endphp
                        <img src="{{ $image }}" style="height:150px; width:180px " alt="">
                    </div>
                    <div class="content">

                        @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                            <span class="price right">
                                <a class="px-1 btn yellow" title="modifier" style="color: white; display:block;"
                                    href="{{ url("/ferme/shop/produit/edit/$id_boutique_produit") }}">
                                    <i class="material-icons  orange-text ">edit</i>
                                </a>
                                <a href="#" class=" delete_prod_shop px-1 btn red mb-10 "
                                    id="{{ $id_boutique_produit }}">
                                    <i class="material-icons white-text ">delete</i>
                                </a>
                            </span>
                        @endif

                        <h5 style="max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;
                        overflow: hidden;
                        text-overflow: ellipsis;">{{ $item['produit'] }}</h5>
                        <h6> {{ $item['prix'] }} FCFA/{{ $item['unite_stock'] }} </h6>
                        <h6> {{ $item['cat_produit'] }}</h6>
                        <h6> Stock:{{ $item['stock'] }}{{ $item['unite_stock'] }} </h6>
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
                <li class="list_active go-page-shop-prod " id="li_1"><a href="#!">1</a></li>

                @for ($i = 1; $i < $page; $i++)
                    <li class="waves-effect go-page-shop-prod" id="li_{{ $i + 1 }}"><a
                            href="#">{{ $i + 1 }}</a></li>
                @endfor
            @endif
        </ul>

    </section>

@endsection

@section('other-js-script')
    <script src="{{ asset('assets\js\providers\panier.js') }}"></script>
@endsection
