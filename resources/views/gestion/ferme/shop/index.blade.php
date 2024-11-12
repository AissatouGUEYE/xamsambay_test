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
    <li class="breadcrumb-item active" style="color:#ffe900">Ma boutique
    </li>
@endsection

@include('gestion.ferme.shop.create')
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['profil'] == 'MANAGER' && ($yes==0))
                        <div class=" display-flex align-items-center show-btn  ">
                            <a style="margin-left: 90px; color:green" type="button"
                                class=" modal-trigger btn white waves-effect waves-light btn-sm "
                                href="#creer_boutique">
                                <i style="color:green" class="material-icons">add
                                </i>Boutique
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <section class="menu" id="menu">
        <div class="box-container row mt-4" id="card-shop">
            @isset($item)
                @if (count($item) > 0)
                    <div class="box col-3">

                        @php
                            $id = $item['id'];
                            if (!$item['logo']) {
                                $image = asset('storage/produits/new.jpg');
                            } elseif (substr($item['logo'], 0, 5) === 'https') {
                                $image = $item['logo'];
                            } else {
                                $image = asset('storage/' . $item['logo']);
                            }
                        @endphp
                        <div class="image"
                            style=" display: flex;
            justify-content: center;
            align-items: center;">
                            <img src="{{ $image }}" style="height:150px; width:180px " alt="">
                            <a href="/ferme/shop/listeProduits/{{ $item['id'] }}" class="fas fa-eye"></a>
                        </div>
                        <div class="content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>

                            </div>
                            @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                                <span class="price right">

                                    <a class="px-1 btn white" title="ajouter" style="color:white ; display:block"
                                        href="/ferme/shop/addProduit/{{ $item['id'] }}"><i
                                            class="material-icons green-text">add
                                        </i>
                                    </a>
                                    <a class="px-1 btn white " id="{{ $item['id'] }}" title="modifier"
                                        style="color: white; display:block" href="{{ url("/ferme/shop/edit/$id") }}">
                                        <i class="material-icons  orange-text ">edit</i>
                                    </a>
                                    <a href="#" class=" delete_shop px-1 btn white mb-10 " id="{{ $item['id'] }}">
                                        <i class="material-icons red-text ">delete</i>
                                    </a>


                                </span>
                            @endif
                            <h5
                                style="max-width: 150px; white-space: nowrap;  
                overflow: hidden;
                text-overflow: ellipsis;">
                                {{ $item['nom'] }} </h5>
                            <p> {{ $item['description'] }} </p>
                            <div>
                                @if ($item['status'] == 1)
                                    <span class='chip green lighten-5'>
                                        <span class='green-text'>Actif</span>
                                    </span>
                                @else
                                    <span class='chip red lighten-5'>
                                        <span class='red-text'>Inactif</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endisset
        </div>
    </section>
</section>

@endsection

@section('other-js-script')
@endsection
