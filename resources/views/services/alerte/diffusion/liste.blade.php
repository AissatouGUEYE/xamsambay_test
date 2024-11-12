@extends('layouts.master')
@section('page-title')
    Services Alertes
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('alertes') }}">Alertes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" style="color:#ffe900">Liste de Diffusion</a>
    </li>
@endsection
@section('main_content')
    {{-- <h5> Liste des Diffusion</h5> --}}
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-3 mt-3">
                        <div class="col s8">
                        </div>
                        <div class="col s4">
                            <a class="waves-effect waves-light  green darken-1 btn modal-trigger right mr-1"
                                href="{{ route('new.liste.diffusion') }}">
                                <i class="material-icons">add_circle</i> Liste de diffusion
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="data-table-simple" class="table">
                            <thead>
                                <tr>
                                    <th>Nom Liste</th>
                                    <th>Description</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @isset($list)
                                    @foreach ($list as $liste)
                                        <tr>
                                            <td>{{ $liste->nom }}</td>
                                            <td>{{ $liste->description }}</td>
                                            @if ($liste->statut == 0)
                                                <td>
                                                    <a id="statut"
                                                        href='{{ route('diffusion.activer.liste', [$liste->id]) }}'><span
                                                            class='chip red lighten-5'><span
                                                                class='red-text'>Inactif</span></span></a>
                                                    <input type="hidden" name="changeStatut" id="changeStatut" hidden
                                                        value="{{ route('diffusion.activer.liste', [$liste->id]) }}">
                                                </td>
                                            @else
                                                <td>
                                                    <a id="statut"
                                                        href='{{ route('diffusion.desactiver.liste', [$liste->id]) }}'><span
                                                            class='chip green lighten-5'><span
                                                                class='green-text'>Actif</span></span></a>
                                                    <input type="hidden" name="changeStatut" id="changeStatut" hidden
                                                        value="{{ route('diffusion.desactiver.liste', [$liste->id]) }}">
                                                </td>
                                            @endif
                                            <td>
                                                <a href='{{ route('alertes.diffusion.listeUser', [$liste->id]) }}'><i
                                                        class="material-icons">visibility</i></a>
                                                <a href='{{ route('alertes.diffusion.addUserForList', [$liste->id]) }}'
                                                    class="px-1"><i class="material-icons orange-text ">add</i></a>
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
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#statut').click(function(e) {
                e.preventDefault();
                let url = $('#changeStatut').val();
                // console.log(url);
                swal({
                    title: "Liste de diffusion",
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
