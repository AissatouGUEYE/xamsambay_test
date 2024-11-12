@extends('welcome')
@php
    if (
        request()
            ->session()
            ->exists('message')
    ) {
        $message = request()
            ->session()
            ->pull('message', '');
        request()
            ->session()
            ->forget('message');
    }
@endphp
@section('landingContent')
    @include('landing.layouts.dashboard_appels_offres')

    <div class="light-background">
        <div class="layer-stretch">
            <div class="layer-wrapper">
                <div class="row pt-4">
                    <div class="panel panel-default m-0">
                        <div class="panel-head">
                            <div class="panel-title text-center">
                                <h3>Details Offre <a href="{{route('opportunites.offres')}}"> Voir tous les offres</a>
                                </h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">{{$opportunite->poste}}</h4>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div>

                                    <h5>{{$opportunite->libelle}}</h5>
                                    <br>
                                    <a href="#">{{$opportunite->location}}</a>
                                </div>
                                <div>
                                    @if (isset($opportunite->lien))
                                        <a href="{{ asset('storage/' . $opportunite->lien) }}" target="_blank">
                                            <i class="material-icons green-text ">Telechargement</i>
                                        </a>
                                    @else
                                        ---
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 mb-2">
                                <h5>Contexte</h5>
                                <p>
                                    {{$opportunite->contexte}}
                                </p>
                                <br><br>
                                <h5>Description de l'offre</h5>
                                <p>
                                    {{$opportunite->description}}

                                </p>
                                <br><br>
                                <h5>Profil Recherche</h5>
                                <p>
                                    {{$opportunite->criteres}}
                                </p>
                                <br><br>
                            </div>

                            @if($opportunite->type === 'recrutement')
                                <div class="row mt-4">
                                    <div class="col s10">
                                        <form action="{{route('postuler.offres')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col s6">
                                                    <label for="prenom">Prenom</label>
                                                    <input type="text" name="prenom" id="prenom">
                                                </div>
                                                <div class="col s6">
                                                    <label for="nom"> Nom</label>
                                                    <input type="text" name="nom" id="nom">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12">
                                                    <input type="file" name="cv" id="cv" placeholder="Joindre CV">
                                                </div>
                                                <input type="hidden" name="idOpportunite" value="{{$opportunite->id}}">
                                                {{--      // Inclure ID Opportunites--}}
                                            </div>
                                            <div class="row">
                                                <div class="s12 mt-2">
                                                    <button type="submit" class="btn bg-success text-white">
                                                        Postuler
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @isset($message)
{{--                                                    <input type="text" name="texto" id="texto" value="{{ $message }}"--}}
{{--                                                           hidden>--}}
                                                    <span class="text-red align-items-center">{{$message}}</span>
                                                @endisset
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col s2">

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('other-js-script')
    <script>
        $(document).ready(function () {
            let sms = $("#texto").val();
            if (sms) {

                alert(sms);
                // swal({
                //     title: "info",
                //     icon: "info",
                //     text: sms,
                //     timer: 5000,
                //     buttons: false,
                // });
            }
        })

    </script>
@endsection
