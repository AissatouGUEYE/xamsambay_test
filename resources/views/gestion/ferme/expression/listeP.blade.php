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
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/ferme/eb">Expression des besoins</a>
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Liste
    </li>
@endsection

{{-- faire un controle suivant qu'on est president ou pas --}}

<section class="users-list-wrapper section">



    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                {{-- <th>Type activite</th> --}}
                                <th>Produit</th>
                                <th>Besoin</th>
                                <th>Justificatif</th>
                                <th>Date</th>
                                <th>Commentaire Manager</th>
                                <th>Commentaire President</th>
                                <th>Statut Manager</th>
                                <th>Statut President</th>
                                <th>Ajouter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @isset($eb)
                                @foreach ($eb as $entities)
                                    <tr>
                                        {{-- <td>{{ $eb->libelle_activite }} </td> --}}

                                        <td>{{ $entities->produit }}</td>
                                        <td>{{ $entities->description }}</td>
                                        <td class=" ">

                                            @if (strcmp($entities->justificatif, '') == 0)
                                                -
                                            @else
                                                <a href="{{ asset('storage/' . $entities->justificatif) }}" target="_blank">
                                                    <i class="material-icons green-text ">file_download</i>
                                                </a>
                                            @endif


                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($entities->created_at)) }}</td>

                                        <td>
                                            @if (strcmp($entities->commentaire_m, '') == 0)
                                                -
                                            @else
                                                {{ $entities->commentaire_m }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (strcmp($entities->commentaire_p, '') == 0)
                                                -
                                            @else
                                                {{ $entities->commentaire_p }}
                                            @endif
                                        </td>

                                        @if ($entities->actif_m == 2)
                                            <td><a id="{{ $entities->id }}" href='#' class=''><span
                                                        class=''><span class='green-text'>Validé</span></span></a>
                                            </td>
                                        @else
                                            @if ($entities->actif_m == 1)
                                                <td><a id="{{ $entities->id }}" href='#' class=''><span
                                                            class=''><span class='yellow-text'>En
                                                                cours...</span></span></a></td>
                                            @else
                                                <td><a id="{{ $entities->id }}" href='#' class=''><span
                                                            class=''><span class='red-text'>Rejeté</span></span></a>
                                                </td>
                                            @endif
                                        @endif

                                        @if ($entities->actif_p == 2)
                                            <td><a id="{{ $entities->id }}" href='#' class=''><span
                                                        class=''><span class='green-text'>Validé</span></span></a>
                                            </td>
                                        @else
                                            @if ($entities->actif_p == 1)
                                                <td><a id="{{ $entities->id }}" href='#' class=''><span
                                                            class=''><span class='yellow-text'>En
                                                                cours...</span></span></a></td>
                                            @else
                                                <td><a id="{{ $entities->id }}" href='#' class=''><span
                                                            class=''><span class='red-text'>Rejeté</span></span></a>
                                                </td>
                                            @endif
                                        @endif

                                        <td>
                                            <a id="{{ $entities->id }}"
                                                href='{{ url("/ferme/eb/commentP/edit/$entities->id") }}'
                                                class="btn-small indigo">Commentaire</a>
                                        </td>

                                        <td>

                                            {{-- <a id="{{ $entities->id }}" href="#edit-expression-b"
                                                class="edit-eb modal-trigger">
                                                <i class="material-icons">visibility
                                                </i>
                                            </a> --}}
                                            <input type="text" hidden id="root" value="{{ route('ferme.eb') }}">

                                            @if ($entities->actif_p == 2)
                                                {{-- <a id="{{ $entities->id }}" href='#' class='desactivate_eb'>
                                                        <span
                                                            class='chip'style="background-color: transparent !important">
                                                            <span class='red-text'><i
                                                                    class="material-icons"title="rejeter">close</i>
                                                            </span>
                                                        </span>
                                                    </a> --}}
                                            @else
                                                @if ($entities->actif_p == 0)
                                                    {{-- <a id="{{ $entities->id }}" href='#' class='activate_eb'>
                                                            <span class='chip '
                                                                style="background-color: transparent !important">
                                                                <span class='green-text'><i class="material-icons"
                                                                        title="valider">done</i>
                                                                </span>
                                                            </span>
                                                        </a> --}}
                                                @else
                                                    <a id="{{ $entities->id }}" href='#' class='activate_eb'>
                                                        <span class='chip '
                                                            style="background-color: transparent !important">
                                                            <span class='green-text'><i class="material-icons"
                                                                    title="valider">done</i>
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <a id="{{ $entities->id }}" href='#' class='desactivate_eb'>
                                                        <span
                                                            class='chip'style="background-color: transparent !important">
                                                            <span class='red-text'><i
                                                                    class="material-icons"title="rejeter">close</i>
                                                            </span>
                                                        </span>
                                                    </a>
                                                @endif
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                    </table>
                </div>
                {{-- <button class="btn edit-eb ">check</button> --}}
                @include('gestion.ferme.expression.view')
                {{-- gestion.ferme.expression.view --}}
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('other-js-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

{{-- <script src="{{ asset('assets/js/scripts/page-users.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/scripts/ui-alerts.js') }}"></script>
<script src="{{ asset('assets\js\providers\ferme_activite.js') }}"></script>
{{-- <script src="{{asset('assets\js\providers\entity.js')}}"></script> --}}


{{-- <script src="{{ asset('assets\js\crud\gestion\utilisateurs\filter.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/crud/gestion/ferme/eb/edit.js') }}"></script> --}}

{{-- <script type="text/javascript">$(".select2").select2({
  dropdownAutoWidth: true,
  width: '100%'
});</script> --}}
@endsection
