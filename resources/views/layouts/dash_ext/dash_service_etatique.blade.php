<div id="card-stats" class="pt-2">
    <div class="row">
        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content cyan white-text">

                    @if ($_SESSION['nom_type_entite'] == 'COMMISSION_CESSION')
                        <p class="card-stats-title"><i class="material-icons">group</i>
                            Receptions Traitées</p>

                        <h4 class="card-stats-number white-text" id=""> {{ $count_dist_comm_traite }} </h4>
                    @else
                        <p class="card-stats-title"><i class="material-icons">group</i>
                            Distributions FIA Traitées</p>
                        <h4 class="card-stats-number white-text" id="">{{ $request_dist_valide }}</h4>
                    @endif
                </div>
                <div class="card-action cyan darken-1">
                    <div id="clients-bar" class="center-align"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content red accent-2 white-text">

                    @if ($_SESSION['nom_type_entite'] == 'COMMISSION_CESSION')
                        <p class="card-stats-title"><i class="material-icons">keyboard_voice</i>
                            Distributions</p>
                        <h4 class="card-stats-number white-text" id="">
                            {{$count_recpt_com}}
                        </h4>
                    @else
                        <p class="card-stats-title"><i class="material-icons">keyboard_voice</i>
                            Distributions vers OP</p>
                        <h4 class="card-stats-number white-text" id="">
                            {{ $request_recept }}
                        </h4>
                    @endif

                </div>
                <div class="card-action red">
                    <div id="sales-compositebar" class="center-align"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card animate fadeRight">
                <div class="card-content orange lighten-1 white-text">
                    @if ($_SESSION['nom_type_entite'] == 'COMMISSION_CESSION')
                        <p class="card-stats-title"><i class="material-icons">done</i> Receptions FIA </p>

                        <h4 class="card-stats-number white-text" id=""> {{ $count_dist_comm }} </h4>
                    @else
                        <p class="card-stats-title"><i class="material-icons">done</i> Distributions FIA </p>

                        <h4 class="card-stats-number white-text" id="">{{ $request_dist_emise }}</h4>
                    @endif
                </div>
                <div class="card-action orange">
                    <div id="invoice-line" class="center-align"></div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l3">
            <div class="card animate fadeRight">
                <div class="card-content green lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">done</i> Besoins validés</p>
                    @if ($_SESSION['nom_type_entite'] == 'COMMISSION_CESSION')
                        <h4 class="card-stats-number white-text" id="">{{ $count_ebv_com }}</h4>
                    @else
                        <h4 class="card-stats-number white-text" id="">{{ $count_eb_valide_intrant }}</h4>
                    @endif
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
    </div>
</div>
{{-- <div id="work-collections">
    <div class="row">

        <div class="col s12 ">
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
                        <div class="col s4 right"><span class="task-cat cyan right" id="">
                            </span>
                        </div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s7">
                            <p class="collections-title">Date fin</p>
                        </div>
                        <div class="col s4 right"><span class="task-cat teal accent-4 right" id="">
                            </span>
                        </div>

                    </div>
                    
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s6">
                            <p class="collections-title">Durée</p>
                        </div>
                        <div class="col s6 right"><span class="task-cat red accent-4 right" id="">
                                mois
                                jours
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div> --}}
<div id="chart-dashboard">
    <div class="row">
        <div class="col s12">
            {{-- <div class="card animate fadeUp">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title "><i class="material-icons">group</i>
                        Producteurs/Organisation</span>
                    <div id="doughnut-chart-wrapper">
                        <canvas class="prod-by-organisation" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="divider"></div> --}}

            @if ($_SESSION['role'] == 'SERVICE_ETATIQUE')
                <div class="card animate fadeUp">
                    <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                        <span class="chart-title "><i class="material-icons">group</i>
                            FIA/Communes</span>
                        <div id="doughnut-chart-wrapper">
                            <canvas class="fia-by-commune" height="80"></canvas>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="card animate fadeUp">
                    <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                        <span class="chart-title "><i class="material-icons">group</i>
                            FIA/Distributions</span>
                        <div id="doughnut-chart-wrapper">
                            <canvas class="fia-by-distribution" height="80"></canvas>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="card animate fadeUp">
                    <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                        <span class="chart-title "><i class="material-icons">group</i>
                            Point de chute/Reception</span>
                        <div id="doughnut-chart-wrapper">
                            <canvas class="cc-by-distribution" height="80"></canvas>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
            @else
                <div class="card animate fadeUp">
                    <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                        <span class="chart-title "><i class="material-icons">group</i>
                            Receptions</span>
                        <div id="doughnut-chart-wrapper">
                            <canvas id="stat-distribution-cc" height="80"></canvas>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="card animate fadeUp">
                    <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                        <span class="chart-title "><i class="material-icons">group</i>
                            Distributions</span>
                        <div id="doughnut-chart-wrapper">
                            <canvas id="stat-reception-cc" height="80"></canvas>
                        </div>
                    </div>
                </div>
            @endif


            {{-- <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">

                    <span class="chart-title "><i class="material-icons">notifications_none
                        </i> Alerte
                    </span>

                    <div class="switch chart-revenue-switch right">
                        <label for="">--Année--</label>
                        <label class="cyan-text text-lighten-5">
                            <select name="yearA" id="yearA">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        @if ($year == $currentYear) selected @endif>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div id="chart-wrapper">
                        <canvas class="revenue-line-chart-alerte_ong" height="80"></canvas>
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
                                <td id="nb_voice_ong">-</td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td id="">Sms</td>
                                <td id="nb_sms_ong">-</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}
            {{-- <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">check_circle</i>
                        Prix du marche
                    </span>

                    <div class="col s9 right">
                        <div class=" col s3">
                            <label class="cyan-text text-lighten-5">
                                <select class="browser-default" name="marche" id="marche">
                                </select>
                            </label>
                        </div>
                        <div class=" col s3">
                            <label class="cyan-text text-lighten-5">
                                <select class="browser-default prod" name="prod" id="prod">
                                </select>
                            </label>
                        </div>
                        <div class="col s3">
                            <label class="cyan-text text-lighten-5">
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
            </div> --}}
        </div>
    </div>
</div>
@section('other-js-script')
    <script src="{{ asset('assets/js/analytics/intrant-analytics.js') }}"></script>
@endsection
