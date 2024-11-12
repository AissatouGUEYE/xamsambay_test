@extends('layouts.master')
@section('page-title')
    {{__("Accuse Reception d'Intrants")}}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">{{ __('Accueil') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{--        <a href="locale/en">English</a>/--}}
        {{--        <a href="locale/fr">French</a>/--}}
        <a href="{{route("receptions.index")}}">{{__("Reception Intrants")}}</a>
    </li>
    <li class="breadcrumb-item active">
        {{--        <a href="locale/en">English</a>/--}}
        {{--        <a href="locale/fr">French</a>/--}}
        <a href="#" style="color:#ffe900">{{__("Nouvelle Reception")}}</a>
    </li>
@endsection
@section("main_content")
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                {{--  Formulaire de Creation --}}
                <div class="row">
                    <div class="col s12">
                        <form id="form_receptions_create" method="POST" action="{{ route('receptions.store') }}">
                            {{--   id CC a prendre directement sur le Controller dans les sessions--}}
                            @csrf
                            <div class="row mt-3">
                                {{-- Distribution Validee--}}
                                <div class="input-field col s12 m6">
                                    <select id="distribution" name="distribution"
                                            type="text"
                                            class="validate" required>
                                        <option value="-1" selected
                                                disabled>{{__("Choisissez la distribution")}}</option>
                                        @foreach($distributions as $item)
                                            <option value="{{$item->id}}">{{$item->qte_placee}} {{$item->unite}}
                                                de {{$item->nom_produit}}
                                            </option>
                                        @endforeach

                                    </select>
                                    <label for="distribution">{{__("Distribution")}}</label>
                                </div>
                                {{-- Expression de Besoin Correspondant--}}
                                <div class="input-field col s12 m6">
                                    <select id="ebesoin" name="ebesoin"
                                            type="text"
                                            class="validate" required>
                                        <option value="-1" selected>{{__("Choisissez l'Expression de besoin")}}</option>
                                        @foreach($ebesoin as $ebItem)
                                            <option
                                                value="{{$ebItem->id}}/{{$ebItem->qte}}">{{$ebItem->qte}} {{$ebItem->unite}}
                                                de {{$ebItem->produit}} ({{$ebItem->type_eb}})
                                            </option>
                                        @endforeach

                                    </select>
                                    <label for="ebesoin">{{__("Expression de Besoin")}}</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                {{--        Option de choix entre groupement ou Prod          --}}
                                {{--    lister l'ensemble des President OP / rattaches a la commune du CC
                                              et l'ensemble des Producteurs Individueles--}}
                                <div class="input-field col s12">
                                    <select id="recepteur" name="recepteur"
                                            type="text"
                                            class="validate" required>
                                        <option value="-1" selected
                                                disabled>{{__("Choisissez le Recepteur")}}</option>
                                        @foreach($recepteurs as $item)
                                            <option
                                                value="{{$item->id_profil}}/{{$item->id_groupement}}">{{$item->prenom}} {{$item->nom}}
                                                ({{$item->nom_entite}})
                                            </option>
                                        @endforeach
                                    </select>

                                    <label for="recepteur">{{__("Recepteur")}}</label>
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
                                <a id="submitReception" type="submit"
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
            $("#submitReception").attr("disabled", false);
            let root = $('meta[name="url"]').attr("content");
            let role = $('meta[name="role"]').attr("content");
            $("#submitReception").click((e) => {
                e.preventDefault();
                swal({
                    title: "Creation",
                    text: "Etes vous sur de vouloir valide la reception?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        delete: "Oui",
                        cancel: "Annuler",
                    },
                }).then(function (willDelete) {
                    if (willDelete) {
                        $("#form_receptions_create").submit();
                        $("#submitReception").attr("disabled", true);
                    } else {
                    }
                });
            });
        });
    </script>
@endsection

