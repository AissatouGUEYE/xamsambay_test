<div id="create-liste-ferme" class="modal">
    <form method="POST" id="formAddfermeList" action="{{route('ferme.create.list')}}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title"> Nouvelle liste Ferme Agricole</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="col s12 m6 l10">
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
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l12">
                                    <a href=" {{ asset('assets/modelsListe/model_ferme.xlsx') }}"
                                        class=" waves-effect waves-green btn-flat"><span>Télécharger le modéle</span><i
                                            class="material-icons">file_download</i></a>
                                    
                                </div>
                            </div>

                            <div class="row">

                                <div class="input-field col s12">
                                    <div class="row" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <a id="formAddFermeListBtn" href="javascript:void(0)" class="btn indigo">
                                            Créer</a>
                                        <a href="#!"
                                            class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>


