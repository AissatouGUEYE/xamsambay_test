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
    Entites
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Accueil</a>
    </li>
    <li class="breadcrumb-item" style="color:#ffe900">
        Entités
    </li>
@endsection
<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">

            <div class="col s12 m12 l12  show-btn">
                <a type="button" class="btn green waves-effect waves-light btn-sm ml-3 right"
                    href="{{ url('admin/role/create') }}"><i class="material-icons">add_circle</i>
                    Entité
                </a>
            </div>

            <div class="mt-3">
                <table id="statsTable" class="table display">
                    <thead>
                        <tr>
                            <th>Entité</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @foreach ($entitiesList as $entities)
                            <tr>
                                <td>{{ Str::upper($entities->nom_entite) }}</td>
                                <td>{{ $entities->nom_typentite }}</td>
                                <td>
                                    <a href="{{ url('admin/role/' . $entities->id) }}">
                                        <i class="material-icons green-text">visibility</i>
                                    </a>
                                    <a href="{{ url('admin/role/edit/' . $entities->id) }}">
                                        <i class="material-icons yellow-text">edit</i>
                                    </a>
                                    <a class="" href="#" onclick="deleteEntity({{ $entities->id }})">
                                        <i class="material-icons red-text">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{-- <div class="row">
                <form method="POST" action="{{ url('admin/utilisateurs/filter') }}">
                    @csrf
                    <div class="col s12 m12 l8">
                        <label for="users-list-role">Rôle</label>
                        <div class="input-field">
                            <select class="form-control" name="users-list-role">
                                <option value=null>Pas de filtre</option>
                                {{-- @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->nom_typentite }}</option>
                          @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col s12 m6 l3">
                  <label for="users-list-status">Status</label>
                  <div class="input-field">
                      <select class="form-control" name="users-list-status">
                          <option value=null>Pas de filtre</option>
                          <option value=1>Actif</option>
                          <option value=0>Inactif</option>
                      </select>
                  </div>
              </div>
                    <div class="col s12 m6 l4 display-flex align-items-center show-btn">
                        <button type="submit" class="btn block indigo waves-effect waves-light ml-1"><i
                                class="material-icons">filter_list</i></button>
                        <a type="button" class="btn green waves-effect waves-light btn-sm ml-3"
                            href="{{ url('admin/role/create') }}"><i class="material-icons">add_circle</i>
                            Entité</a>
                    </div>
                </form>
            </div>
        </div> --}}
        </div>
        {{-- <div class="users-list-table">
        <div class="card">
            <div class="card-content">

            </div>
        </div>
    </div> --}}

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

<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>

<script src="{{ asset('assets\js\crud\gestion\utilisateurs\edit.js') }}"></script>
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\role\delete.js') }}"></script>

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
