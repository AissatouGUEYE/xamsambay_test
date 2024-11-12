<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (in_array(env('APP_ENV'), ['local', 'test']))
        <meta name="url" content="{{ 'https://api.mlouma.org/api' }}" hidden>
    @elseif(env('APP_ENV') === 'prod')
        <meta name="url" content="{{ 'https://api.mlouma.com/api' }}" hidden>
    @endif

    {{-- <meta name="ferme" content="{{ $_SESSION['id_entite'] }}" hidden> --}}
    <meta name="token" content="{{ $_SESSION['token'] }}" hidden>
    <meta name="id" content="{{ isset($_GET['utilisateur']) ? $_GET['utilisateur'] : null }}" hidden>
    <meta name="role" content="{{ isset($_SESSION['role']) ? $_SESSION['role'] : null }}" hidden>
    <meta name="id_profil" content="{{ isset($_SESSION['id']) ? $_SESSION['id'] : null }}" hidden>


    @if ($_SESSION['role'] == 'ADMIN')
        <meta name="ferme" content="{{ $_SESSION['ferme'] }}" hidden>
    @else
        <meta name="ferme" content="{{ $_SESSION['id_entite'] }}" hidden>
    @endif
    <meta name="profil" content="{{ isset($_SESSION['profil']) ? $_SESSION['profil'] : null }}" hidden>
    <meta name="csrf-token" content="{{ csrf_token() }}" hidden>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Xamsambay, une plateforme de Mlouma qui vous propose des services étudiés et optimisés pour répondre aux besoins spécifiques des acteurs de la chaine de valeurs!">
    <meta name="keywords"
          content="mlouma, xamsambay, louma mbay, meteombay, prix du marche">
    <meta name="author" content="ThemeSelect">
    <title>XAMSAMBAY | V2.0</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/FAVICO1.ico') }}">
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate-css/animate.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chartist-js/chartist.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/materialize-stepper/materialize-stepper.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <!-- END: VENDOR CSS-->
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}"> --}}
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard-modern.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/intro.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/page-users.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    @yield('other-css-files')

    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns"
    data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

@php
    $user = Auth::user();
    if ($user->logo != '') {
        $logo = $user->logo;
    }
    if (isset($_SESSION['appels'])) {
        $init = $_SESSION['appels'];
        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;
    }
@endphp

    <!-- BEGIN: Header-->
