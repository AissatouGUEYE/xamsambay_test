
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
    Production
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/ferme/stock') }}">Production</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Stock
    </li>
@endsection

<div >
    <form method="POST" id="formEditStock" action="{{url('/ferme/stock/edit')}}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                   
                    <div class="users-list-table">
                    <div class="card-body">                    
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="id" name="id" value="{{$stock->id }}" hidden>
                                <input  name="produit" value="{{$stock->id_produit }}" hidden>
                                <input id="unite" name="unite" value="{{$stock->id_unite }}" hidden>
                               <input type="text" value="{{$stock->produit}}" disabled >
                                <label class="active" for="activite">Produit</label>
                            </div>                          
                        </div>
                        <div class="row">                           
                                <div class="input-field col s6">
                                    <input id="quantite" type="number" class="quantite" name="quantite" value="{{$stock->quantite}}" >                
                                    <label class="active" for="quantite">Quantite</label>
                                  </div>                            
                            <div class="input-field col s6">
                                <input type="text" value="{{$stock->unite}}" disabled>
                                <label class="active" for="activite">Unite</label>
                            </div>

                        </div>

                        <div class="row">
                            
                                <div class="input-field col s6">
                                    <input id="detail" type="text" class="detail" name="detail" value="{{$stock->prix_detaillant}}" >                
                                    <label class="active" for="detail">Prix detaillant</label>
                                  </div>
                            
                           
                                <div class="input-field col s6">
                                    <input id="gros" type="text" class="gros" name="gros" value="{{$stock->prix_en_gros}}" >                
                                    <label class="active" for="gros">Prix en gros</label>
                                  </div>
                            
                        </div>
                    
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <a href='#' class='stock-edit'>
                                        <span class='chip' style="background-color: transparent !important">
                                            <span class='green-text'>

                                                <i class="btn indigo" title="valider">Enregistrer</i>
                                            </span>
                                        </span>
                                    </a>
                                    
                                    <button type="button" id="annuler"  class="ml-1 btn btn-light">Annuler</button>
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
<script>
    $(document).ready(function(){
	$("#annuler").click(function(){
		parent.history.back();
		return false;
	});
});

</script>
<!-- START RIGHT SIDEBAR NAV -->


<!-- BEGIN: Footer-->



<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->

<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> --}}

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

{{-- <script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script>
<script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>


<!-- END PAGE LEVEL JS-->
@endsection
