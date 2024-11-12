


        {{-- {{print_r($res)}} --}}
        <div id="mod" class="modal">
            <div class="modal-content">
                <h4 class="card-title">Modification du réseau</h4>
                <div class="divider mt-2"></div>
                <form id="form-reseau-update" method="POST" action="#">
                    @csrf
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <input id="code" class="" name="code" type="text">
                                <label class="active" for="users-list-verified">Code</label>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <input id="intitule" class="" name="intitule" type="text" required>
                                <label class="active" for="users-list-verified">Intitulé</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <a id="btn-update-reseau" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
            </div>
        </div>
