<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ asset(route('landing')) }}"><img
                    class="hide-on-med-and-down" src="{{ asset('assets/images/logo/FAVICO1.ico') }}"
                    alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{ asset('assets/images/logo/Logo_mlouma_v2.png') }}" alt="MLOUMA logo" /><span
                    class="logo-text hide-on-med-and-down">MLOUMA</span></a><a class="navbar-toggler"
                href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a>
        </h1>
    </div>

    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">
        {{-- @if ($_SESSION['role'] != 'ADMIN' && $_SESSION['role'] != 'SUPERADMIN')
            @isset($_SESSION['sms'])
                <li>
                    <div class="row">
                        <div class="col s6">
                            <a class=" text-darken-1" href="#">
                                <b><i class="material-icons">chat_bubble_outline</i><span style="border-radius: 3px"
                                        class="badge orange">
                                        {{ $_SESSION['sms'] }}</span></b>
                            </a>
                        </div>
                        <div class="col s6">
                            <a class="text-darken-1" href="#">
                                <b><i class="material-icons">call</i>
                                    <span style="border-radius: 3px" class="badge orange">
                                        {{ $_SESSION['appels'] }}</span>
                                </b>
                            </a>
                        </div>
                    </div>
                </li>
            @endisset
        @endif --}}
        @if (!empty($menuData) && isset($menuData[$_SESSION['menu']]))
            @foreach ($menuData[$_SESSION['menu']]->menu as $menu)
                @if (isset($menu->navheader))
                    <li class="navigation-header">
                        <a class="navigation-header-text">{{ $menu->navheader }}</a>
                        <i class="navigation-header-icon material-icons">{{ $menu->icon }}</i>
                    </li>
                @else
                    @php
                        $custom_classes = '';
                        $classActive = '';
                        if (isset($menu->class)) {
                            $custom_classes = $menu->class;
                        }
                        if (request()->is($menu->url . '*')) {
                            $classActive = 'active open';
                        } else {
                            if ($menu->url == 'javascript:void(0)') {
                                if (isset($menu->submenu)) {
                                    $submenu = $menu->submenu;
                                    foreach ($submenu as $key => $value) {
                                        if (request()->is($value->url . '*')) {
                                            $classActive = 'active open';
                                        }
                                    }
                                }
                            }
                        }
                    @endphp
                    <li class="bold {{ $classActive }}">
                        <a class="{{ $custom_classes }} {{ request()->is($menu->url . '*') ? ' active' : '' }}"
                            {{-- @if (!empty($configData['activeMenuColor'])) {{'style=background:none;box-shadow:none;'}} @endif --}}
                            href="@if ($menu->url === 'javascript:void(0)') {{ $menu->url }} @else{{ url($menu->url) }} @endif"
                            {{ isset($menu->newTab) ? 'target="_blank"' : '' }}>
                            <i class="material-icons">{{ $menu->icon }}</i>
                            <span class="menu-title">{{ $menu->name }}</span>
                            @if (isset($menu->tag))
                                <span class="{{ $menu->tagcustom }}">{{ $menu->tag }}</span>
                            @endif
                        </a>
                        @if (isset($menu->submenu))
                            @include('layouts.submenu', ['menu' => $menu->submenu])
                        @endif
                    </li>
                @endif
            @endforeach
        @endif
        {{-- <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="Templates">Templates</span></a> --}}
    </ul>
    <div class="navigation-background"></div><a
        class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
