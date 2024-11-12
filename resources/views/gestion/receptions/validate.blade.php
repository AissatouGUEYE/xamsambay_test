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
        <a href="#" style="color:#ffe900">{{__("Validation Reception")}}</a>
    </li>
@endsection
@section("main_content")
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    Infos Reception
                </div>
                <div class="row">
                    <div class="col s12 m4">
                        Commission:
                        {{$reception->commission_nom_entite}}
                    </div>

                    <div class="col s12 m4">
                        Type Intrant: {{$reception->type_intrant_dist}}
                        <br>
                        Produit : {{$reception->produit_dist}}
                    </div>
                    <div class="col s12 m4">
                        Quantite Estimatif exprime:
                        {{$reception->qte_desiree}} {{$reception->unite_cc}}
                        Quantite Delivree par la Commission:
                        {{$reception->qte_reçue}} {{$reception->unite_cc}}
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                {{--  Formulaire de Creation --}}
                <div class="row">
                    <div class="col s12">
                        <form id="form_validation_create" method="POST"
                              action="{{ route('receptions.storeValidation') }}" enctype="multipart/form-data">
                            {{--   id CC a prendre directement sur le Controller dans les sessions--}}
                            @csrf
                            <div class="row mt-3">
                                <input type="text" name="idReception" id="" value="{{$reception->id}}" hidden>
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
                                <div class="file-field input-field col s12 m6">
                                    <div class="btn">
                                        <span>{{__("Justificatif")}}</span>
                                        <input type="file" name="fichier" accept=".pdf, .doc, .docx,.odt,.png">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path" name="fichier" type="text">
                                    </div>
                                </div>
                            </div>
                            {{-- Submit Button --}}
                            <div class="row">
                                <a id="submitValidation" type="submit"
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
            $("#submitValidation").attr("disabled", false);
            let root = $('meta[name="url"]').attr("content");
            let role = $('meta[name="role"]').attr("content");
            $("#submitValidation").click((e) => {
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
                        $("#form_validation_create").submit();
                        $("#submitValidation").attr("disabled", true);
                    } else {
                    }
                });
            });
        });
    </script>
@endsection

