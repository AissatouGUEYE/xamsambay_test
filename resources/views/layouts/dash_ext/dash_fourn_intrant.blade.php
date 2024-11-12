<div id="card-stats" class="pt-2">
    <div class="row">
        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content green lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">group</i>
                        Fournisseurs
                        actifs</p>
                    <h4 class="card-stats-number white-text" id="fournisseur_intrantco">
                        {{-- {{ $data['stats_entite']->fournisseur_intrant }} --}}
                        {{ $stats[9]->fournisseur_intrant }}
                    </h4>

                </div>
                <div class="card-action green darken-1">
                    <div id="clients-bar" class="center-align"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card animate fadeLeft">
                <div class="card-content red accent-2 white-text">
                    <p class="card-stats-title"><i class="material-icons">location_on</i>
                        Communes</p>
                    <h4 class="card-stats-number white-text" id="nbPacksco">
                        {{ $count_communes }}
                    </h4>
                </div>
                <div class="card-action red">
                    <div id="sales-compositebar" class="center-align"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card animate fadeRight">
                <div class="card-content orange lighten-1 white-text">
                    <p class="card-stats-title"><i class="material-icons">done</i> Distributions</p>
                    <h4 class="card-stats-number white-text" id="">{{ $request_dist_emise }}</h4>

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
                    <h4 class="card-stats-number white-text" id="">{{ $count_eb_valide_intrant }}</h4>

                </div>
                <div class="card-action green">
                    <div id="invoice-line" class="center-align"></div>
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
                    <span class="chart-title "><i class="material-icons">group</i>
                        FIA/Distributions</span>
                    <div id="doughnut-chart-wrapper">
                        <canvas id="stat-distribution" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('other-js-script')
<script src="{{ asset('assets/js/analytics/fia-analytics.js') }}"></script>
@endsection
