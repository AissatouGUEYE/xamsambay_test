<div id="create-tache" class="modal">
    <form method="POST" id="#" action="/ferme/tache/create" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title"> Nouvelle Tache</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="input-field col s6">
                                        <input id="nom" type="text" class="nom" name="nom">
                                        <label class="active" for="tache">Nom</label>
                                    </div>
                                    <div class="input-field col s6">
                                        {{-- @php
                                            dd($users);
                                        @endphp --}}
                                        <select class=" browser-default" name="assigne" id="assigne">
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id_profil }}">
                                                    {{ $item->prenom }} {{ $item->nom }}

                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="active" for="tache">Assignée À</label>
                                    </div>
                                </div>
                                <div class="input-field col s12">
                                    <div class="input-field col s6">
                                        <input id="description" type="text" class="description" name="description">
                                        <label class="active" for="description">Description</label>
                                    </div>
                                    <div class="col s6">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Fichier</span>
                                                <input type="file" name="fichier" accept=".pdf, .doc, .docx">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path" name="fichier" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="input-field col s12">
                                    <div class="input-field col s4">
                                        <input type="date" name="date_debut" id="">
                                        <label class="active" for="date_debut">Date debut</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input type="date" name="date_fin" id="">
                                        <label class="active" for="date_fin">Date Fin</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input type="date" name="fin_prev" id="">
                                        <label class="active" for="fin_prev">Fin Previsionnelle</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="input-field col s12">
                                    <div class="row load" id="load"></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        {{-- <button type="submit">envoyer</button> --}}
                                        <a id="formAddTacheBtn" href="javascript:void(0)" class="btn indigo">
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
    {{-- <script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/js/crud/gestion/edit.js')}}"></script> --}}
@endsection
