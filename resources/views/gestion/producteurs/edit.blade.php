<div id="edit-campagne-modal" class="modal">
    <div class="modal-content">
        <h4>Mettre à jour Campagne</h4>
        <div class="divider mt-2"></div>
        <form id="campagne-update" method="POST" action="#">
            @csrf
            <div class="row">
                {{-- <div class="col s12 m6 l6">
                    <div class="input-field">
                        <input class="" type="text"  required>
                        <label class="active" for="users-list-verified">Intitulé</label>
                    </div>
                </div> --}}
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <input id="debut" class="datepicker" type="text" required name="debut">
                        <label class="active" for="users-list-role">Date de début</label>

                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <input id="fin" class="datepicker" type="text" required name="fin">
                        <label class="active" for="users-list-verified">Date de fin</label>
                    </div>
                </div>
            </div>
            <div class="row">

                {{-- <div class="col s12 m6 l6">
                    <div class="input-field">
                        <input type="text">
                        <label class="active" for="users-list-status">Description</label>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <a id="btn-update-campagne" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
    </div>
</div>
