<div id="card-stats" class="pt-2">
    <div class="row">
        <div class="col s12 m6 l3">
            <div class="card animate fadeRight">
                <div class="card-content green lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">lock_open</i>
                        Banques
                    </p>
                    <h4 class="card-stats-number white-text" id="financierco">
                        {{-- {{ $data['stats_entite']->financier }} --}}
                        {{$stats[5]->financier}}
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
                    <p class="card-stats-title"><i class="material-icons">store</i>
                        Agences
                    </p>
                    <h4 class="card-stats-number white-text" id="agenceco">
                        {{-- {{ $data['stats_entite']->agence }} --}}
                        {{$stats[11]->agence}}
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
                    <p class="card-stats-title"><i class="material-icons">shop</i> Packs
                    </p>
                    <h4 class="card-stats-number white-text" id="nbPacksco">
                        {{-- {{ count((array) $data['stats_pack']) }} --}}
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
                    <p class="card-stats-title"><i class="material-icons">done</i>
                        Offres de credit
                    </p>
                    <h4 class="card-stats-number white-text" id="offre">-</h4>

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
        <div class="col s12">
            <div class="card animate fadeUp">
                <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                    <span class="chart-title"><i class="material-icons">done</i> Offres
                        de
                        credit
                    </span>
                    <div>
                        <div class="switch chart-revenue-switch right col s3">
                            <label for="">--Année--</label>
                            <label class="cyan-text text-lighten-5">
                                <select name="year_agence" id="year_agence">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                            @if ($year == $currentYear) selected @endif>{{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div id="chart-wrapper">
                            <canvas id="agences_banques" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            @if ($_SESSION['role'] === 'ASSURANCE')
                <div class="card animate fadeUp">
                    <div class="card-move-up waves-effect waves-block waves-light" style="padding: 20px">
                        <span class="chart-title "><i class="material-icons">group</i>
                            Declarations sinistres</span>
                        <div id="doughnut-chart-wrapper">
                            <canvas id="dec-by-sinistres" height="80"></canvas>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
