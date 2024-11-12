<div class="modal" id="create-cc">
    <div class="formmessage">Success/Error Message Goes Here</div>

    <form method="post" id="formAddCc" action="{{ url('/entite/cc/store') }}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouvelle CC</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="input-field col s4">
                                <input id="nom" type="text" name="nom">
                                <label class="active" for="nom">Nom Commission</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="description" type="text" name="description">
                                <label class="active" for="description">Description Commission</label>
                            </div>
                            <div class="input-field col s4">
                                <select class="select2 browser-default" id="pays" name="pays">
                                    <option value="" disabled selected>Pays</option>
                                </select>
                                <label class="active" for="pays">Pays</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="select2 browser-default region" id="region" name="region">
                                    <option value="" disabled selected>--Région--</option>
                                </select>
                                <label class="active" for="region">Région</label>
                            </div>
                            <div class="input-field col s6">
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
                        <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block"
                                src="{{ asset('assets/images/loader/loader-02.svg') }}" alt=""></div>
                        <div class="modal-footer">
                            <button type="submit" id="submit" name="submit"
                                style="color: white; background-color:#a2673b" class="btn">
                                Enregistrer
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