<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock green  no-shadow">
            <div class="nav-wrapper">

                <div class="header-search-wrapper hide-on-med-and-down">
                        <span style="font-size: 20px;" class="breadcrumbs-title mt-0 mb-0 mr-5"><span
                                class="white-color">@yield('page-title')</span></span>
                </div>
                <ul class="navbar-list right">
                    {{-- <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button"
                            href="#" data-target="translation-dropdown"><span
                                class="flag-icon flag-icon-fr"></span></a>
                    </li> --}}
                    <li class="dropdown-language"><a
                            class="waves-effect waves-block waves-light translation-button" href="#"
                            data-target="translation-dropdown"><span class=""><b>FR</b>
                                </span></a>
                    </li>
                    <li class="hide-on-med-and-down"><a
                            class="waves-effect waves-block waves-light toggle-fullscreen"
                            href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li class="hide-on-large-only search-input-wrapper"><a
                            class="waves-effect waves-block waves-light search-button"
                            href="javascript:void(0);"><i class="material-icons">search</i></a></li>
                    {{-- <li><a class="waves-effect waves-block waves-light notification-button"
                            href="javascript:void(0);" data-target="notifications-dropdown"><i
                                class="material-icons">notifications_none<small
                                    class="notification-badge">5</small></i></a></li> --}}
                    <li>
                        <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                           data-target="profile-dropdown">
                            <span class="avatar-status avatar-online">
                                <img
                                    @if (isset($logo))
                                        src="{{ asset('storage/' . $logo) }}"
                                    @else
                                        @if ($_SESSION['role'] == 'FERME AGRICOLE')
                                            src="{{ asset('assets/images/avatar/lf.png') }}"
                                    @else
                                        src="{{ asset('assets/images/avatar/person-icon.png') }}"
                                    @endif
                                    @endif
                                    alt="avatar">
                            </span>
                        </a>
                        <!-- profile-dropdown-->
                        <ul class="dropdown-content" id="profile-dropdown">
                            @if ($_SESSION['login'] != null && $_SESSION['login'] != 'null')

                                @if ($_SESSION['role'] == 'FERME AGRICOLE')
                                    <li><a class="grey-text text-darken-1" href="{{ route('user.ferme.profile') }}"><i
                                                class="material-icons">person_outline</i> {{ $_SESSION['login'] }}</a>
                                    </li>
                                @else
                                    <li><a class="grey-text text-darken-1" href="{{ route('user.profil') }}"><i
                                                class="material-icons">person_outline</i> {{ $_SESSION['login'] }}</a>
                                    </li>
                                @endif
                            @else
                                @if ($_SESSION['role'] == 'FERME AGRICOLE')
                                    <li><a class="grey-text text-darken-1" href="{{ route('user.ferme.profile') }}"><i
                                                class="material-icons">person_outline</i> {{ $_SESSION['prenom'] }}</a>
                                    </li>
                                @else
                                    <li><a class="grey-text text-darken-1" href="{{ route('user.profil') }}"><i
                                                class="material-icons">person_outline</i> {{ $_SESSION['prenom'] }}</a>
                                    </li>
                                @endif

                            @endif

                            <li class="divider"></li>

                            <li class="pt-2">
                                <form id="logout_form" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a id="logout" class="grey-text text-darken-1" href="javascript:void(0)"
                                       style="padding: 0 8px !important;">
                                        <i class="material-icons" style="font-size: 18px">keyboard_tab</i>
                                        <span style="font-size: 14px">Se Déconnecter</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{-- <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li> --}}
                </ul>
                <!-- translation-button-->
                <ul class="dropdown-content" id="translation-dropdown">
                    {{-- <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="en"><i class="flag-icon flag-icon-gb"></i> English</a></li> --}}
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!"
                                                 data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a>
                    </li>
                    {{-- <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></li>
          <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a></li> --}}
                </ul>
            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form id="navbarForm">
                        <div class="input-field search-input-sm">
                            <input class="search-box-sm mb-0" type="search" required="" id="search"
                                   placeholder="Explore Materialize" data-search="template-list">
                            <label class="label-icon" for="search"><i
                                    class="material-icons search-sm-icon">search</i></label><i
                                class="material-icons search-sm-close">close</i>
                            <ul class="search-list collection search-list-sm display-none"></ul>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>
{{-- ------------------------------------------------------------------------------HEADER-ELEMENTS----------------------------------------- --}}
<ul class="display-none" id="default-search-main">
    <li class="auto-suggestion-title"><a class="collection-item" href="#">
            <h6 class="search-title">FILES</h6>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ asset('assets/images/icon/pdf-image.png') }}"
                                             width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Two new item
                                submitted</span><small class="grey-text">Marketing Manager</small></div>
                </div>
                <div class="status"><small class="grey-text">17kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ asset('assets/images/icon/doc-image.png') }}"
                                             width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file
                                Generator</span><small class="grey-text">FontEnd Developer</small></div>
                </div>
                <div class="status"><small class="grey-text">550kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ asset('assets/images/icon/xls-image.png') }}"
                                             width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File
                                Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                </div>
                <div class="status"><small class="grey-text">20kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img src="{{ asset('assets/images/icon/jpg-image.png') }}"
                                             width="24" height="30" alt="sample image"></div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Anna
                                Strong</span><small class="grey-text">Web Designer</small></div>
                </div>
                <div class="status"><small class="grey-text">37kb</small></div>
            </div>
        </a></li>
    <li class="auto-suggestion-title"><a class="collection-item" href="#">
            <h6 class="search-title">MEMBERS</h6>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle"
                                             src="{{ asset('assets/images/avatar/avatar-7.png') }}" width="30"
                                             alt="sample image">
                    </div>
                    <div class="member-info display-flex flex-column"><span class="black-text">John
                                Doe</span><small class="grey-text">UI designer</small></div>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle"
                                             src="{{ asset('assets/images/avatar/avatar-8.png') }}" width="30"
                                             alt="sample image">
                    </div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Michal
                                Clark</span><small class="grey-text">FontEnd Developer</small></div>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle"
                                             src="{{ asset('assets/images/avatar/avatar-10.png') }}" width="30"
                                             alt="sample image">
                    </div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Milena
                                Gibson</span><small class="grey-text">Digital Marketing</small></div>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="collection-item" href="#">
            <div class="display-flex">
                <div class="display-flex align-item-center flex-grow-1">
                    <div class="avatar"><img class="circle"
                                             src="{{ asset('assets/images/avatar/avatar-12.png') }}" width="30"
                                             alt="sample image">
                    </div>
                    <div class="member-info display-flex flex-column"><span class="black-text">Anna
                                Strong</span><small class="grey-text">Web Designer</small></div>
                </div>
            </div>
        </a></li>
</ul>
<ul class="display-none" id="page-search-title">
    <li class="auto-suggestion-title"><a class="collection-item" href="#">
            <h6 class="search-title">PAGES</h6>
        </a></li>
</ul>
<ul class="display-none" id="search-not-found">
    <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span
                class="material-icons">error_outline</span><span class="member-info">No results
                    found.</span></a></li>
</ul>
