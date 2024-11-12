@extends('layouts.master')
@section('other-css-files')
    <meta>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
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

    <li class="breadcrumb-item active">Modification Produit
    </li>
@endsection
<div class="section products-edit">
    <div class="card">
        <div class="card-content">
           
            <div class="row">
                <div class="col s12" >

                        <form method="POST" action="/louma-mbay/enregistrerCommande">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">

                                    <input id="login" name="login" type="text" class="form-control" value="agueye" hidden>
                                    <input id="password" name="password" type="text" class="form-control" value="0WJgW^qcSLn88&^0Vv2mm*8x" hidden>
                                    
                                    <input id="idcustomer" name="idcustomer" value="{{ old('idcustomer', 1) }}" hidden>
                                    <input id="line_items" name="line_items[0][product_id]" value="{{ $product['id'] }}" hidden>

                                    <div class="col s12 input-field">
                                        <input id="line_items" type="number" class="validate" name="line_items[0][quantity]">
                                        <label for="line_items">Quantité</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Méthode de Paiement</label>
                                        <input type="text" class="form-control" id="payment_method" name="payment_method">
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Prénom sur la facture</label>
                                        <input type="text" class="form-control" id="billing" name="billing[first_name]">
                                    </div> 
                                    {{-- <div class="col s12 input-field">
                                        <select>
                                            <option value="{{ $product['status'] }}"> {{ $product['status'] == 'publish' ? 'publié' : 'En attente' }} </option>
                                        </select>
                                        <label>Statut</label>
                                    </div>  --}}
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Nom sur la facture</label>
                                        <input type="text" class="form-control" id="billing" name="billing[last_name]">
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Adresse de livraison</label>
                                        <input type="text" class="form-control" id="shipping" name="shipping[address_1]">
                                        <small class="errorTxt3"></small>
                                    </div>
                                     
                                
                            </div>
                            <div class="col s12">
                                <div class="load"></div>
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-3">
                                {{-- <button type="submit" class="btn indigo" onclick="$('.product-edit').submit()"> --}}
                                <button type="submit" class="btn indigo">

                                    Enregistrer</button>
                                <button type="button" class="btn btn-light">Annuler</button>
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
<script src="{{ asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>
<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\create.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

@endsection
