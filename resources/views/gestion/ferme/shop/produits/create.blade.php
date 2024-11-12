@extends('layouts.master')
@section('other-css-files')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-modern-menu-template/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-users.css')}}">

@endsection
@section('main_content')
@section('page-title')
{{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
<li class="breadcrumb-item">
  <a href="{{url('/dashboard')}}">Accueil</a>
</li>
<li class="breadcrumb-item">
   <a href="{{url('/ferme/shop')}}">Boutique</a>
</li>

<li class="breadcrumb-item">
    <a class="yellow-text">Nouveau Produit</a>
</li>
@endsection
  <div class="row">
    <form  method="POST" id="add_produit_to_shop_ferme"  action="#" enctype="multipart/form-data">
      @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouveau Produit</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="id_boutique" type="text" class="validate" name="id_boutique"
                                value="{{ $shops['id'] }}" hidden>
                                <input id="nom" type="text" class="validate" name="nom"
                                    value="{{ $shops['nom'] }}" disabled>
                                <label class="active" for="nom">Nom de la boutique</label>
                            </div>
                            <div class="input-field col s6">
                                <select class=" produit browser-default" name="produit" id="">
                                    <option value="" disabled selected>--Produit--</option>
                                </select>
                                <label class="active" for="">Produit</label>
                            </div>
                            {{-- <div class="input-field col s3">
                                <select class=" browser-default variete" id="variete" name="variete">
                                    <option value="" disabled selected>--Variete--</option>
                                </select>
                                <label class="active" for="activite">Variete</label>
                            </div> --}}
                            
                        </div>
                    
                        
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="stock_quantity" class="col-form-label">Stock</label>
                                <input id="stock_quantity" name="stock_quantity" type="number" step="0.01" class="form-control" required>
                            </div>
                            <div class="input-field col s6">
                                <select class=" browser-default unite" id="unite" name="unite_stock" required>
                                    <option value="" disabled selected>--Unite--</option>
                                </select>
                                <label class="active" for="activite">Unite</label>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="input-field col s3">
                                <label for="regular_price" class="col-form-label">Prix unitaire</label>
                                <input id="regular_price" name="regular_price" type="number" step="0.01" class="form-control" required>
                            </div>
                            <div class="input-field col s3">
                                <select required class=" browser-default unite" id="unite" name="unite_prix">
                                    <option value="" disabled selected>--Unite--</option>
                                </select>
                                <label class="active" for="activite">Unite</label>
                            </div>
                        </div>

                        <div class="row">
                        
                            <div class="input-field col s12">
                                <div class="row load" id=""></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        {{-- <button type="submit"> save</button> --}}
                                        <a id="addProductToFermeShopBtn" href="#" class="btn indigo">
                                            Enregistrer</a>
                                        <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </form>
</div>
@endsection

@section('other-js-script')

<!-- START RIGHT SIDEBAR NAV -->

    
    <!-- BEGIN: Footer-->

    

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('assets/js/scripts/form-select2.js')}}"></script>

    {{-- <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/custom/custom-script.js')}}"></script>
    <script src="{{asset('assets/js/scripts/customizer.js')}}"></script>
     --}}
    {{-- <script src="{{asset('assets/js/scripts/page-users.js')}}"></script>
    <script src="{{asset('assets/js/scripts/advance-ui-modals.js')}}"></script>
    <script src="{{asset('assets/js/scripts/form-elements.js')}}"></script>
    <script src="{{asset('assets/js/scripts/ui-alerts.js')}}"></script>
     --}}
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}
    
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\create.js')}}"></script> --}}
    {{-- <script src="{{asset('assets\js\providers\panier.js')}}"></script> --}}
    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{asset('assets\js\providers\ferme_activite.js')}}"></script>
    
    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script>
    <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script>
     --}}
    <!-- END PAGE LEVEL JS-->
@endsection