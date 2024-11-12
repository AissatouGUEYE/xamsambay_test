<div id="create-demande" class="modal">
    <form method="POST" id="formAddDemande"  action="{{ route('ferme.administration.create') }}">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title"> Nouvelle Demande</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                {{-- <input id="id_entite" name="id_entite" value="{{ $_SESSION['ferme']}}" hidden> --}}
                                <div class="input-field col s6">
                                    <select class="select2 browser-default type" id="type_demande" name="type">
                                        <option value="" disabled selected>--Type demande--</option>
                                    </select>
                                    <label class="active" for="activite">Type</label>
                                </div>


                                <div class="input-field col s6">
                                    <input id="activite" type="text" class="motif" name="motif">
                                    <label class="active" for="activite">Motif</label>
                                </div>


                            </div>
                            <div class="input-field col s12">
                                <div class="input-field col s6">
                                    <input type="date" name="date_debut" id="">
                                    <label class="active" for="date_debut">Date debut</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="date" name="date_fin" id="">
                                    <label class="active" for="date_fin">Date Fin</label>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col s12 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Fichier</span>
                                            <input type="file" name="fichier">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" name="fichier" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="input-field col s12">
                                    <div class="row load" id="load"></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <a id="formAddDemandeBtn" href="javascript:void(0)" class="btn indigo">
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

@section('other-js-script')
    <script src="{{ asset('assets/js/providers/ferme_activite.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/crud/gestion/edit.js')}}"></script> --}}
@endsection
