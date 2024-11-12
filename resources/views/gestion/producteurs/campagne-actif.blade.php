<div class="card-panel center-align">
    <div class="card-content center-align">
        <div id="card-stats" class="row  center-align">
            {{-- <div class="">
                <div class="col s6 m3 l4 z-depth-3  white-text">
                    <p class="card-stats-title green z-depth-2">
                        <b>Campagne actif</b><br>
                    </p>
                    <h6 class="">{{ $campagne_actif->id }}</h6>
                </div>
            </div> --}}
            <div class="">
                <div class="col s12 m6 l6 z-depth-3  white-text">
                    <p class="card-stats-title green z-depth-2">
                        <b>Début de la campagne active</b><br>
                    </p>
                    <h6 class="">{{ date('d-m-Y', strtotime($campagne_actif->debut)) }}</h6>
                </div>
            </div>
            <div class="">
                <div class="col s12 m6 l6 z-depth-3  white-text">
                    <p class="card-stats-title green z-depth-2">
                        <b>Fin de la campagne active</b><br>
                    </p>
                    <h6 class="">{{ date('d-m-Y', strtotime($campagne_actif->fin)) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
