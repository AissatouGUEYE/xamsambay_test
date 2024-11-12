<div id="create-ferme" class="modal">
    <form method="POST" id="formAddferme" action="{{ route('ferme.create') }}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title"> Nouvelle Ferme Agricole</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">

                                <div class="input-field col s6">
                                    <input id="nomFerme" type="text" class="nomFerme" name="nomFerme">
                                    <label class="active" for="nomFerme">Nom</label>
                                </div>


                                <div class="input-field col s6">
                                    <input id="descriptionFerme" type="text" class="descriptionFerme"
                                        name="descriptionFerme">
                                    <label class="active" for="descriptionFerme">Description</label>
                                </div>



                            </div>
                            <div class="row">

                                <div class="input-field col s6">
                                    <input id="date_debut" type="text" class="date_debut" name="date_debut" required>
                                    <label class="active" for="date_debut">Debut contrat</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="duree" type="text" class="duree" name="duree" required>
                                    <label class="active" for="duree">Duree (mois)</label>
                                </div>
                            </div>
                            <div id="lieu">
                                <div class="row">
                                    <div class="input-field col s4">
                                        <select class="select2 browser-default" id="pays" name="pays">
                                            <option value="" disabled selected>Pays</option>
                                        </select>
                                        <label class="active" for="pays">Pays</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <select class="select2 browser-default region" id="region" name="region">
                                            <option value="" disabled selected>--Région--</option>
                                        </select>
                                        <label class="active" for="region">Région</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <select class="select2 browser-default dept" id="dept" name="dept">
                                            <option value="" disabled selected>--Département--</option>

                                        </select>
                                        <label class="active" for="dept">département</label>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="input-field col s6">
                                        <select class="select2 browser-default commune" id="commune" name="commune">
                                            <option value="" disabled selected>--Commune--</option>
                                        </select>
                                        <label class="active" for="commune">Commune</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select class="select2 browser-default localite" id="localite" name="localite"
                                            class="validate">
                                            <option value="" disabled>--Localité--</option>
                                        </select>
                                        <label class="active" for="localite">Localité</label>
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <a id="formAddFermeBtn" href="javascript:void(0)" class="btn indigo">
                                            Créer</a>
                                        <a href="#!"
                                            class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
                                        {{-- <button type="button" class="ml-1 btn btn-light">Annuler</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
