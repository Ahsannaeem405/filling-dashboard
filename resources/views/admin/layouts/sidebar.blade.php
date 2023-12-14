<style>
    body.vertical-layout.vertical-menu-modern .toggle-icon {
        margin-top: 8px !important;
    }

    .active-toggle {
        font-size: 10px !important;
        padding: 0 6px !important;
        font-weight: 600 !important;
    }

    .adminLabel {
        padding: 0 30px !important;
        font-weight: 600 !important;
    }
</style>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('dashboard') }}">
                    <div class=""><img style='width: 39px;' src="{{ asset('app-assets/images/logo/logo-main.png') }}"
                            alt=""></div>
                    <h2 class="white-text mb-0 ml-2" style="font-size: 20px">NullzFilling</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i
                        class="fa fa-home"></i><span class="menu-title" data-i18n="Calender">Dashboard</span></a></li>
            @if (Auth::user()->status === 'active')
            
                @if (auth()->user()->role == 'user')
                    <li class="nav-item {{ Request::is('einnahmen*') ? 'active' : '' }}"><a
                            href="{{ route('user.payment') }}"><i class="fa fa-shopping-cart"></i><span
                                class="menu-title" data-i18n="Calender">Einnahmen</span></a></li>
                @endif
                <li class="nav-item {{ Request::is('chat') ? 'active' : '' }}"><a href="{{ route('chat') }}"><i
                            class="feather icon-message-square"></i><span class="menu-title"
                            data-i18n="Calender">Chats</span></a></li>
                <li class="nav-item "><a href="#"><i class="fa fa-support"></i><span class="menu-title"
                            data-i18n="Calender">Kontakte</span></a></li>
                
            @endif


            @if (auth()->user()->role == 'admin')
                <label class="label" style="padding: 0 30px; font-weight:600">ADMINPANEL</label>
                <li class="nav-item {{ Request::is('user-list') ? 'active' : '' }}"><a
                        href="{{ route('users.list') }}"><i class="feather icon-users"></i><span class="menu-title"
                            data-i18n="Calender">Benutzerliste</span></a></li>
                <li class="nav-item {{ Request::is('payment*') ? 'active' : '' }}"><a href="{{ route('payment') }}"><i
                            class="fa fa-file-text"></i><span class="menu-title"
                            data-i18n="Calender">Payments</span></a></li>
                <li class="nav-item {{ Request::is('accounts*') ? 'active' : '' }}"><a
                        href="{{ route('accounts') }}"><i class="fa fa-id-card"></i><span class="menu-title"
                            data-i18n="Calender">Accounts</span></a></li>
                <li class="nav-item {{ Request::is('setting*') ? 'active' : '' }}"><a href="{{ route('setting') }}"><i
                            class="feather icon-settings"></i><span class="menu-title"
                            data-i18n="Calender">Einstellungen</span></a></li>
            @endif
        </ul>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-icon').on('click', function() {
            $('.label').toggleClass('active-toggle');
        })
        $('.main-menu').mouseenter(function() {
            $('.label').addClass('adminLabel');
        }).mouseleave(function() {
            $('.label').removeClass('adminLabel');
        });
    })
</script>
