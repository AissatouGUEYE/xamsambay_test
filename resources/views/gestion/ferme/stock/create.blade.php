

<div class="modal" id="create-stock">
    <form method="POST" id="formAddStock" action="#">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Ajout stock</h4>
                    </div>
                    <div class="users-list-table">
                    <div class="card-body">                    
                        <div class="row">
                            <div class="input-field col s12">
                                <select class="produit browser-default" id="produit" name="produit">
                                    <option value="" disabled selected>--Produit--</option>
                                </select>
                                <label class="active" for="activite">Produit</label>
                            </div>
                           
                           
                        </div>
                        <div class="row">
                            
                                <div class="input-field col s6">
                                    <input id="quantite" type="text" class="quantite" name="quantite" >                
                                    <label class="active" for="quantite">Quantite</label>
                                  </div>
                            
                            <div class="input-field col s6">
                                <select class=" browser-default" id="unite" name="unite">
                                    <option value="" disabled selected>--Unite--</option>
                                </select>
                                <label class="active" for="activite">Unite</label>
                            </div>

                        </div>

                        <div class="row">
                            
                                <div class="input-field col s6">
                                    <input id="detail" type="text" class="detail" name="detail" >                
                                    <label class="active" for="detail">Prix detaillant</label>
                                  </div>
                            
                           
                                <div class="input-field col s6">
                                    <input id="gros" type="text" class="gros" name="gros" >                
                                    <label class="active" for="gros">Prix en gros</label>
                                  </div>
                            
                        </div>
                    
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="row load" id=""></div>
                                <div class="col s12 display-flex justify-content-end mt-1">
                                    <a id="stockBtn" href="javascript:void(0)" class="btn indigo">
                                        Enregistrer</a>
                                    
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
<!-- START RIGHT SIDEBAR NAV -->


<!-- BEGIN: Footer-->



<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->

<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script>

<!-- END PAGE LEVEL JS-->
@endsection
