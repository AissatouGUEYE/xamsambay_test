@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('main_content')
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ url('/dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/distributions') }}">Distributions</a>
    </li>

    <li class="breadcrumb-item active" style="color:#ffe900">Validation Reception Intrants
    </li>
@endsection
<div class="row">
    <form id="formModDistribution" action="{{ url('/distributions/update') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Validation Reception Intrants</h4>
                    </div>
                    @isset($distribution)
                        <div class="card-body">
                            <div class="formmessage ">Success/Error Message Goes Here</div>
                            <div class="row">
                                <input id="id" name="id" value="{{ $distribution->id }}" hidden>

                                <div class="input-field col s6">
                                    <input readonly id="produit" type="text" class="validate" name="produit"
                                        value="{{ $distribution->nom_produit }}">
                                    <label class="active" for="produit">Produit</label>
                                </div>
                                <div class="input-field col s6">
                                    <input readonly id="type_intrant" type="text" class="validate" name="type_intrant"
                                        value="{{ $distribution->type_intrant }}">
                                    <label class="active" for="type_intrant">Type intrant</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input readonly id="qte_notifiee" type="text" class="validate" name="qte_notifiee"
                                        value="{{ $distribution->qte_notifiee }} {{ $distribution->unite }}">
                                    <label class="active" for="qte_notifiee">Quantite notifiee</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="qte_placee" type="text" class="validate" name="qte_placee"
                                        value="{{ $distribution->qte_placee }} ">
                                    <label class="active" for="qte_placee">Quantite Recue</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input readonly id="date_livraison" type="text" class="validate"
                                        name="date_livraison" value="{{ $distribution->date_livraison }}">
                                    <label class="active" for="date_livraison">Date Livraison</label>
                                </div>

                                <div class="input-field col s6">
                                    <input id="date_reception" type="date" class="validate" name="date_reception"
                                        value="{{ $distribution->date_reception }}">
                                    <label class="active" for="date_reception">Date Reception</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="file-field input-field col s6">
                                    <div class="btn">
                                        <span>Justificatif</span>
                                        <input type="file" name="fichier" accept=".pdf, .doc, .docx,.odt">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="fichier" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block"
                                            src="{{ asset('assets/images/loader/loader-02.svg') }}" alt=""></div>
                                    <div class="col s12 display-flex justify-content-end mt-1">
                                        <button type="" id="formModDistributionBtn" class="btn indigo">
                                            Enregistrer</button>
                                        <a href="{{ url('/distributions') }}">
                                            <button type="button" class="ml-1 btn btn-light">Annuler</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>

            </div>
        </div>
    </form>
</div>
@endsection

@section('other-js-script')
<script src="{{ asset('assets\js\crud\gestion\utilisateurs\update.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#annuler").click(function() {
            parent.history.back();
            return false;
        });
    });
</script>
@endsection
