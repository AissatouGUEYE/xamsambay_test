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
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/ferme/production">Production</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste des activités
    </li>
@endsection

@include('gestion.ferme.activite.create')
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="row right mr-5 mt-2">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    @if ($_SESSION['profil'] == 'MANAGER')
                        <div class=" display-flex align-items-center show-btn right">
                            <a style="margin-left: 90px" type="button"
                                class="create-activite modal-trigger btn green waves-effect waves-light btn-sm "
                                href="#create-activite">
                                <i class="material-icons">add_circle
                                </i>Activité
                            </a>
                        </div>
                    @endif
                </form>
            </div>
            <div class="card-content mt-4">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                <th>Intitulé</th>
                                @if ($_SESSION['profil'] == 'MANAGER')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($activite)
                                @foreach ($activite as $entities)
                                    <tr>
                                        <td>{{ $entities->libelle }} </td>
                                        @if ($_SESSION['profil'] == 'MANAGER')
                                            <td>
                                                <a href='{{ url("/ferme/activite/edit/$entities->id") }}'
                                                     class="px-1">
                                                    <i class="material-icons orange-text">
                                                        edit
                                                    </i>
                                                </a>
                                                <a href="#" id="{{ $entities->id }}"
                                                     class="px-1 supprimer_activite" >
                                                    <i class="material-icons red-text">
                                                        delete
                                                    </i>
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


{{-- 
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>  
 --}}

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}

{{-- 
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script> 
--}}

{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
<script src="{{ asset('assets/js/providers/ferme_activite.js') }}"></script>

@endsection
