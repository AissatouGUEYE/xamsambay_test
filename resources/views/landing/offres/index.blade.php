@extends('welcome')
@section('landingContent')
    @include('landing.layouts.dashboard_appels_offres')

    <div class="light-background">
        <div class="layer-stretch">
            <div class="layer-wrapper">
                <div class="row pt-4">
                    <div class="panel panel-default m-0">
                        <div class="panel-head">
                            <div class="panel-title text-center">
                                <h3>Listes des Offres d'Emploi</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row text-center items-center mt-4 mb-4">
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <select name="" id="" style="display: inline-block; !important;">--}}
                                {{--                                        <option value="">All Secteurs</option>--}}
                                {{--                                        <option value="">Agriculture</option>--}}
                                {{--                                        <option value="">Peche</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <select name="" id="" style="display: inline-block; !important;">--}}
                                {{--                                        <option value="">All Localites</option>--}}
                                {{--                                        <option value="">Dakar</option>--}}
                                {{--                                        <option value="">ziguinchor</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                            </div>

                            {{--           Listes des Postes --}}

                            @forelse($opportunites as $opportunite)
                                <div class="container mt-2">
                                    <h3>{{$opportunite->poste}}</h3>
                                    <a href="{{route('details.offres',['id'=>$opportunite->id])}}" class=""
                                       style="text-decoration: none; ">
                                        <div class="d-flex justify-content-between align-items-center bg-light p-4">
                                            <div class="" style="width:75%">
                                                <h5 class="text-black">{{$opportunite->libelle}} </h5>
                                                <span class="text-black">
                                                    {{$opportunite->description}}
                                                </span>
                                                <br>
                                                <span class="mt-6"> {{$opportunite->location}}</span>
                                            </div>
                                            <div class="ml-3">
                                                <i class="fa fa-circle-chevron-right secondary fa-2x"
                                                   style="color: #3c4a50"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty

                                <p class="text-center">
                                    Pas d'Opportunites pour le moment ! Revenez souvent.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
