@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="style.css">
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
    Boutiques
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/louma-mbay/boutiques">Boutiques</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Boutiques</a>
    </li>
@endsection
@include('gestion.boutiques.create')

<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2 ">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                        @csrf
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
        <div class="row align-items-end mt-10 right ">
            <div class="mt-5 input-group display-flex">
                <select class=" browser-default" id="shop" name="shop">
                    <option value=null>Pas de filtre</option>
                    <option value="" disabled selected>-- Recherche Boutique--</option>
                </select>
            </div>
        </div>
    </div>

    <section class="menu" id="menu">
        <div class="box-container row" id="card-shop">
            @foreach ($shops as $item)
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
                        <a href="/louma-mbay/boutiques/listeProduits/{{ $item['id'] }}" class="fas fa-eye"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>

                        </div>
                        @if ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'SUPERADMIN')
                            <span class="price right">

                                <a class="px-1 btn white" title="ajouter" style="color:white ; display:block"
                                    href="/louma-mbay/boutiques/addProduit/{{ $item['id'] }}"><i
                                        class="material-icons green-text">add
                                    </i>
                                </a>
                                <a class="px-1 btn white " id="{{ $item['id'] }}" title="modifier"
                                    style="color: white; display:block" href="{{ url("/boutique/edit/$id") }}">
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
                            @if ($item['status'] == 0)
                                <a id="{{$item['id']}}" href='#' class='active-shop'>
                                    <span class='chip green lighten-5'>
                                        <span class='green-text'>Activer</span>
                                    </span></a>
                            @else
                                <a id="{{$item['id']}}" href='#' class='desactive-shop'>
                                    <span class='chip red lighten-5'>
                                        <span class='red-text'>Desactiver</span>
                                    </span></a>
                            @endif

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
                <li class="list_active go-page-shop " id="li_1"><a href="#!">1</a></li>

                @for ($i = 1; $i < $page; $i++)
                    <li class="waves-effect go-page-shop" id="li_{{ $i + 1 }}"><a
                            href="#">{{ $i + 1 }}</a></li>
                @endfor
            @endif
        </ul>

    </section>
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
<script src="{{ asset('assets\js\providers\panier.js') }}"></script>
{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script> --}}
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
