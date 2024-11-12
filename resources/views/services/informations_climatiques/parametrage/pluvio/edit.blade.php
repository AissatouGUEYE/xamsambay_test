<div id="modal-edit-pluvio" class="modal">
    <div class="modal-content">
        <h4>Mise à jour pluvio</h4>
        <div class="divider mt-2"></div>
        <form id="form-pluvio-update" method="POST" action="#">
            @csrf

            <div class="row">
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        {{-- {{print_r($regions)}} --}}
                        <select class="browser-default region" id="region-pluvio" name="">
                            {{-- <option value="" disabled selected>Choisissez la région</option> --}}
                            {{-- <option value="24651">Dakar</option> --}}

                            @foreach ($regions as $region)
                                <option value="{{$region->id}}"  >{{$region->region}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default dept" id="dept-pluvio" name="departement">
                            {{-- <option value="" disabled selected>Choisissez le département</option> --}}

                        </select>
                        {{-- <label class="active" for="users-list-status">Pluvio</label> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default commune" id="commune-pluvio" name="commune">
                            {{-- <option value="" disabled selected>Choisissez la Commune</option> --}}
                            {{-- <option value="24651"  >Dakar</option> --}}
                        </select>
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default localite" id="localite" name="localite">
                            {{-- <option value="" disabled selected>Choisissez la localité</option> --}}
                            {{-- <option value="24651"  >Dakar</option> --}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default" id="reseau-pluvio" name="reseau">
                            {{-- <option value="" disabled selected>Choisissez le réseau</option> --}}
                            {{-- <option value="5"  >AJAC</option> --}}

                            @foreach ($reseaux as $reseau)
                                <option value="{{$reseau->id_groupement}}"  >{{$reseau->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default" id="gerant-profil" name="gerant">
                            <option value="" disabled selected></option>
                            @foreach ($gerants as $gerant)
                                <option value="{{$gerant->id_profil}}"  >{{$gerant->nom.' '.$gerant->prenom}}</option>
                            @endforeach
                        </select>
                        {{-- <label class="active" for="users-list-role">Etat</label> --}}

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="latitude" type="number" class="validate latitude"
                        name="latitude">
                    <label class="active" for="latitude">Latitude</label>
                </div>
                <div class="input-field col s6">
                    <input id="longitude" type="number" class="validate longitude"
                        name="longitude">
                    <label class="active" for="longitude">Longitude</label>
                </div>
            </div>
            <div class="row">
                <a id="btn-pluvio-update" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
    </div>
</div>
