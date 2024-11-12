<div id="card-stats" class="pt-2">
    <div class="row">
        @if ($_SESSION['role'] === 'MLOUMER')
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content green lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">group</i> Mloumers
                            actifs
                        </p>
                        <h4 class="card-stats-number white-text" id="mloumerco">
                            {{-- {{ $data['stats_entite']->mloumer }} --}}
                            {{$stats[2]->mloumer}}
                        </h4>

                    </div>
                    <div class="card-action green">
                        <div id="invoice-line" class="center-align"></div>
                    </div>
                </div>

            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content orange lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">done</i> Prix renseignés
                        </p>
                        <h4 class="card-stats-number white-text" id="nbPrixRensco">
                            {{-- {{ $data['nb_prix_by_mloumer'] }} --}}
                        </h4>

                    </div>
                    <div class="card-action orange">
                        <div id="profit-tristate" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeLeft">
                    <div class="card-content red accent-2 white-text">
                        <p class="card-stats-title"><i class="material-icons">shop</i> Marchés</p>
                        <h4 class="card-stats-number white-text" id="marche_mloumerco">
                            {{-- {{ $data['nb_market_mloumer'] }} --}}
                        </h4>

                    </div>
                    <div class="card-action red">
                        <div id="sales-compositebar" class="center-align"></div>
                    </div>
                </div>
            </div>
        @else
            {{--     Acheteur       --}}
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content green lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">group</i> Acheteurs
                            actifs
                        </p>
                        <h4 class="card-stats-number white-text" id="acheteurco">
                            {{-- {{ $data['stats_entite']->acheteur }} --}}
                            {{$stats[10]->acheteur}}
                        </h4>

                    </div>
                    <div class="card-action green">
                        <div id="invoice-line" class="center-align"></div>
                    </div>
                </div>

            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content orange lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">store</i> Boutiques
                        </p>
                        <h4 class="card-stats-number white-text" id="nb_boutiqueco">
                            {{-- {{ $data['nb_btq'] }} --}}

                        </h4>

                    </div>
                    <div class="card-action orange">
                        <div id="profit-tristate" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeLeft">
                    <div class="card-content red accent-2  white-text">
                        <p class="card-stats-title"><i class="material-icons">shop</i>Packs</p>
                        <h4 class="card-stats-number white-text" id="nbPacksco">
                            {{-- {{ count((array) $data['stats_pack']) }} --}}
                        </h4>

                    </div>
                    <div class="card-action red">
                        <div id="clients-bar" class="center-align"></div>
                    </div>
                </div>
            </div>

        @endif
        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content cyan white-text">
                    <p class="card-stats-title"><i class="material-icons">record_voice_over</i>
                        Besoins
                    </p>
                    <h4 class="card-stats-number white-text" id="ebco">
                        {{-- {{ $data['besoin']->nb_eb_valides + $data['besoin']->nb_eb_non_valides }} --}}
                        {{  $besoins->nb_eb_non_valides }}
                    </h4>

                </div>
                <div class="card-action cyan darken-1">
                    <div id="clients-bar" class="center-align"></div>
                </div>
            </div>
        </div>

    </div>
