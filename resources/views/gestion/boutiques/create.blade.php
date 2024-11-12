<div class="modal" id="creer_boutique">
    <form method="POST" id="formAddShop" action="/shop/create" enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouvelle boutique</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s6">
                                    <label class="active" for="activite">Nom de la boutique</label>
                                    <input type="text" name="name_boutique" required>
                                </div>
                                <div class="input-field col s6">
                                    <label class="active" for="activite">Description</label>
                                    <input type="text" name="desc_boutique" required>
                                </div>
                            </div>
                            
                            {{-- <div class="row" style="margin-top: 50px"></div> --}}
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
                                <div class="col s6 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Logo</span>
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
                                    <div class="row load" id=""></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <a id="createBoutBtn" href="javascript:void(0)" class="btn indigo">
                                            Enregistrer</a>
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
    <!-- START RIGHT SIDEBAR NAV -->


    <!-- BEGIN: Footer-->



    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->


    {{-- <script src="{{asset('assets\js\crud\gestion\utilisateurs\edit.js')}}"></script> --}}

    {{-- <script src="{{ asset('assets\js\providers\location.js') }}"></script> --}}
    <script src="{{asset('assets\js\providers\panier.js')}}"></script>
    {{-- <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets\js\providers\produits.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets\js\crud\gestion\ferme\production\create.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets\js\crud\gestion\ferme\create.js') }}"></script> --}}

    <!-- END PAGE LEVEL JS-->
@endsection
