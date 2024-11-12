<div class="modal" id="create-membre">
    <div class="formmessage">Success/Error Message Goes Here</div>

    <form method="post" id="" action="{{url('/entite/cc/membre/store')}}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouveau Membre CC</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="input-field col s4">

                                <input id="prenom" type="text" name="prenom">
                                <label class="active" for="prenom">Prénom</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="nom" type="text" name="nom">
                                <label class="active" for="nom">Nom</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2 browser-default" id="roles" name="role" required>
                                    <option value="" disabled selected>--Profils--</option>
                                </select>
                                <label class="active" for="entite">Profil</label>

                            </div>
                        </div>

                        <div class="row">

                            <div class="input-field col s6">
                                <input id="telephone" type="number" name="telephone">
                                <label class="active" for="telephone">Téléphone</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="email" type="email" name="email">
                                <label class="active" for="email">Email</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="login" type="text" name="login">
                                <label class="active" for="login">Login</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="password" type="password" name="password">
                                <label class="active" for="password">Mot de passe</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="cmdp" type="password" name="cmdp">
                                <label class="active" for="cmdp">Confirmation mot de passe</label>
                            </div>
                        </div>
                        <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block"
                                src="{{ asset('assets/images/loader/loader-02.svg') }}" alt=""></div>
                        <div class="modal-footer">
                            <button type="submit" id="submit" name="submit"z
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
