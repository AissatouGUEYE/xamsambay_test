@extends('layouts.master')
@section('page-title')
    Distribution d'Intrants
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">{{__("Accueil")}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('distributions.index') }}">{{__("Distributions")}}</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#" style="color:#ffe900">{{__("Nouvelle Distribution")}}</a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                {{--  Formulaire de Creation --}}
                <div class="row">
                    <div class="col s12">
                        <form id="form_distribution_create" method="POST" action="{{ route('distributions.store') }}"
                            {{--  enctype="multipart/form-data"--}}
                        >
                            @csrf
                            <div class="row mt-3">
                                {{-- Point de Chute--}}
                                <div class="input-field col s12 m6">
                                    <select id="ccession" name="ccession"
                                            type="text"
                                            class="validate" required>
                                        <option value="">{{__("Choisissez le point de Chute")}}</option>
                                        @foreach($cc as $ccItem)
                                            <option value="{{$ccItem->id}}">{{$ccItem->nom_entite}}</option>
                                        @endforeach
                                    </select>
                                    {{--       Il se peut que cela soit une selection de liste    --}}
                                    <label for="ccession">{{__("Point de Chute")}}</label>
                                </div>
                                {{-- Type d'Intrant--}}
                                <div class="input-field col s12 m6">
                                    <select id="type_intrant" name="type_intrant"
                                            type="text"
                                            class="validate" required>
                                        <option value="">{{__("Choisissez le type Intrant")}}</option>
                                        @foreach($intrants as $intrant)
                                            <option value="{{$intrant->id}}">{{$intrant->type_intrant}}</option>
                                        @endforeach
                                    </select>
                                    {{--       Il se peut que cela soit une selection de liste    --}}
                                    <label for="type_intrant">{{__("Type Intrant")}}</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                {{-- Nom Produit--}}
                                <div class="input-field col s12 m6">
                                    {{--       Il se peut que cela soit une selection de liste    --}}
                                    <select id="produit" name="produit" type="text"
                                            class="validate" required>
                                        <option value="-1" selected disabled>{{__("Choisissez le produit")}}</option>
                                        @foreach($produits as $produit)
                                            <option value="{{$produit->id}}">{{$produit->produit}}</option>
                                        @endforeach
                                    </select>
                                    <label for="produit">{{__("Nom Produit")}}</label>
                                </div>
                                {{-- Variete Produit--}}
                                <div class="col s12 m6">

                                    <div class="input-field" id="variete">
                                        <select name="variete" id="varieteProduitSelect" class="browser-default"
                                                required>
                                        </select>
                                        <label for="varieteProduitSelect">{{__("Variete Produit")}}</label>
                                    </div>
                                </div>

                            </div>
                            {{--  --}}
                            <div class="row mt-3">
                                {{--      Quantite declaree     --}}
                                <div class="input-field col s12 m6">
                                    <input placeholder="{{__("Quantité")}}" id="quantite" name="quantite" type="text"
                                           class="validate" required>
                                    <label for="quantite">{{__("Quantité")}}</label>
                                </div>
                                {{--      Unite        --}}
                                <div class="input-field col s12 m6">
                                    <select id="unite" name="unite" type="text"
                                            class="validate" required>
                                        <option value="">{{__("Choisissez l'unité")}}</option>
                                        @foreach($unites as $unite)
                                            <option value="{{$unite->id}}">{{$unite->unite}}</option>
                                        @endforeach
                                    </select>
                                    <label for="unite">{{__('Unité')}}</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                {{--      Date declaree     --}}
                                <div class="input-field col s12 m6">
                                    <input placeholder="{{__("Date de Livraison")}}" id="date" name="date_livraison"
                                           type="text" class="datepicker" required>
                                    <label for="date">{{__("Date de Livraison")}}</label>
                                </div>
                                {{--      --        --}}
                                <div class="input-field col s12 m6">
                                </div>
                            </div>
                            {{-- Submit Button --}}
                            <div class="row">
                                <a id="submitDistribution" type="submit"
                                   class="waves-effect waves-light green darken-1 s2 m6 l3 btn right mr-3">{{__("Enregistrer")}}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('other-js-script')
    <script>
        $(document).ready(function () {
            $("#submitDistribution").attr("disabled", false);
            let root = $('meta[name="url"]').attr("content");
            let role = $('meta[name="role"]').attr("content");
            $("#variete").hide();
            $("#produit").change(() => {
                $("#varieteProduitSelect").empty();
                let idProduit = $("#produit").val();
                // alert(idProduit);
                if (idProduit != "-1") {
                    urlList = root + "/variete/produit/" + idProduit;

                    $.ajax({
                        url: urlList,
                        method: "GET",
                        headers: {
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        dataType: "JSON",
                        success: (res) => {
                            // console.log(res)
                            let selectContent = "";
                            let selectOpt = "";
                            if (res.length >= 1) {
                                console.log(res);
                                $("#varieteProduitSelect").empty();
                                for (let index = 0; index < res.length; index++) {
                                    let opt =
                                        '<option value ="' +
                                        res[index].id +
                                        '" >' +
                                        res[index].variete +
                                        "</option>";
                                    selectOpt += opt;
                                }
                                selectContent =
                                    '<option value="-1" disabled selected> Choisisssez la variete </option>' +
                                    selectOpt;
                                // console.log(selectContent);

                                $("#varieteProduitSelect").append(selectContent);
                                $("#variete").show();
                            } else {
                                $("#varieteProduitSelect").empty();
                                messageProd =
                                    " <option value='-1' selected disabled>Pas de variete lie au produit</option>";
                                $("#varieteProduitSelect").append(messageProd);
                                $("#variete").show();
                            }
                        }
                    });
                }
            });
            $("#submitDistribution").click((e) => {
                e.preventDefault();
                swal({
                    title: "Creation",
                    text: "Etes vous sur de vouloir creer cette distribution?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        delete: "Oui",
                        cancel: "Annuler",
                    },
                }).then(function (willDelete) {
                    if (willDelete) {
                        $("#form_distribution_create").submit();
                        $("#submitDistribution").attr("disabled", true);
                    } else {
                    }
                });
            });
        });
    </script>
@endsection

