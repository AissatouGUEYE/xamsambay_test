@extends('layouts.master')
@section('main_content')
@section('page-title')
    Souscription de Packs
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        @if ($_SESSION['role'] == 'ADMIN')
            <a href="{{ route('packs') }}">Packs</a>
        @else
            <a href="{{ route('packs.index') }}">Packs</a>
        @endif
    </li>
    <li class="breadcrumb-item active" style="color:#ffe900">Souscriptions
    </li>
@endsection

@section('main_content')
    @php
        // dd($packs);
        $canal = 'list';
    @endphp
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
        </div>
        <div class="users-list-table">
            <div class="card">
                {{-- <div class="card-header">
                    <div class="row">
                        <div class="col s9"> </div>
                        <div class="col s3">
                            <a href="{{ route('packs.souscriptions.journals') }}"
                                class="btn green white-text btn-flat mt-4"><span>Journal
                                    Souscriptions</span>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="statsTable" class="table">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Profil</th>
                                    <th>Effectif</th>
                                    <th>Tarif</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Evidence</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($packs)
                                    @foreach ($packs as $pack)
                                        <tr>
                                            <td>{{ $pack->reference }}</td>
                                            <td>{{ $pack->nom_entite }}</td>
                                            <td>{{ $pack->effectif }}</td>
                                            <td>{{ $pack->pricing * $pack->effectif }}</td>
                                            <td> @php echo date('d/m/Y', strtotime($pack->date_creation));  @endphp
                                            </td>
                                            <td>
                                                @if ($pack->status == 0)
                                                    <span class="chip lighten-5"
                                                        style="background-color:rgba(236, 204, 144, 0.942)">Initié</span>
                                                @else
                                                    <span class="chip green lighten-5">Validé</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($pack->fichier))
                                                    <a href="{{ asset('storage/' . $pack->fichier) }}" target="_blank">
                                                        <i class="material-icons green-text ">file_download</i>
                                                    </a>
                                                @else
                                                    <span style="text-align:center !important">------</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a id="see" title="Details Souscription"
                                                    href="{{ route('packs.souscriptions.details', [$pack->id_abonnement]) }}">
                                                    <i class="material-icons yellow-text pt-2">visibility</i>
                                                </a>
                                                @if ($pack->status == 0)
                                                    <a id="statut" title="Valider Souscription" class="chip"
                                                        href="{{ route('pack.activer', [$pack->id_abonnement]) }}">
                                                        <i class="material-icons green-text pt-2">done_all</i>
                                                    </a>
                                                @endif

                                                <input type="hidden" name="changeStatut" id="changeStatut" hidden
                                                    value="{{ route('pack.activer', [$pack->id_abonnement]) }}">
                                                {{-- <a title="Rejeter"
                                                    href='#' class="px-2"><i
                                                        class="material-icons red-text ">highlight_off</i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset

                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
    <script>
        $(document).ready(function() {
            $('#statut').click(function(e) {
                e.preventDefault();
                let url = $('#changeStatut').val();
                // console.log(url);
                swal({
                    title: "Souscription",
                    text: "Voulez-vous Modifiez le statut de la liste",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        delete: 'Oui',
                        cancel: 'Annuler'
                    }
                }).then(function(willDelete) {
                    if (willDelete) {
                        location.replace(url);
                    } else {

                    }
                });


            });

        });
    </script>
@endsection
