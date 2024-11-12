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
{{$_SESSION['nom_entite']}} 
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/ferme/eb') }}">Ferme</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Modification Expression de besoin
    </li>
@endsection
<div class="row">
    <form id="formModeb" action="#" method="POST">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Modification Expression de besoin</h4>
                    </div>
                    @if ($_SESSION['profil'] == 'RESPONSABLE ACTIVITES')
                        <div class="card-body">

                            <div class="row">

                                <input id="id" name="id" value="{{ $ebInfos['id'] }}" hidden>

                                <div class="input-field col s12">
                                    <input id="description" type="text" class="validate" name="description"
                                        value="{{ $ebInfos['description'] }}">
                                    <label class="active" for="description">Besoin</label>
                                </div>
                                {{-- <div class="input-field col s6">
                                    <select class="select2 browser-default" id="produit" name="produit">
                                        <option value="{{ $ebInfos['produit'] }}" disabled selected>--Produit--</option>
                                    </select>
                                    <label class="active" for="produit">Produit</label>
                                </div> --}}
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button type="submit" id="formModEbBtn" class="btn indigo">
                                            Enregistrer</button>
                                        <a href="{{ url('/ferme/eb/valider') }}">
                                            <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    @if($_SESSION['profil'] == 'PRESIDENT')
                    <div class="card-body">

                        <div class="row">
                            <input id="id" name="id" value="{{ $ebInfos['id'] }}" hidden>

                                <div class="input-field col s6">
                                    <input id="commentaireP" type="text" class="validate" name="commentaireP"
                                        value="{{ $ebInfos['commentaireP'] }}">
                                    <label class="active" for="commentaireP">Commentaire </label>
                                </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formModEbCommentPBtn" class="btn indigo">
                                        Enregistrer</button>
                                   
                                        <button id="annuler" type="button" class="ml-1 btn btn-light">Annuler</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card-body">

                        <div class="row">
                            <input id="id" name="id" value="{{ $ebInfos['id'] }}" hidden>

                                <div class="input-field col s6">
                                    <input id="commentaireM" type="text" class="validate" name="commentaireM"
                                        value="{{ $ebInfos['commentaireM'] }}">
                                    <label class="active" for="commentaireM">Commentaire </label>
                                </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" id="load"></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <button type="submit" id="formModEbCommentMBtn" class="btn indigo">
                                        Enregistrer</button>
                                
                                        <button id="annuler" type="button" class="ml-1 btn btn-light">Annuler</button>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
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
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

{{-- <script src="{{asset('assets\js\crud\gestion\langues\create.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\ferme_all_produit.js') }}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}

<script src="{{ asset('assets\js\crud\gestion\ferme\eb\edit.js') }}"></script>

{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\read.js')}}"></script> --}}
{{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\user-state.js')}}"></script> --}}

<!-- END PAGE LEVEL JS-->
@endsection
