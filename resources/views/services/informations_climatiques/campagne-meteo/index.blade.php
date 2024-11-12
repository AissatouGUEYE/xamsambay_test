@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">

@endsection
@section('page-title')
    Campagnes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Acceuil</a>
    </li>
    {{-- <li class="breadcrumb-item">
   <a href="#">Utilisateurs</a>
</li> --}}

    <li class="breadcrumb-item active">Campagne
    </li>
@endsection

@section('main_content')
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            @include('services.informations_climatiques.campagne-meteo.campagne-actif')
        </div>
          <div class="users-list-table">
            <div class="card">
              <div class="card-content">
                    <a class="waves-effect waves-light  green darken-1 btn modal-trigger right" href="#modal1"> <i
                            class="material-icons">add</i> Nouvelle Campagne
                    </a>
                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>Nouvelle Campagne</h4>
                            <div class="divider mt-2"></div>
                            <form id="form-campagne-update" method="POST" action="#">
                                @csrf
                                <div class="row">
                                    {{-- <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <input class="" type="text"  required>
                                            <label class="active" for="users-list-verified">Intitulé</label>
                                        </div>
                                    </div> --}}
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <input class="datepicker" type="text" required name="debut">
                                            <label class="active" for="users-list-role">Date de début</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <input class="datepicker" type="text" required name="fin">
                                            <label class="active" for="users-list-verified">Date de fin</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    {{-- <div class="col s12 m6 l6">
                                        <div class="input-field">
                                            <input type="text">
                                            <label class="active" for="users-list-status">Description</label>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <a id="swalert" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>

                <div class="row ">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                {{-- <th>Intitulé</th> --}}
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                {{-- <th>Jours restant</th> --}}
                                <th>Etat</th>
                                <th>Action</th>
                                <th>Date de dernière modification</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($campagnes_meteo as $cm)
                            <tr>
                                {{-- <td>{{$cm->id}}</td> --}}
                                <td>{{date('d-m-Y',strtotime($cm->debut))}}</td>
                                <td>{{date('d-m-Y',strtotime($cm->fin))}}</td>
                                {{-- <td>Description</td> --}}
                                @if ($cm->actif == true)

                                    <td>
                                        <a href='#' id='{{$cm->id}}' class='inactif deactivate_campagne'>
                                            <span class='chip green lighten-5'><span class='green-text'>Actif</span></span>
                                        </a>
                                    </td>
                                    <td>

                                        <a id="{{$cm->id}}" href="#edit-campagne-modal"  class='edit-campagne  modal-trigger'>
                                            <span class='chip yellow lighten-5'><span class='yellow-text'>Modifier</span></span>
                                        </a>
                                        <a id='{{$cm->id}}' class="btn-delete-campagne" href="#" >
                                            <span class='chip red lighten-5'><span class='red-text'>Supprimer</span></span>
                                        </a>
                                    </td>
                                @else
                                <td>
                                    <a href='#' id="{{$cm->id}}"  class='inactif activate_campagne'>
                                        <span class='chip red lighten-3'><span class='red-text'>Inactif</span></span>
                                    </a>
                                </td>
                                <td>---</td>

                                @endif
                                <td> <em> {{date('d-m-Y h:m:s',strtotime($cm->updated_at))}}</em></td>



                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @include('services.informations_climatiques.campagne-meteo.edit')

                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/providers/message.js') }}"></script>
    <script src="{{ asset('assets/js/providers/set_state.js')}}"></script>
    <script src="{{ asset('assets/js/crud/gestion/delete.js')}}"></script>
    <script src="{{ asset('assets/js/crud/gestion/edit.js')}}"></script>
    <script src="{{ asset('assets/js/crud/gestion/update.js')}}"></script>

    <script src="{{ asset('assets/js/scripts/card-advanced.js')}}"></script>

@endsection
