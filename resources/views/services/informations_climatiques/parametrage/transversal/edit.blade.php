<div id="modal-edit-transversal" class="modal">
    <div class="modal-content">
        <h4>Nouveau pluvio</h4>
        <div class="divider mt-2"></div>
        <form id="form-update-transversal" method="POST" action="#">
            @csrf
            <div class="row">
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default" id="transversal-profil" name="profil">
                            <option value="" disabled selected>Choisissez le producteur</option>
                            @foreach ($users as $user)
                                @if ($user->nom_typentite === "PRODUCTEUR" || $user->nom_typentite === "INDIVIDUEL")
                                    <option value="{{$user->id_profil}}"  >{{$user->nom.' '.$user->prenom}}</option>
                                @endif
                            @endforeach

                        </select>
                        <label class="active" for="users-list-status">Réseau</label>
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <select class="browser-default" id="transversal-pluvio" name="pluvio">
                            <option value="" disabled selected>Choisissez le pluvio</option>
                            @foreach ($pluvios as $pluvio)
                                <option value="{{$pluvio->id}}">{{$pluvio->localite}}</option>
                            @endforeach
                        </select>
                        <label class="active" for="users-list-status">Réseau</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <a id="btn-update-transversal" class="waves-effect waves-light green darken-1 s2 m6 l3 btn right">Enregistrer</a>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
    </div>
</div>
