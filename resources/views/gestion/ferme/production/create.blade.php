<div class="modal" id="create-produit">
    <form method="POST" id="formAddprod" action="#"  enctype="multipart/form-data" >
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Ajout produit</h4>
                    </div>
                    <div class="users-list-table">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class=" browser-default" id="activite" name="activite">
                                        <option value="" disabled selected>--Type d'activité--</option>
                                    </select>
                                    <label class="active" for="activite">Type d'activité</label>
                                </div>

                                <div class="input-field col s6">
                                    <input id="produit" type="text" class="produit" name="produit">
                                    <label class="active" for="produit">Produit</label>
                                </div>


                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="description" type="text" class="description" name="description">
                                    <label class="active" for="description">Description</label>
                                </div>
                                <div class="col s6">
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
                                    <div class="row" id="load"></div>
                                    {{-- <button id="formAddUserbtn" type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Enregistrer</button> --}}
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <a id="formAddProdBtn" href="javascript:void(0)" class="btn indigo">
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



    {{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}
    <script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script>
    <script src="{{ asset('assets\js\providers\produits.js') }}"></script>



    <!-- END PAGE LEVEL JS-->
@endsection
