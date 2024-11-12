@extends('layouts.master')
@section('page-title')
    Prévision Details
@endsection
@php
    //    dd($listNumber);
@endphp
@section('ariane')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('info-clim.prevision')}}">information-climatique - Prevision</a>
    </li>
    <li class="breadcrumb-item active">
        <a class="yellow-text" href="#">Details Prevision </a>
    </li>
@endsection

@section('main_content')
    <div class="users-list-table">
        <div class="card">
            <div class="card-header">
                <h5 class="pt-2 ml-3">Statistiques Prevision</h5>
            </div>
            <div class="card-content">
                <div class="users-list-table">
                    <div class="card">
                        <div class="card-content">
                            <!-- datatable start -->
                            <div class="responsive-table">
                                <table id="statsTable" class="table display striped">
                                    <thead>
                                    <tr>
                                        <th>Prenom Nom</th>
                                        <th>Numero</th>
                                        <th>Localite</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listNumber as $number)
                                        <tr>
                                            <td>
                                                @if($number->nom)
                                                {{$number->nom}}
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>{{$number->telephone}}</td>
                                            <td>
                                                @if($number->localite)
                                                    {{$number->localite}}
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>
                                                {{$number->date}}
                                            </td>
                                            <td></td>
                                        </tr>
                                        {{--                                    @empty--}}
                                        {{--                                        <tr>--}}
                                        {{--                                            <td>Pas de Contact appartenant a cet organisme</td>--}}
                                        {{--                                        </tr>--}}
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Prenom Nom</th>
                                        <th>Numero</th>
                                        <th>Localite</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- datatable ends -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('other-js-script')
@endsection
