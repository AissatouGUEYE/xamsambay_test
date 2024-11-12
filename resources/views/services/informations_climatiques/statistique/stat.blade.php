@extends('layouts.master')
@section('page-title')
    @if ($_SESSION['nom_entite'] == 'Admin')
        @if (isset($_SESSION['role_user']))
            {{ $_SESSION['role_user'] }} ({{ $_SESSION['nom_entite'] }})
        @else
            {{ $_SESSION['nom_entite'] }}
        @endif
    @else
        {{ $_SESSION['nom_entite'] }}
    @endif
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/admin">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Informations climatiques</a>
    </li>
    <li class="breadcrumb-item active ">
        <a class="yellow-text" href="#">Statistiques</a>
    </li>
@endsection
@php
    $userid = Auth::user()->id;
    $id_entite = $_SESSION['id_entite'];
    $id_profil = $_SESSION['id'];

    $id_groupement = isset($_SESSION['groupement']) ? $_SESSION['groupement'] : null;

    $appels = intval($_SESSION['appels']);
    $init = $_SESSION['appels'];
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;
    //  dd( $data['stats_entite']);
@endphp
@section('main_content')
    <input type="text" id="id_user" hidden value="{{ $userid }}">
    <input type="text" name="id_entite" id="id_entite" hidden value="{{ $id_entite }}">
    <input type="text" name="id_profil" id="id_profil" hidden value="{{ $id_profil }}">
    <input type="text" name="id_groupement" id="id_groupement" hidden value="{{ $id_groupement }}">

    {{-- @if ($_SESSION['role'] === 'ADMIN' || $_SESSION['role'] === 'SUPERADMIN') --}}
        <div id="card-stats" class="pt-2">
            <div class="row">

                <div class="col s12 m6 l4">
                    <div class="card animate fadeLeft">
                        <div class="card-content red accent-2 white-text">
                            <p class="card-stats-title">
                                <i class="material-icons">place</i>
                                Collectes / SMS
                            </p>
                            <h4 class="card-stats-number white-text" id="nbAlerteco">
                                {{-- {{ $data['nb_per_service']->nombre_camp_prod ? $data['nb_per_service']->nombre_camp_prod : 0 }} --}}
                                {{ $collecte }}
                            </h4>

                        </div>
                        <div class="card-action red">
                            <div id="sales-compositebar" class="center-align"></div>
                        </div>
                    </div>
                </div>


                <div class="col s12 m6 l4">
                    <div class="card animate fadeLeft">
                        <div class="card-content cyan white-text">
                            <p class="card-stats-title">
                                <i class="material-icons">filter_drama</i>
                                Prévisions / SMS
                            </p>
                            <h4 class="card-stats-number white-text" id="producteurco">
                                {{-- {{ $data['stats_entite']->nb_prod_enrolle }} --}}
                                {{ $prev_sms }}

                            </h4>

                        </div>
                        <div class="card-action cyan darken-1">
                            <div id="clients-bar" class="center-align"></div>
                        </div>
                    </div>
                </div>

                <div class="col s12 m6 l4">
                    <div class="card animate fadeRight">
                        <div class="card-content green lighten-1 white-text">
                            <p class="card-stats-title">
                                <i class="material-icons">filter_drama</i>
                                Prévisions / VOICE
                            </p>
                            <h4 class="card-stats-number white-text" id="nbCoursco">
                                {{-- {{dd($data['nb_per_service'])}} --}}
                                {{-- {{ $data['nb_per_service']->nombre_user_prix ? $data['nb_per_service']->nombre_user_prix : 0 }} --}}
                                {{ $prev_voice }}
                            </h4>
                        </div>
                        <div class="card-action green">
                            <div id="invoice-line" class="center-align"></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div id="work-collections">
            <div class="row">

            </div>
        </div>
        <div id="chart-dashboard">
            <div class="row">
                <div class="col s12">

                    <div class="card animate fadeUp mt-0">
                        <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                            <span class="chart-title"><i class="material-icons">opacity</i> Collectes
                            </span>
                            <div>
                                <div class="switch chart-revenue-switch right col s3">
                                    <label for="">--Année--</label>
                                    <label class="cyan-text text-lighten-5">
                                        <select name="yearCollecte" id="yearCollecte">
                                            <option value="2023" selected>2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                        </select>
                                    </label>
                                </div>
                                <div class=" col s12">
                                    <div id="chart-wrapper">
                                        <canvas id="revenue-line-chart-production-admin" height="100"></canvas>
                                    </div>
                                </div>
                                {{-- <div class="col s12 mt-4">
                                    <div id="revenue-line-chart-collecte-admin-wrapper">

                                        <canvas id="revenue-line-chart-collecte-admin" height="100" style="padding-top = 20%;"></canvas>
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                    </div>

                    <div class="card animate fadeUp">
                        <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                            <span class="chart-title "><i class="material-icons">filter_drama</i> Prévisions</span>
                            <div class="switch chart-revenue-switch right">
                                <label for="">--Année--</label>
                                <label class="cyan-text text-lighten-5">
                                    {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                                    <select name="yearPrevision" id="yearPrevision">
                                        {{-- <option value="" disabled selected >--Choisir l'année--</option> --}}
                                        <option value="2023" selected>2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                    </select>
                                </label>
                            </div>
                            <div id="chart-wrapper">
                                <canvas id="users" height="100"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    {{-- @endif --}}
    
@endsection

@section('other-js-script')
    <script src="{{ asset('assets/js/analytics/stat.js') }}"></script>
@endsection
