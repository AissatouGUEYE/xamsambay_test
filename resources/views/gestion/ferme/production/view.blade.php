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
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/ferme/production">Production</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Details produit
    </li>
@endsection
<div class="section users-view">

    @php
        $id = $prod[0]->id;
    @endphp
    <!-- users view media object start -->
   
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card" style="margin-top: 80px">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m12">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Produit  :  {{ $prod[0]->produit }}</td>
                                <td></td>
                                <td>Activité  :  {{ $prod[0]->libelle_activite }}</td>
                                <td><div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    {{-- edit User --}}
                                    <a href='{{ url("/ferme/produit/edit/$id") }}' class="btn-small indigo">Edit</a>
                                </div></td>
                               
                            </tr>
                           
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('float-btn')


@endsection
@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
{{-- <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>
<script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}


{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
<script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script>
<script src="{{ asset('assets\js\providers\produits.js') }}"></script>
@endsection
