@extends('layouts.master')
@section('other-css-files')
    <meta>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
    <!-- users edit start -->
@section('page-title')
    Produits
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/louma-mbay/produits') }}">Produits</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Produit
    </li>
@endsection
<div class="section products-edit">
    <div class="card">
        <div class="card-content pb-0">
            <div class="card-header mb-2">
                <h4 class="card-title">Modification Produit</h4>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="card-body">
                    <form method="POST" action="/louma-mbay/updateProduit" id="FormEditProd" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                                <div class="row">
                                    <input id="id" name="id" value="{{ $data['id'] }}" hidden>
                                    <div class="col s6 input-field">
                                        <input id="name_produit" type="text" class="validate" name="name_produit"
                                            value="{{ $data['produit'] }}">
                                        <label for="name">Nom</label>
                                        <small class="errorTxt1"></small>
                                    </div>

                                    <div class="input-field col s6">
                                        <select class=" browser-default" id="cat_produit" name="cat_produit">
                                            <option value="{{ $data['id_categorie'] }}" selected>
                                                {{ $data['cat_produit'] }}</option>
                                        </select>
                                        <label class="active" for="">Categorie</label>
                                    </div>

                                </div>
                            </div>
                            <div id="row">
                                <div class="col s6 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Image</span>
                                            <input type="file" name="fichier" >
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="fichier" type="text">
                                        </div>
                                        <div>
                                            <input type="text" value=" {{ $data['image'] }}"  hidden name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row load" id=""></div>
                            <div class="row">
                                <div class="input-field col s12">
                                    
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button type="submit" id="editProduit" class="btn indigo">
                                            Enregistrer</button>
                                        <button type="button" id="annuler" class="ml-1 btn btn-light">Annuler</button>
                                    </div>
                                </div>
                            </div>
                          
                    </form>
                </div>

            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- products edit ends -->

@endsection
@section('other-js-script')
    <script src="{{ asset('assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    {{-- <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}

    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\create.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
    <script src="{{ asset('assets\js\providers\panier.js') }}"></script>

    {{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script> --}}
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

    {{-- <script src="{{ asset('assets\js\crud\gestion\produits\update.js') }}"></script> --}}
@endsection
