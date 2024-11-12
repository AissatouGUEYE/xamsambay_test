<div id="card-stats" class="pt-2">
    <div class="row">
        <div class="col s12 m6 l3">
            <div class="card animate fadeRight">
                <div class="card-content green lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">group</i> Transporteurs
                        actifs</p>
                    <h4 class="card-stats-number white-text" id="transporteurco">
                        {{-- {{ $data['stats_entite']->transporteur }} --}}
                        {{$stats[4]->transporteur}}
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
                    <p class="card-stats-title"><i class="material-icons">done</i> Localites
                        desservis
                    </p>
                    <h4 class="card-stats-number white-text" id="">-</h4>

                </div>
                <div class="card-action orange">
                    <div id="profit-tristate" class="center-align"></div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content red accent-2 white-text">
                    <p class="card-stats-title"><i class="material-icons">shop</i> Packs</p>
                    <h4 class="card-stats-number white-text" id="nbPacksco">
                        {{-- {{ count((array) $data['stats_pack']) }}--}}
                    </h4>
                </div>
                <div class="card-action red">
                    <div id="sales-compositebar" class="center-align"></div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content cyan white-text">
                    <p class="card-stats-title"><i class="material-icons">record_voice_over</i>
                        Besoins
                    </p>
                    <h4 class="card-stats-number white-text" id="ebco">
                        {{-- {{ $data['besoin']->nb_eb_valides + $data['besoin']->nb_eb_non_valides }} --}}
                        {{$besoins->nb_eb_non_valides}}
                    </h4>

                </div>
                <div class="card-action cyan darken-1">
                    <div id="clients-bar" class="center-align"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="chart-dashboard">
    <div class="row">
        <div class="card animate fadeUp">
            <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">

                <span class="chart-title "><i class="material-icons"> directions</i> Transports
                </span>

                <div class="switch chart-revenue-switch right">
                    <label for="">--Année--</label>
                    <label class="cyan-text text-lighten-5">
                        {{-- Month <input type="checkbox" /> <span class="lever"></span> Year --}}
                        <select name="yearT" id="yearT">
                            @foreach ($years as $year)
                                <option value="{{ $year }}" @if ($year == $currentYear) selected @endif>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div id="chart-wrapper">
                    <canvas id="revenue-line-chart-transport" height="80"></canvas>
                </div>

            </div>
            <div class="divider"></div>
            <div class="card animate fadeUp">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">

                    <span class="chart-title "><i class="material-icons">location_city</i>
                        Localites</span>

                    <div class="row">

                        <div id="chart-wrapper" class="col s12">
                            <canvas id="transport-by-localite" height="80"></canvas>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card animate fadeUp mt-0">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">record_voice_over</i>
                        Expression de
                        Besoins
                    </span>
                </div>
                </span>
                <div id="doughnut-chart-wrapper">
                    <canvas id="pie-besoin" height="80"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
