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
        <a href="{{ url('/ferme/utilisateurs') }}">Utilisateurs</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Details utilisateur
    </li>
@endsection
<div class="section users-view">

    @php
        $id = $user[0]->id;
    @endphp
    <!-- users view media object start -->
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m7">
                <div class="display-flex media">
                    <a href="#" class="avatar">
                        <img src="{{ asset('assets/images/avatar/lf.png') }}" alt="users view avatar"
                            class="z-depth-4 circle" height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading">
                            <span class="users-view-name">{{ $user[0]->prenom }}</span>
                            <span class="grey-text">@</span>
                            <span class="users-view-username grey-text">{{ $user[0]->nom }}</span>
                        </h6>
                        <span>ID:</span>
                        <span class="users-view-id">{{ $userFerme[0]->utilisateur }}</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                {{-- edit User --}}
                <a href='{{ url("/ferme/utilisateurs/profil/edit/$id") }}' class="btn-small indigo">Edit</a>
            </div>
        </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m12">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Telephone:{{ $user[0]->telephone }}</td>
                                <td></td>
                                <td>Mail:{{ $user[0]->email }}</td>
                                <td></td>
                                <td>Adresse: {{ $user[0]->adresse }},
                                    {{ strtolower($user[0]->commune) }},{{ $user[0]->pays }}</td>
                            </tr>
                            <tr>
                                <td>Fonction: {{ $user[0]->role }}</td>
                                <td></td>
                                <td>Entite: {{ $user[0]->nom_entite }}</td>
                                <td></td>
                                <td>Date d'inscription: {{ date('d M Y', strtotime($userFerme[0]->created_at)) }}</td>

                            </tr>
                            <tr>
                                <td>Utilisateur: {{ $user[0]->login }}</td>
                                <td></td>
                                <td>Accès: {{ $userFerme[0]->description }}</td>
                                <td></td>
                                @if ($userFerme[0]->actif == 0)
                                    <td>Statut: <span
                                            class=" users-view-status chip red lighten-5 red-text">Inactif</span></td>
                                @else
                                    <td>Statut: <span
                                            class=" users-view-status chip green lighten-5 green-text">Actif</span>
                                    </td>
                                @endif
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
<div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top">
    <button class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow  modal-trigger"
        data-target="modal3">
        <i class="material-icons">add</i>
    </button>
    {{-- <ul>
      <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
      <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
      <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
      <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
  </ul> --}}
</div>
{{-- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> --}}
<!-- Modal Structure -->
<div id="modal3" class="modal modal-fixed-footer">
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <form action="">
                    <div class="row">
                        <div class="input-field col s6">
                            <input value="Alvin" id="first_name2" type="text" class="validate">
                            <label class="active" for="first_name2">First Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input value="Alvin" id="first_name2" type="text" class="validate">
                            <label class="active" for="first_name2">First Name</label>
                        </div>
                    </div>
                    {{-- <div class="row"> --}}
                    <div class="input-field">
                        <select class="select2 browser-default">
                            <option value="square">Square</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="rombo">Rombo</option>
                            <option value="romboid">Romboid</option>
                            <option value="trapeze">Trapeze</option>
                            <option value="traible">Triangle</option>
                            <option value="polygon">Polygon</option>
                        </select>
                    </div>
                    {{-- </div> --}}
                </form>
                {{-- <div id="icon-prefixes" class="card card-tabs"> --}}
                {{-- <div id="view-icon-prefixes">
                
              </div> --}}
                {{-- </div> --}}
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Annuler</a>
    </div>
</div>
@endsection
@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>

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
<script src="{{ asset('assets\js\providers\location.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
<script src="{{ asset('assets\js\providers\entity.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\read.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\user-state.js') }}"></script>

{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
