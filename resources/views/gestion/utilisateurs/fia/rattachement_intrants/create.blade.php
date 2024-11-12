@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
@endsection
@section('page-title')
    {{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item">

        <a href="{{ url('/entite/fia') }}">FIA</a>

    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Nouveau Intrant</li>
@endsection
@section('main_content')
    <div class="row">

        <form method="post" id="formAddRattachementIntrant" action="{{ url('/entite/fia/rattachement_intrants/store') }}">
            @csrf
            <div class="col s12 ">
                <div class="card">
                    <div class="card-content pb-0">
                        <div class="card-header mb-2">
                            <h4 class="card-title">Nouveau Rattachement Intrant</h4>
                        </div>
                        <div class="card-body">
                            {{-- <div class="formmessage">Success/Error Message Goes Here</div> --}}

                            <div class="row">
                                <div class="input-field">
                                    <input type="text" name="id" value="{{ $id }}" hidden>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select class="select" id="type_intrant" name="type_intrant">
                                                <option value="" disabled selected>Choisissez le type d'intrant
                                                </option>
                                                @foreach ($intrants as $item)
                                                    <option value="{{ $item->id }}">{{ $item->type_intrant }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="intrants">Intrants</label>

                                        </div>
                                        <div class="input-field col s6 " id="prod_div">
                                            <select id="large-select-multi"
                                                class="select2-size-lg browser-default produit_choice " multiple="multiple"
                                                name="produits[]">
                                                <option value="" disabled selected>-- Choisir Produit--</option>
                                            </select>
                                            <label class="active" for="produit">Produit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block"
                                        src="{{ asset('assets/images/loader/loader-02.svg') }}" alt="">
                                </div>
                            </div>

                            <div class="row ">
                                <div class="input-field col s12">
                                    <div class="row">
                                        <a id="submitCreation" type="submit"
                                           class="waves-effect waves-light green darken-1 s2 m6 l3 btn right mr-3">{{__("Enregistrer")}}
                                        </a>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection


@section('other-js-script')
    <!-- END PAGE VENDOR JS-->
    <script>
        $(".max-length1").select2({
            dropdownAutoWidth: true,
            width: '100%',
            maximumSelectionLength: 8,
            placeholder: "Select maximum 8 items"
        });

        // Large
        $('.select2-size-lg').select2({
            dropdownAutoWidth: true,
            width: '100%',
            containerCssClass: 'select-lg'
        });

        // Small
        $('.select2-size-sm').select2({
            dropdownAutoWidth: true,
            width: '100%',
            containerCssClass: 'select-sm'
        });

        $("#submitCreation").click((e) => {
            e.preventDefault();
            swal({
                title: "Creation",
                text: "Etes vous sur de vouloir creer ce rattachement?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    delete: "Oui",
                    cancel: "Annuler",
                },
            }).then(function(willDelete) {
                if (willDelete) {
                    $("#formAddRattachementIntrant").submit();
                    $("#ajaxloader").show();

                    $("#submitCreation").attr("disabled", true);
                } else {}
            });
        });
    </script>
    <script src="{{ asset('assets\js\crud\gestion\utilisateurs\create.js') }}"></script>

    <!-- BEGIN THEME  JS-->
@endsection
