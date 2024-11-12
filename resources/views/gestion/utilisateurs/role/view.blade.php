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
    Utilisateurs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Acceuil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('role') }}">Rôles</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Entité
    </li>
@endsection
<div class="section users-view">
    <!-- users view media object start -->
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m7">
                <div class="display-flex media">
                    <a href="#" class="avatar">
                        <img src="{{ asset('assets/images/avatar/avatar-18.png') }}" alt="users view avatar"
                            class="z-depth-4 circle" height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading">
                            <span class="users-view-name">{{ $entityInfos['nom_entite'] }} </span>
                            <span class="grey-text">@</span>
                            <span class="users-view-username grey-text">{{ $entityInfos['nom_typentite'] }}</span>
                        </h6>
                        <span>ID:</span>
                        <span class="users-view-id">{{ $entityInfos['id'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                {{-- <a href="app-email.html" class="btn-small btn-light-indigo"><i class="material-icons">mail_outline</i></a> --}}
                {{-- <a href="user-profile-page.html" class="btn-small btn-light-indigo">Profile</a> --}}
                <a href="{{ url('admin/role/edit/' . $entityInfos['id']) }}" class="btn-small indigo">Edit</a>
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
                            {{-- <tr>
                                <td>Date d'inscription:</td>
                                <td>{{ date('d/m/Y', strtotime($entityInfos['created_at'])) }}</td>
                            </tr> --}}
                            {{-- <tr>
                  <td>Latest Activity:</td>
                  <td class="users-view-latest-activity">30/04/2019</td>
                </tr> --}}
                            <tr>
                                <td>Verifié:</td>
                                <td class="users-view-verified">Yes</td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td class="users-view-role">{{ $entityInfos['description'] }}</td>
                            </tr>
                            <tr>
                                <td>Statut:</td>
                                <td><span class=" users-view-status chip green lighten-5 green-text">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <div class="col s12 m8">
            <table class="responsive-table">
              <thead>
                <tr>
                  <th>Module Permission</th>
                  <th>Read</th>
                  <th>Write</th>
                  <th>Create</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Users</td>
                  <td>Yes</td>
                  <td>No</td>
                  <td>No</td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td>Articles</td>
                  <td>No</td>
                  <td>Yes</td>
                  <td>No</td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td>Staff</td>
                  <td>Yes</td>
                  <td>Yes</td>
                  <td>No</td>
                  <td>No</td>
                </tr>
              </tbody>
            </table>
          </div> --}}
            </div>
        </div>
    </div>
    <!-- users view card data ends -->

    <!-- users view card details start -->
    {{-- <div class="card">
      <div class="card-content">
        <div class="row indigo lighten-5 border-radius-4 mb-2">
          <div class="col s12 m4 users-view-timeline">
            <h6 class="indigo-text m-0">Posts: <span>125</span></h6>
          </div>
          <div class="col s12 m4 users-view-timeline">
            <h6 class="indigo-text m-0">Followers: <span>534</span></h6>
          </div>
          <div class="col s12 m4 users-view-timeline">
            <h6 class="indigo-text m-0">Following: <span>256</span></h6>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <table class="striped">
              <tbody>
                <tr>
                  <td>Username:</td>
                  <td class="users-view-username">dean3004</td>
                </tr>
                <tr>
                  <td>Name:</td>
                  <td class="users-view-name">Dean Stanley</td>
                </tr>
                <tr>
                  <td>E-mail:</td>
                  <td class="users-view-email">deanstanley@gmail.com</td>
                </tr>
                <tr>
                  <td>Comapny:</td>
                  <td>XYZ Corp. Ltd.</td>
                </tr>
  
              </tbody>
            </table>
            <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
            <table class="striped">
              <tbody>
                <tr>
                  <td>Twitter:</td>
                  <td><a href="#">https://www.twitter.com/</a></td>
                </tr>
                <tr>
                  <td>Facebook:</td>
                  <td><a href="#">https://www.facebook.com/</a></td>
                </tr>
                <tr>
                  <td>Instagram:</td>
                  <td><a href="#">https://www.instagram.com/</a></td>
                </tr>
              </tbody>
            </table>
            <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
            <table class="striped">
              <tbody>
                <tr>
                  <td>Birthday:</td>
                  <td>03/04/1990</td>
                </tr>
                <tr>
                  <td>Country:</td>
                  <td>USA</td>
                </tr>
                <tr>
                  <td>Languages:</td>
                  <td>English</td>
                </tr>
                <tr>
                  <td>Contact:</td>
                  <td>+(305) 254 24668</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div> --}}

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
                    {{-- <div id="icon-prefixes" class="card card-tabs">               --}}
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
