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
        <a href="{{ url('/louma-mbay/utilisateurs') }}">Utilisateurs</a>
    </li>

    <li class="breadcrumb-item">
        <a class="yellow-text">Modification Utilisateur</a>
    </li>
@endsection
<div class="section products-edit">
    <div class="card">
        <div class="card-content">
           
            <div class="row">
                <div class="col s12" id="account">
                  
                        <form method="POST" action="/louma-mbay/utilisateurs/update">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <input id="login" name="login" type="text" class="form-control" value="agueye" hidden>
                                    <input id="password" name="password" type="text" class="form-control" value="0WJgW^qcSLn88&^0Vv2mm*8x" hidden>
                                    <input id="id" name="id" value="{{ old('id', $user['id']) }}" hidden>
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Prénom:</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom" value="{{ old('first_name', $user['first_name']) }}">
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Nom:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom" value="{{ old('last_name', $user['last_name']) }}">
                                    </div> 
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Nom d'utilisateur</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" value="{{ old('username', $user['username']) }}">
                                    </div> 
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user['email']) }}">
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="prix_normal" class="col-form-label">Rôles</label>
                                        <input id="roles" name="roles[]" type="text" class="form-control" value="{{ old('roles', $user['roles'][0]) }}">
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="" class="col-form-label">Mot de Passe</label>
                                        <input type="text" class="form-control" id="pwd" name="pwd" placeholder="Mot de Passe" ">
                                    </div>
                                
                            </div>
                            <div class="col s12">
                                <div class="load"></div>
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

<script src="{{ asset('assets\js\crud\gestion\produits\update.js') }}"></script>
@endsection
