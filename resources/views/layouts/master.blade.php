@include('layouts.header')
@include('layouts.sidebar.left_sidebar')
<div id="main">
    <div class="row">
        <div class="content-wrapper-before green gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        {{-- <h5 class="breadcrumbs-title mt-0 mb-0"><span>@yield('page-title')</span></h5> --}}
                        <ol class="breadcrumbs mb-0">
                            @yield('ariane')

                        </ol>
                    </div>
                    {{-- <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a>
                            <ul class="dropdown-content" id="dropdown1" tabindex="0">
                                <li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">Profile<span class="new badge red">2</span></a></li>
                                <li tabindex="0"><a class="grey-text text-darken-2" href="app-contacts.html">Contacts</a></li>
                                <li tabindex="0"><a class="grey-text text-darken-2" href="page-faq.html">FAQ</a></li>
                                <li class="divider" tabindex="-1"></li>
                                <li tabindex="0"><a class="grey-text text-darken-2" href="user-login.html">Logout</a></li>
                            </ul>
                        </div> --}}

                    {{-- @if ($_SESSION['role'] != 'ADMIN' && $_SESSION['role'] != 'SUPERADMIN')
                        <div class="col s12 m10 l11">
                            <div id="card-stats" class="pt-0">
                                <div class="row">
                                    @isset($_SESSION['sms'])
                                        <div class="col s12 m6 l6 xl4">
                                            <div
                                                class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeLeft">
                                                <div class="pl-2 pr-2">
                                                    <div class="row">
                                                        <div class="col s6 m6">
                                                            <i class="material-icons background-round mt-5">message</i>
                                                            <p>Push SMS</p>
                                                        </div>
                                                        <div class="col s6 m6 right-align pt-5">
                                                            <h5 class="mb-0 white-text">{{ $_SESSION['sms'] }}</h5>
                                                            <p class="no-margin">Restant</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($_SESSION['appels'])
                                        @php
                                            $appels = intval($_SESSION['appels']);
                                            if ($appels >= 60) {
                                                $minutes = $appels / 60;
                                                $appels = $appels % 60;
                                            }
                                        @endphp
                                        <div class="col s12 m6 l6 xl4">
                                            <div
                                                class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeLeft">
                                                <div class="pl-2 pr-2">
                                                    <div class="row">
                                                        <div class="col s6 m6">
                                                            <i class="material-icons background-round mt-5">call</i>
                                                            <p>Push Voice</p>
                                                        </div>
                                                        @if (isset($minutes))
                                                            <div class="col s6 m6 right-align">
                                                                <h5 class="mb-0 white-text">{{ $minutes }}</h5>
                                                                <p class="no-margin">Minutes</p>
                                                                <span class="mb-0 white-text"
                                                                    style="font-size: 19px">{{ $appels }}</span>
                                                                <p class="no-margin">Secondes</p>
                                                            </div>
                                                        @else
                                                            <div class="col s6 m6 right-align pt-5">
                                                                <h5 class="mb-0 white-text">{{ $appels }}</h5>
                                                                <p class="no-margin">Secondes</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($_SESSION['stats'])
                                        <div class="col s12 m6 l6 xl4">
                                            <div
                                                class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeRight border-rounded">
                                                <div class="pl-2 pr-2">
                                                    <div class="row">
                                                        <div class="col s5 m5">
                                                            <i class="material-icons background-round mt-5">timeline</i>
                                                            <p>Stats</p>
                                                        </div>
                                                        <div class="col s7 m7 right-align pt-5">
                                                            <h5 class="mb-0 white-text">{{ $_SESSION['stats'] }}</h5>
                                                            <p class="no-margin">Total Packs</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @endif --}}

                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                {{-- <div id="cards"> --}}
                {{-- <div class="card"> --}}
                {{-- <div class="card-content"> --}}
                @yield('main_content')
                {{-- {{$_SESSION['menu']}} --}}
                {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </div>
        {{-- <div class="container"> 
                    <div id="cards-extended">
                        {{-- <div class="card"> --}}
        {{-- <div class="card-content"> --}}
        {{-- @yield('main_content2') --}}
        {{-- {{$_SESSION['menu']}} --}}
        {{-- </div> --}}
        {{-- </div> 
                    </div>
                </div> --}}
        {{-- @extends('layouts.sidebar.right_sidebar') --}}
        {{-- <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"> --}}

        {{-- <div> --}}

        {{-- @extends('layouts.intro') --}}
    </div>
    <div class="content-overlay"></div>
</div>
</div>
</div>
</div>
{{-- @extends('layouts.modal') --}}

@extends('layouts.view_settings')
@extends('layouts.footer')
