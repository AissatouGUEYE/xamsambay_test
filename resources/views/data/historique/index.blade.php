{{-- 
@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
@endsection
@section('page-title')
{{ $_SESSION['nom_entite'] }}
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
   <a href="#">Historiques</a>
</li>

    
@endsection

@section('main_content')
    <section class="users-list-wrapper section">
        

        <div class="row " style="margin-top: 80px">
            <div class="col s12">
                <ul class="collapsible collapsible-accordion">
                    @if ($_SESSION['role'] == 'FERME AGRICOLE')

                    <li>
                        <div class="collapsible-header"><i class="material-icons">person</i> Users </div>
                        <div class="collapsible-body">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>Acteur</th>
                                        <th>Action</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
   
                                    </tr>
                                   
                                </tbody>
                            </table>
            
                        </div>
                    </li>

                    <li>
                        <div class="collapsible-header"><i class="material-icons">playlist_add</i> Productions </div>
                        <div class="collapsible-body">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>Acteur</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
   
                                    </tr>
                                   
                                </tbody>
                            </table>
            
                        </div>
                    </li>

                   <li>
                        <div class="collapsible-header"><i class="material-icons">attach_money</i> Finance </div>
                        <div class="collapsible-body">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>Acteur</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
   
                                    </tr>
                                   
                                </tbody>
                            </table>
            
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">record_voice_over</i> Expression de besoin </div>
                        <div class="collapsible-body">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>Acteur</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
   
                                    </tr>
                                   
                                </tbody>
                            </table>
            
                        </div>
                    </li>
                    
                    @endif
                  

                </ul>
            </div>
        </div>
    </section>
@endsection
@section('other-js-script')
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
<script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('assets/js/scripts/page-users.js') }}"></script>
<script src="{{ asset('assets/js/scripts/extra-components-sweetalert.js') }}"></script>
<script src="{{ asset('assets/js/providers/message.js') }}"></script>


@endsection --}}


@extends('layouts.master')
@section('main_content')
<h1>En Cours de Développement ...</h1>
@endsection