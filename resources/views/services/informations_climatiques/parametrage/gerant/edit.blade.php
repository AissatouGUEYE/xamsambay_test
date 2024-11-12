


        {{-- {{print_r($res)}} --}}
        <div id="modal-edit-gerant" class="modal">
            <div class="modal-content">
                <h4 class="card-title">Modification du réseau</h4>
                <div class="divider mt-2"></div>
                <form id="form-gerant-update" method="POST" action="#">
                    @csrf
                    {{-- {{dd($users->object()[0])}} --}}

                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <select class="browser-default" id="profil-gerant" name="user">
                                    {{-- <option value="" disabled selected>Choisissez l'utilisateur</option> --}}

                                    {{-- <option value="30">user 1</option> --}}

                                    @foreach ($users as $user)
                                        <option value="{{$user->id_profil }}" >{{$user->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <select class="browser-default" id="gerant-reseau" name="reseau">
                                    {{-- <option value="" disabled >Choisissez le réseau</option> --}}
                                    {{-- <option value="5"  >AJAC</option> --}}

                                    @foreach ($reseaux as $reseau)
                                        <option value="{{$reseau->id_groupement}}"  >{{$reseau->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                {{-- {{print_r($regions)}} --}}
                                <select class="select region" id="region" name="date">
                                    {{-- <option value="" disabled selected>Choisissez la région</option> --}}
                                    {{-- <option value="24651"  >Dakar</option> --}}

                                    @foreach ($regions as $region)
                                        <option value="{{$region->id}}"  >{{$region->region}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <select class="browser-default dept" id="dept" name="departement">
                                    <option value="" disabled selected>Choisissez la département</option>

                                </select>
                                {{-- <label class="active" for="users-list-status">Pluvio</label> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <select class="browser-default commune" id="commune" name="commune">
                                    <option value="" disabled selected>Choisissez la Commune</option>
                                    {{-- <option value="24651"  >Dakar</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <select class="browser-default localite" id="localite" name="localite">
                                    <option value="" disabled selected>Choisissez la Commune</option>
                                    {{-- <option value="24651"  >Dakar</option> --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a id="btn-gerant-update" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
            </div>
        </div>
