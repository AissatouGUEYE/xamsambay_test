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
        <a href="{{ url('/louma-mbay/commandes') }}">Commandes</a>
    </li>

    <li class="breadcrumb-item">
        <a class="yellow-text">Modification Commande</a>
    </li>
@endsection
<div class="section products-edit">
    <div class="card">
        <div class="card-content">
           
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12">
 
                        <form method="POST" action="/louma-mbay/updateCommande">
                        @csrf
                        <div class="row">
                            
                                    <input id="id" name="id" value="{{ old('id', $commande['id']) }}" hidden>
                                    <input id="login" name="login" type="text" class="form-control" value="agueye" hidden>
                                    <input id="password" name="password" type="text" class="form-control" value="0WJgW^qcSLn88&^0Vv2mm*8x" hidden>

                                    <div class="col s6 input-field">
                                        <label for="prix_normal" class="col-form-label">Prénom sur la facture</label>
                                        <input id="billing" name="billing[first_name]" type="text" class="form-control" value="{{ old('billing', $commande['billing']['first_name']) }}">
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="col s6 input-field">
                                        <label for="prix_normal" class="col-form-label">Nom sur la facture</label>
                                        <input id="billing" name="billing[last_name]" type="text" class="form-control" value="{{ old('billing', $commande['billing']['last_name']) }}">
                                        <small class="errorTxt2"></small>
                                    </div> 

                                    <div class="input-field col s6">
                                        <select class="select" id="status" name="status">
                                            <option value="{{ $commande['status'] }}" selected>
                                            
                                                @if (strcmp($commande['status'], 'cancelled') == 0)
                                                    Annulé
                                                @elseif (strcmp($commande['status'], 'completed') == 0)
                                                    Terminé
                                                @elseif (strcmp($commande['status'], 'processing') == 0)
                                                    En traitement
                                                @elseif (strcmp($commande['status'], 'on-hold') == 0)
                                                    En attente
                                                @else
                                                    {{ $commande['status'] }}
                                                @endif

                                            </option>

                                            <option value="cancelled">Annulé</option>
                                            <option value="completed">Terminé</option>
                                            <option value="processing">En traitement</option>
                                            <option value="on-hold">En attente</option>

                                        </select>             
                                        <label class="active" for="payment_method">Statut</label>
                                    </div>

                                    <div class="input-field col s6">
                                        <select class="select" id="payment_method" name="payment_method">
                                            <option value="{{ $commande['payment_method'] }}" selected>
                                            
                                                @if (strcmp($commande['payment_method'], 'cod') == 0)
                                                    À la livraison
                                                @elseif (strcmp($commande['payment_method'], 'bacs') == 0)
                                                    Virement bancaire
                                                @elseif (strcmp($commande['payment_method'], 'cheque') == 0)
                                                    Chèque
                                                @else
                                                    {{ $commande['payment_method'] }}
                                                @endif

                                            </option>

                                            <option value="cod">À la livraison</option>
                                            <option value="bacs">Virement bancaire</option>
                                            <option value="cheque">Chèque</option>
                                            <option value="paytech">paytech</option>

                                        </select>             
                                        <label class="active" for="payment_method">Méthode de paiement</label>
                                    </div>

                                    <div class="col s6 input-field">
                                        <label for="prix_normal" class="col-form-label">Adresse de livraison</label>
                                        <input id="shipping" name="shipping[address_1]" type="text" class="form-control" value="{{ old('shipping', $commande['shipping']['address_1']) }}">
                                        <small class="errorTxt2"></small>
                                    </div>
                                    
                            <div class="col s12 display-flex justify-content-end mt-3">
                                {{-- <button type="submit" class="btn indigo" onclick="$('.product-edit').submit()"> --}}
                                <button type="submit" class="btn indigo">

                                    Enregistrer les Modifications</button>
                                {{-- <button type="button" class="btn btn-light">Annuler</button> --}}
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