</div>
@if ($_SESSION['role'] === 'MLOUMER')
    {{--    <div id="work-collections">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col s6 ">--}}
    {{--                <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">--}}
    {{--                    <li class="collection-item avatar">--}}
    {{--                        <i class="material-icons red accent-2 circle">store</i>--}}
    {{--                        <h6 class="collection-header m-0">Packs</h6>--}}
    {{--                        <p>Souscrits</p>--}}

    {{--                    </li>--}}
    {{--                    <li class="collection-item">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col s7">--}}
    {{--                                <p class="collections-title"> Xeweul</p>--}}
    {{--                                --}}{{-- <p class="collections-content">Souscrits</p> --}}
    {{--                            </div>--}}
    {{--                            <div class="col s2 right"><span class="task-cat deep-orange accent-2 right"--}}
    {{--                                                            id="xeweulco">--}}
    {{--                                    --}}{{-- {{ $data['stats_pack']->kheweul }} --}}
    {{--                                </span></div>--}}

    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                    <li class="collection-item">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col s7">--}}
    {{--                                <p class="collections-title"> Confort</p>--}}
    {{--                                --}}{{-- <p class="collections-content">API Project</p> --}}
    {{--                            </div>--}}
    {{--                            <div class="col s3 right"><span class="task-cat cyan right" id="confortco">--}}
    {{--                                    --}}{{-- {{ $data['stats_pack']->confort }} --}}

    {{--                                </span>--}}
    {{--                            </div>--}}

    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                    <li class="collection-item">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col s7">--}}
    {{--                                <p class="collections-title"> Prestige</p>--}}

    {{--                            </div>--}}
    {{--                            <div class="col s2 right"><span class="task-cat red accent-2 right" id="prestigeco">--}}
    {{--                                    --}}{{-- {{ $data['stats_pack']->prestige }} --}}
    {{--                                </span></div>--}}

    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--            <div class="col s6 ">--}}
    {{--                <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">--}}
    {{--                    <li class="collection-item avatar">--}}
    {{--                        <i class="material-icons orange circle">opacity</i>--}}
    {{--                        <h6 class="collection-header ">Campagnes en cours</h6>--}}
    {{--                    </li>--}}
    {{--                    <li class="collection-item">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col s7">--}}
    {{--                                <p class="collections-title">Date debut</p>--}}
    {{--                            </div>--}}
    {{--                            <div class="col s4 right"><span class="task-cat cyan right"--}}
    {{--                                                            id="">--}}

    {{--                                    --}}{{-- {{ $campagnes_meteo->debut }} --}}
    {{--                                </span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                    <li class="collection-item">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col s7">--}}
    {{--                                <p class="collections-title">Date fin</p>--}}
    {{--                                --}}{{-- <p class="collections-content">MediTab</p> --}}
    {{--                            </div>--}}
    {{--                            <div class="col s4 right"><span class="task-cat teal accent-4 right"--}}
    {{--                                                            id="">--}}
    {{--                                    --}}{{-- {{ $campagnes_meteo->fin }} --}}
    {{--                                </span>--}}
    {{--                            </div>--}}

    {{--                        </div>--}}
    {{--                        --}}{{-- @php--}}
    {{--                            $d1 = new DateTime(date('d-m-Y', strtotime($campagnes_meteo->debut)));--}}
    {{--                            $d2 = new DateTime(date('d-m-Y', strtotime($campagnes_meteo->fin)));--}}
    {{--                            $duree = $d1->diff($d2);--}}
    {{--                        @endphp --}}
    {{--                    </li>--}}
    {{--                    <li class="collection-item">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col s6">--}}
    {{--                                <p class="collections-title">Durée</p>--}}
    {{--                                --}}{{-- <p class="collections-content">MediTab</p> --}}
    {{--                            </div>--}}
    {{--                            <div class="col s6 right"><span class="task-cat red accent-4 right" id="">--}}
    {{--                                    --}}{{-- {{ $duree->m }} mois {{ $duree->d }} jours --}}
    {{--                                </span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}

    {{--        </div>--}}
    {{--    </div>--}}
@endif

<div id="chart-dashboard">
    <div class="row">
        <div class="col s12">
            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">check_circle</i> Prix Produit
                    </span>

                    <div class="col s6 right">
                        <div class=" col s3">
                            {{-- <label for="">--Produit--</label> --}}
                            <label class="cyan-text text-lighten-5">
                                <select class="browser-default prod" name="prod" id="prod">
                                </select>
                            </label>
                        </div>
                        <div class="col s3">
                            {{-- <label for="">--Année--</label> --}}
                            <label class="cyan-text text-lighten-5">
                                {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                                <select name="yearProd" id="yearProd">

                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                                @if ($year == $currentYear) selected @endif>{{ $year }}
                                        </option>
                                    @endforeach

                                </select>
                            </label>
                        </div>
                    </div>
                    <div id="chart-wrapper">
                        <canvas id="revenue-line-chart-produit" height="100"></canvas>
                    </div>

                </div>
            </div>
            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">record_voice_over</i>
                        Expression
                        de
                        Besoins
                    </span>
                </div>
                </span>
                <div id="doughnut-chart-wrapper">
                    <canvas id="pie-besoin" height="80"></canvas>
                </div>
            </div>
            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">check_circle</i> Prix du
                        marche
                    </span>

                    <div class="col s9 right">
                        <div class=" col s3">
                            {{-- <label for="">--Produit--</label> --}}
                            <label class="cyan-text text-lighten-5">
                                <select class="browser-default" name="marche" id="marche">
                                </select>
                            </label>
                        </div>
                        <div class=" col s3">
                            {{-- <label for="">--Produit--</label> --}}
                            <label class="cyan-text text-lighten-5">
                                <select class="browser-default prod" name="prod" id="prod">
                                </select>
                            </label>
                        </div>
                        <div class="col s3">
                            {{-- <label for="">--Année--</label> --}}
                            <label class="cyan-text text-lighten-5">
                                {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                                <select name="yearPrixMarche" id="yearPrixMarche">

                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                                @if ($year == $currentYear) selected @endif>{{ $year }}
                                        </option>
                                    @endforeach

                                </select>
                            </label>
                        </div>
                    </div>
                    <div id="chart-wrapper">
                        <canvas id="revenue-line-chart-prix-marche" height="100"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
