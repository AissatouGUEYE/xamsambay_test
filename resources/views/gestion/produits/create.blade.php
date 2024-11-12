<div class="modal" id="creer_produit">
    <form method="POST" id="formAddProdByadmin" action="/produit/create"  enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Nouveau Produit</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s6">
                                    <label class="active" for="activite">Nom du produit</label>
                                    <input type="text" name="name_produit">
                                </div>
                                <div class="input-field col s6">
                                    <select class=" browser-default" id="cat_produit" name="cat_produit">
                                        <option value="" disabled selected>--Categorie--</option>
                                    </select>
                                    <label class="active" for="">Categorie</label>
                                </div>
                               
                            </div>
                            <div id="row">
                                <div class="col s6 m6 l6">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Image</span>
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
                                        {{-- <button type="submit">save</button> --}}
                                        <a id="createProdByadminBtn" href="javascript:void(0)" class="btn indigo">
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
