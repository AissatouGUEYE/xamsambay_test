@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    Langues
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/langue">Langues</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text">Liste des Langues</a>
    </li>
@endsection

<section class="users-list-wrapper section">
    
    <div class="users-list-filter">
        {{-- <div class="card-panel">
            <div class="row">
                    
                    
            </div>
        </div> --}}
    </div>




    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Nouvelle Langue</h4>
            <div class="divider mt-2"></div>

            <form method="POST" id="formAddLangue" action="/langue/store">
                @csrf
                <div class="row">
                
                    <div class="input-field col s6">
                        <input id="langue" type="text" class="validate" name="langue" >                
                        <label class="active" for="langue">Nom de la langue</label>
                    </div>

                    

                    
                </div>
                

                <div class="row">

                    <div class="input-field col s12">
                        <div class="col s12 display-flex justify-content-end mt-1">
                            <button id="formAddLanguebtn" type="button" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">
                                Enregistrer</button>
                            
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        </div>
    </div>

   


    <div class="users-list-table">
        <div class="card">
            <div class="card-content">

                <div>
            
                    <a type="button" class="waves-effect waves-light  green darken-1 btn modal-trigger right"
                        href="#modal1"><i class="material-icons">add_circle</i>
                        Langue</a>

                </div>


                <div class="responsive-table">
                    <!-- datatable start -->
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                 
                                @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))
                                    <th>Actions</th>
                                @endif        
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($langues)
                                @foreach ($langues as $item)
                                <tr>
                                    <td>{{ $item['langue'] }}</td>

                                    @if (in_array($_SESSION['role'],["SUPERADMIN","ADMIN"]))
                                        <td>
                                            <a href="/langue/modifier/{{ $item['id'] }}">
                                                <i class="material-icons orange-text ">edit</i>
                                            </a>

                                            <a href="#" onclick="deleteLangue({{$item['id']}})" class="px-1">
                                                <i class="material-icons red-text ">delete</i>
                                            </a>
                                        </td>
                                    @endif


                                    
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
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

<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets/js/crud/gestion/langues/message.js') }}"></script>
<script src="{{ asset('assets/js/crud/gestion/langues/delete.js') }}"></script>

v

@endsection
