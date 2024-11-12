<div class="users-list-table">
    <div class="card">
        <div class="card-header">
            <h5 class="pt-2 ml-3">Alertes Information climatique</h5>
        </div>
        <div class="card-content">
            <div id="image-card" class="section">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col m6"><a href="#test3" class="active">Alerte SMS</a></li>
                            <li class="tab col m6"><a class="" href="#test4">Alerte VOICE</a></li>
                        </ul>
                    </div>
                    <div id="test3" class="col s12">
                        <form id="form-campagne-update" method="POST" action="{{ route('alertes.sms.submit') }}">
                            @csrf
                            <div class="row mt-3">
                                <div class="col s12">
                                    <div class="input-field">
                                        <select class="browser-default region" id="campagne" name="campagne">
                                            <option value="" disabled selected>Choisissez du Canal de diffusion *
                                            </option>
                                            <option value="reseau">Reseaux</option>
                                            {{-- <option value="campagne">Campagnes</option> --}}
                                            <option value="diffusion">liste diffusion</option>
                                            <option value="upload">Charger un fichier</option>
                                        </select>
                                        <label class="active" for="users-list-status">Canal de diffusion</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 choixCampagne">
                                <div class="col s12">
                                    <div class="input-field">
                                        <select class="browser-default region" id="campagnetype" name="campagnetype">
                                            {{-- <option value="" disabled selected>Choisissez la campagne de diffusion
                                                *
                                            </option> --}}
                                        </select>
                                        <label class="active" for="users-list-status">Campagne</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row insertFile">
                                <div class="col s12 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Fichier</span>
                                            <input type="file" name="glist">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="glist_name" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6">
                                    <a href=" {{ asset('assets/modelsListe/model_diffusion.xlsx') }}"
                                        class=" waves-effect waves-green btn-flat mt-4"><span>Télécharger le
                                            modéle</span><i class="material-icons">file_download</i></a>

                                    {{-- <a id="new-gerant-list"
                                        class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a> --}}
                                </div>

                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <textarea rows="4" id="textarea1" name="message" class="materialize-textarea" maxlength="160"></textarea>
                                        <label for="textarea1">Message de diffusion</label>
                                    </div>
                                    <input type="text" name="id_entite" id="id_entite"
                                        value="{{ $_SESSION['id_entite'] }}" hidden>
                                    @isset($message)
                                        <input type="text" name="texto" id="texto" value="{{ $message }}"
                                            hidden>
                                    @endisset
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit"
                                    class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="test4" class="col s12">
                        <form id="form-campagne-updat" method="POST" action="#">
                            @csrf
                            <div class="row">
                                <div class="col s12">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Fichier audio(MP3)</span>
                                            <input type="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a id="swalert"
                                    class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
