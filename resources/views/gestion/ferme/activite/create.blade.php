
<div id="create-activite" class="modal" >
    <form method="POST" id="formAddactivite" action="#">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title"> Nouvelle Activité</h4>
                    </div>
                    <div class="users-list-table">
                    <div class="card-body">                    
                        <div class="row">
                            {{-- <input id="id_entite" name="id_entite" value="{{ $_SESSION['ferme']}}" hidden> --}}
                            <div class="input-field col s12">
                                <div class="input-field col s6">
                                    <input id="activite" type="text" class="activites" name="activite" >                
                                    <label class="active" for="activite">Nom</label>
                                  </div>
                            </div>
                           
                        </div>
                    
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="row load" id=""></div>
                                {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <a id="formAddActiviteBtn" href="javascript:void(0)" class="btn indigo">
                                        Créer</a>
                                        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
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
<script src="{{ asset('assets/js/providers/ferme_activite.js')}}"></script>
{{-- <script src="{{ asset('assets/js/crud/gestion/edit.js')}}"></script> --}}
@endsection

