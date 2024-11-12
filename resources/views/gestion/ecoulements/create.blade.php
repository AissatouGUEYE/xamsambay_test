@extends('layouts.master')
@section('page-title')
    Distribution d'Intrants
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">{{__("Accueil")}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('ecoulements.index') }}">{{__("Distributions")}}</a>
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
                        <form id="form_ecoulement_create" method="POST" action="{{ route('ecoulements.store') }}">
                            @csrf
                            <div class="row mt-3">
                                {{-- Expression de Besoin Correspondant--}}
                                <div class="input-field col s12 m6">
                                    <select id="ebesoin" name="ebesoin"
                                            type="text"
                                            class="validate" required>
                                        <option value="">{{__("Choisissez l'Expression de besoin")}}</option>
                                        @foreach($ebList as $ebItem)
                                            <option value="{{$ebItem->id}}">{{$ebItem->qte}} {{$ebItem->unite}}
                                                de {{$ebItem->produit}} ({{$ebItem->type_eb}})
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="ebesoin">{{__("Expression de Besoin")}}</label>
                                </div>
                                {{-- Distribution Correspondant--}}
                                <div class="input-field col s12 m6">
                                    <select id="reception" name="reception"
                                            type="text"
                                            class="validate" required>
                                        <option value="">{{__("Choisissez la reception correspondante")}}</option>
                                        @foreach($receptions as $item)
                                            <option value="{{$item->id}}">{{$item->qte_livree}} {{$item->unite_op}}
                                                de {{$item->type_intrant_dist}} {{$item->produit_dist}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="reception">{{__("Reception Intrant")}}</label>
                                </div>
                            </div>
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
                                <input type="text" name="groupement" id="groupement" value="{{$_SESSION['groupement']}}"
                                       hidden>
                                {{-- Producteurs: Select Search Lister l'ensemble des producteurs de L'op--}}
                                <div class="input-field col s12">
                                    <input placeholder="{{__("Producteur")}}" id="producteur_list" name="producteur"
                                           class="validate" required list="producteur">
                                    <datalist id="producteur">
                                        <option value="">{{__("Choisissez le Producteur")}}</option>
                                        @foreach($producteurs as $producteur)
                                            <option
                                                value="id: {{$producteur->id}} / Telephone: {{$producteur->telephone}} / Prenom: {{$producteur->prenom}}/ Nom: {{$producteur->nom}}"> {{$producteur->prenom}} {{$producteur->nom}}
                                                - {{$producteur->telephone}}</option>
                                        @endforeach
                                    </datalist>
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
                                <a id="submitEcoulement" type="submit"
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
            $("#submitEcoulement").attr("disabled", false);
            let root = $('meta[name="url"]').attr("content");
            let role = $('meta[name="role"]').attr("content");
            let grp = $('#groupement').val();
            let urlGrp = root + "/groupements/membres/" + grp;

            $("#submitEcoulement").click((e) => {
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
                        $("#form_ecoulement_create").submit();
                        $("#submitEcoulement").attr("disabled", true);
                    } else {
                    }
                });
            });
        });
    </script>
@endsection

