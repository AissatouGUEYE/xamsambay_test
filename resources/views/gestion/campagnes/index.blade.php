{{-- @extends('layouts.master')
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
</li>

    <li class="breadcrumb-item active">Campagne
    </li>
@endsection

@section('main_content')
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            <div class="card-panel">
                <div class="row ">
                    <form method="POST" action="#">
                        @csrf
                        <div class="col s12 m6 l3">
                            <label for="users-list-verified">Intitulé</label>
                            <div class="input-field">
                                <input class="" type="text">

                            </div>
                        </div>
                        <div class="col s12 m6 l2">
                            <label for="users-list-verified">Date de début</label>
                            <div class="input-field">
                                <input class="datepicker" type="text">

                            </div>
                        </div>
                        <div class="col s12 m6 l2">
                            <label for="users-list-role">Date de fin</label>
                            <div class="input-field">
                                <input class="datepicker" type="text">
                            </div>
                        </div>
                        <div class="col s12 m6 l3">
                            <label for="users-list-status">Description</label>
                            <div class="input-field">
                                <input type="text">
                            </div>
                        </div>
                        <div class="col s12 m6 l2 mt-2">
                            <div class="input-field ">
                                <a class="waves-effect waves-light green btn"><i class="material-icons left">add</i>
                                    Enregistrer</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col s12">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">spa</i> Campagne de production </div>
                        <div class="collapsible-body">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>Entité</th>
                                        <th>Type</th>
                                        <th>Date d'inscription</th>
                                        <th>Etat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    {{-- @foreach ($entitiesList as $entities)
                                    <tr>
                                        <td>date</td>
                                        <td>fin</td>
                                        <td>Description</td>
                                        <td>
                                            <a href='#' onclick='deactivate()' class='inactif'>
                                                <span class='chip green lighten-5'><span class='green-text'>Actif</span></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='#'><i class="material-icons">visibility</i></a>
                                            <a href='#' class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                        </td>
                                    </tr>
                                    {{-- @endforeach

                                </tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">cloud_queue</i> Campagne de diffusion
                            climatique</div>
                        <div class="collapsible-body">
                            {{-- CONTAIN
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>Entité</th>
                                        <th>Type</th>
                                        <th>Date d'inscription</th>
                                        <th>Etat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    {{-- @foreach ($entitiesList as $entities)
                                    <tr>
                                        <td>date</td>
                                        <td>fin</td>
                                        <td>Description</td>
                                        <td>
                                            <a href='#' onclick='deactivate()' class='inactif'>
                                                <span class='chip green lighten-5'><span class='green-text'>Actif</span></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='#'><i class="material-icons">visibility</i></a>
                                            <a href='#' class="px-1"><i class="material-icons orange-text ">edit</i></a>
                                        </td>
                                    </tr>
                                    {{-- @endforeach

                                </tbody>
                            </table>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
@endsection
--}}
