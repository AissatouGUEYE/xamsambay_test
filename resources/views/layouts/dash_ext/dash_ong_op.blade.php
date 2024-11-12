<div id="card-stats" class="pt-2">
    <div class="row">
        <div class="col s12 m6 l4">
            <div class="card animate fadeLeft">
                <div class="card-content cyan white-text">
                    <p class="card-stats-title"><i class="material-icons">group</i> Producteurs Actifs</p>
                    <h4 class="card-stats-number white-text" id="producteurco">
                        {{ $data[0] }}

                    </h4>

                </div>
                <div class="card-action cyan darken-1">
                    <div id="clients-bar" class="center-align"></div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card animate fadeRight">
                <div class="card-content orange lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">store</i>Pluvio</p>
                    <h4 class="card-stats-number white-text" id="nb_boutiqueco">
                        {{ $data[1] }}
                        {{-- {{"---"}} --}}
                    </h4>

                </div>
                <div class="card-action orange">
                    <div id="profit-tristate" class="center-align"></div>
                </div>
            </div>
        </div>

        {{-- <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content red accent-2 white-text">
                    <p class="card-stats-title"><i class="material-icons">keyboard_voice</i>MeteoMbay</p>
                    <h4 class="card-stats-number white-text" id="nbAlerteco">
                        {{ $data['nb_per_service']->nombre_camp_prod ? $data['nb_per_service']->nombre_camp_prod : 0 }}

                        {{-- {{ $data['stats_alertes']->nombre_sms + $data['stats_alertes']->nombre_voice }}
                    </h4>

                </div>
                <div class="card-action red">
                    <div id="sales-compositebar" class="center-align"></div>
                </div>
            </div>
        </div> --}}
        <div class="col s12 m6 l4">
            <div class="card animate fadeRight">
                <div class="card-content green lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">school</i>Organisations de Producteurs
                    </p>
                    <h4 class="card-stats-number white-text" id="nbCoursco">
                        {{ $data[2] }}
                        {{-- {{ $data['nb_per_service']->nombre_user_prix ? $data['nb_per_service']->nombre_user_prix : 0 }} --}}
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
        <div class="col s6 php">
            <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
                <li class="collection-item avatar">
                    <i class="material-icons cyan circle">trending_up</i>
                    <h6 class="collection-header ">Quelques chiffres</h6>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title">MLoumers</p>
                        </div>
                        <div class="col s4 right">
                            <span class="task-cat cyan right" id="mloumerco">
                                {{-- {{ $data['stats_entite']->mloumer }} --}}
                            </span>
                        </div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title">ONG</p>
                            {{-- <p class="collections-content">MediTab</p> --}}
                        </div>
                        <div class="col s4 right"><span class="task-cat teal accent-4 right" id="ONGco">
                                {{-- {{ $data['stats_entite']->ONG }} --}}
                            </span>
                        </div>

                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title">Fermes agricoles</p>
                            {{-- <p class="collections-content">MediTab</p> --}}
                        </div>
                        <div class="col s4 right"><span class="task-cat red accent-4 right" id="fermeco">
                                {{-- {{ $data['stats_entite']->ferme }} --}}
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        {{-- <div class="col s4">
            <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">
                <li class="collection-item avatar">
                    <i class="material-icons red accent-2 circle">store</i>
                    <h6 class="collection-header m-0">Packs Souscrits</h6>
                    <p>Montant (FCFA)</p>

                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title"> Xeweul</p>
                            {{-- <p class="collections-content">Souscrits</p>
                        </div>
                        <div class="col s2 right"><span class="task-cat deep-orange accent-2 right"
                                id="nbXeweulco">
                                {{ $data['stats_pack']->kheweul }}
                            </span>
                        </div>

                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title"> Confort</p>
                            {{-- <p class="collections-content">API Project</p>
                        </div>
                        <div class="col s3 right"><span class="task-cat cyan right" id="nbConfortco">
                                {{ $data['stats_pack']->confort }}
                            </span>
                        </div>

                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title"> Prestige</p>

                        </div>
                        <div class="col s2 right"><span class="task-cat red accent-2 right" id="nbPrestigeco">
                                {{ $data['stats_pack']->prestige }}
                            </span></div>

                    </div>
                </li>

            </ul>
        </div> --}}
        <div class="col s6 ">
            <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
                <li class="collection-item avatar">
                    <i class="material-icons orange circle">opacity</i>
                    <h6 class="collection-header ">Campagnes en cours</h6>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title">Date debut</p>
                        </div>
                        <div class="col s4 right">
                            <span class="task-cat cyan right" id="">
                                {{-- {{$campagnes_meteo->debut}} --}}
                            </span>
                        </div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title">Date fin</p>
                            {{-- <p class="collections-content">MediTab</p> --}}
                        </div>
                        <div class="col s4 right">
                            <span class="task-cat teal accent-4 right"id="">
                                {{-- {{$campagnes_meteo->fin}} --}}
                            </span>
                        </div>

                    </div>
                </li>
                @php
                    
                    // $d1 = new DateTime(date('d-m-Y', strtotime($campagnes_meteo->debut)));
                    // $d2 = new DateTime(date('d-m-Y', strtotime($campagnes_meteo->fin)));
                    // $duree = $d1->diff($d2);
                @endphp

                <li class="collection-item">
                    <div class="row">
                        <div class="col s6">
                            <p class="collections-title">Durée</p>
                            {{-- <p class="collections-content">MediTab</p> --}}
                        </div>
                        <div class="col s6 right"><span class="task-cat red accent-4 right" id="">
                                {{-- {{ $duree->m }} mois {{ $duree->d }} jours --}}
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="chart-dashboard">
    <div class="row">
        <div class="col s12">
            <div class="card animate fadeUp">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title "><i class="material-icons">group</i> Users</span>
                    <div class="switch chart-revenue-switch right">
                        <label for="">--Année--</label>
                        <label class="cyan-text text-lighten-5">
                            {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                            <select name="yearU" id="yearU">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        @if ($year == $currentYear) selected @endif>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div id="chart-wrapper">
                        <canvas id="users" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">check_circle</i> Prix du marche
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
            <div class="card animate fadeUp">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title "><i class="material-icons">playlist_add</i> Productions</span>
                    <div class="switch chart-revenue-switch right">
                        <label class="cyan-text text-lighten-5">
                            <select class="browser-default" name="list_ong" id="list_ong">
                            </select>
                        </label>
                    </div>
                    <div id="chart-wrapper">
                        <canvas id="revenue-line-chart-production-admin" height="80"></canvas>
                    </div>
                </div>
            </div>

            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">

                    <span class="chart-title "><i class="material-icons">notifications_none </i> Alerte
                    </span>

                    <div class="switch chart-revenue-switch right">
                        <label for="">--Année--</label>
                        <label class="cyan-text text-lighten-5">
                            {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                            <select name="yearAA" id="yearAA">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        @if ($year == $currentYear) selected @endif>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div id="chart-alerte-wrapper">
                        <canvas id="revenue-line-chart-alerte" height="80"></canvas>
                    </div>

                </div>
                <div class="card-content">
                    <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                        <i class="material-icons activator">filter_list</i>
                    </a>


                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Voice/Sms
                        <i class="material-icons right">close
                        </i>
                    </span>
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th data-field="id">ID</th>
                                <th data-field="item-sold">Type</th>
                                <th data-field="total-profit">Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td id="">Voice</td>
                                <td id="nb_voice">-</td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td id="">Sms</td>
                                <td id="nb_sms">-</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">opacity</i> Informations
                        climatiques</span>
                    <div>
                        <div class="switch chart-revenue-switch right col s3">
                            <label for="">--Année--</label>
                            <label class="cyan-text text-lighten-5">
                                <select name="yearCA" id="yearCA">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                            @if ($year == $currentYear) selected @endif>{{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="col s6 mt-6">
                            <div id="revenue-line-chart-collecte-admin-wrapper">

                                <canvas id="revenue-line-chart-collecte-admin" height="200"></canvas>
                            </div>
                        </div>
                        <div class=" col s6">
                            <div id="revenue-line-chart-prevision-admin-wrapper">
                                <canvas id="revenue-line-chart-prevision-admin" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">record_voice_over</i> Expression de
                        Besoins
                </div>
                </span>
                <div id="doughnut-chart-wrapper">
                    <canvas id="pie-besoin-admin" height="80"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>
