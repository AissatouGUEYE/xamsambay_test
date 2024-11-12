@extends('layouts.master')

@section('main_content')
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@if ($_SESSION['role'] == 'FERME AGRICOLE')
    @section('ariane')
        <li class="breadcrumb-item">
            <a href="/dashboard">Dashboard</a>
        </li>
    @endsection


    {{-- <h1>Statistiques</h1> --}}
    <div id="card-stats" class="pt-2">
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="card animate fadeLeft">
                    <div class="card-content cyan white-text">
                        <p class="card-stats-title"><i class="material-icons">playlist_add</i>Produits</p>
                        <h4 class="card-stats-number white-text" id="nbProd">-</h4>
                        {{-- <p class="card-stats-compare">
                       <i class="material-icons">keyboard_arrow_up</i> 15%
                       <span class="cyan text text-lighten-5">from yesterday</span>
                    </p> --}}
                    </div>
                    <div class="card-action cyan darken-1">
                        <div id="clients-bar" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeLeft">
                    <div class="card-content red accent-2 white-text">
                        <p class="card-stats-title"><i class="material-icons">shopping_cart</i>Ventes</p>
                        <h4 class="card-stats-number white-text" id="soldeVente">-</h4>
                        {{-- <p class="card-stats-compare">
                       <i class="material-icons">keyboard_arrow_up</i> 70% <span class="red-text text-lighten-5">last
                          month</span>
                    </p> --}}
                    </div>
                    <div class="card-action red">
                        <div id="sales-compositebar" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content orange lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">trending_up</i> Decaissements</p>
                        <h4 class="card-stats-number white-text" id="soldeDec">-</h4>
                        {{-- <p class="card-stats-compare">
                       <i class="material-icons">keyboard_arrow_up</i> 80%
                       <span class="orange-text text-lighten-5">from yesterday</span>
                    </p> --}}
                    </div>
                    <div class="card-action orange">
                        <div id="profit-tristate" class="center-align"></div>
                    </div>
                </div>
            </div>
            @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                <div class="col s12 m6 l3">
                    <div class="card animate fadeRight">
                        <div class="card-content green lighten-1 white-text">
                            <p class="card-stats-title"><i class="material-icons">card_giftcard
                                </i> Banque</p>
                            <h4 class="card-stats-number white-text" id="soldeBanque">-</h4>
                            {{-- <p class="card-stats-compare">
                       <i class="material-icons">keyboard_arrow_down</i> 3%
                       <span class="green-text text-lighten-5">from last month</span>
                    </p> --}}
                        </div>
                        <div class="card-action green">
                            <div id="invoice-line" class="center-align"></div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col s12 m6 l3">
                    <div class="card animate fadeRight">
                        <div class="card-content green lighten-1 white-text">
                            <p class="card-stats-title"><i class="material-icons">done</i> Besoins valides</p>
                            <h4 class="card-stats-number white-text" id="nbBesoin">-</h4>
                            {{-- <p class="card-stats-compare">
                       <i class="material-icons">keyboard_arrow_down</i> 3%
                       <span class="green-text text-lighten-5">from last month</span>
                    </p> --}}
                        </div>
                        <div class="card-action green">
                            <div id="invoice-line" class="center-align"></div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
    {{-- <div class="col s12 m8 l6">
        <div id="doughnut-chart-wrapper">
            <h4>ventes/Produits </h4>
           <canvas id="pie" height="200"></canvas>

        </div>
     </div> --}}


    {{--  --}}
    <div id="chart-dashboard">
        <div class="row">
            <div class="col s12">
                <div class="card animate fadeUp">
                    @if ($_SESSION['profil'] == 'MANAGER' || $_SESSION['profil'] == 'PRESIDENT')
                        <div class="card-move-up waves-effect waves-block waves-light">
                            <div class="move-up darken-1">
                                <div>
                                    <span class="chart-title cyan-text">Ventes</span>

                                    <div class="switch chart-revenue-switch right">
                                        <label for="">--Année--</label>
                                        <label class="cyan-text text-lighten-5">
                                            {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                                            <select name="year" id="year">
                                                {{-- <option value="" disabled selected >--Choisir l'année--</option> --}}
                                                <option value="2022" selected>2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="">
                                    <canvas id="revenue-line-chart-vente" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                                <i class="material-icons activator">filter_list</i>
                            </a>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Top 5 Produits


                                <i class="material-icons right">close
                                </i>
                            </span>
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th data-field="id">ID</th>

                                        <th data-field="item-sold">Produit</th>
                                        {{-- <th data-field="item-price">Quantite</th> --}}
                                        <th data-field="total-profit">Total Profit (FCFA)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td id="prod1">-</td>
                                        <td id="som1">-</td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td id="prod2">-</td>
                                        <td id="som2">-</td>

                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td id="prod3">-</td>
                                        <td id="som3">-</td>

                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td id="prod4">-</td>
                                        <td id="som4">-</td>

                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td id="prod5">-</td>
                                        <td id="som5">-</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="divider"></div>
                    <div class="row">
                        <div class="col s6 m8 l6">
                            <div id="doughnut-chart-wrapper">
                                <span class="chart-title orange-text">Besoins/Decaissement</span>
                                <canvas id="pie" style="align-content: center"></canvas>

                            </div>
                        </div>
                        <div class="switch chart-revenue-switch right">
                            <label for="">--Année--</label>
                            <label class="cyan-text text-lighten-5">
                                <select name="annee" id="annee">
                                    {{-- <option value="" disabled selected>--Année--</option> --}}
                                    {{-- <option value="" disabled selected >--Choisir l'année--</option> --}}
                                    <option value="2022" selected>2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>

                            </label>

                        </div>
                        <div class="col s6 m8 l6">


                            <div>
                                <canvas id="barre"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endif
@endsection
@section('other-js-script')
<script src="{{ asset('assets/js/analytics/ferme-analytics.js') }}"></script>
@endsection
