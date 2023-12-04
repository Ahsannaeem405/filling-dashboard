@extends('admin.layouts.master')
@section('title')
    <title>Chat</title>
@endsection
@section('chat')
    active
@endsection
@section('content')
    @if (Auth::user()->role == 'user')
        <style>
            .chat-application .sidebar-content {
                height: calc(var(--vh, 1vh) * 100 - 3rem) !important;
            }

            .chat-application .chat-app-window .start-chat-area {
                height: calc(var(--vh, 1vh) * 100 - 3rem) !important;
            }

            .chat-application .chat-app-window .user-chats {
                height: calc(var(--vh, 1vh) * 100 - 13rem) !important;
            }
        </style>
    @else
        <style>
            .chat-application .sidebar-content {
                height: calc(var(--vh, 1vh) * 100 - 8rem) !important;
            }

            .chat-application .chat-app-window .start-chat-area {
                height: calc(var(--vh, 1vh) * 100 - 8rem) !important;
            }

            .chat-application .chat-app-window .user-chats {
                height: calc(var(--vh, 1vh) * 100 - 18rem) !important;
            }
        </style>
    @endif
    <style>
        html body .content.app-content .content-area-wrapper {
            height: calc(100% - 0rem);
        }

        .scrol-custom::-webkit-scrollbar {
            width: 6px;
        }

        .scrol-custom::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .scrol-custom::-webkit-scrollbar-thumb {
            background-color: #999;
            border-radius: 8px;
        }

        .scrol-custom {
            height: calc(var(--vh, 1vh) * 100 - 13rem);
            overflow: auto;
        }

        .AcountsDetail {
            width: 40%;
            background-color: #262c49;
            padding: 12px;
            border-right: 1px solid #414561;
        }

        .AcountsDetail h3 {
            color: #7367f0 !important;
            margin-bottom: 16px;
        }

        .AcountsDetail ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .AcountsDetail ul li.active {
            background-color: #7367f0;
        }

        .AcountsDetail ul li {
            border-radius: 5px;
            padding: 4px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: inherit;
            color: #fff;
        }

        .AcountsDetail ul li img {
            border-radius: 50%;
            width: 40px;
            margin-right: 6px;
        }

        .AcountsDetail ul li span {
            padding: 11px 15px;
            border-radius: 50%;
            color: #7367f0;
            font-weight: 700;
            width: 40px;
            font-size: 16px;
            height: 40px;
            margin-right: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .list-style {
            cursor: pointer;
        }

        .initials .active {
            background-color: red;
        }

        /*  */
        .account-btn1 {
            border: none;
            outline: none;
            color: white;
            background: #27ce72;
            border-radius: 5px;
            padding: 6px;
            font-size: 11px;
            width: 96px;
            margin-bottom: 20px;
        }

        .account-btn2 {
            border: none;
            outline: none;
            color: white;
            background: #7367f0;
            border-radius: 5px;
            padding: 6px;
            font-size: 11px;
            width: 85px;
            margin-bottom: 20px;
        }

        .chat-btn {
            margin: 10px 10px 10px;
        }

        .account-prof {
            padding: 0px !important;
            background-color: transparent !important;
        }

        .account-prof p {
            margin: 0;
            font-size: 12px;
        }

        .fa-image:before {
            content: "\f03e";
            font-size: 20px;
            color: #C2C6DC;
        }

        .type-icon {
            position: absolute;
            right: 3%;
            top: 7px;
        }

        img.type-icon {
            width: 22px;
            right: 14%;
        }

        .chat-time-right p {
            text-align: right;
            margin-right: 60px;
            margin-bottom: 30px;
        }

        .chat-time-left p {
            text-align: left;
            margin-left: 60px;
            margin-bottom: 30px;
        }

        .send {
            display: flex;
            width: 25%;
            padding: 5px !important;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .initials {
            background-color: #8a82dd75;
            padding: 11px;
            border-radius: 50%;
            color: #7367f0;
            font-weight: 700;
            font-size: 16px;
            margin-right: 0px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .message-box {
            position: absolute;
            background-color: #10163A;
            padding: 20px;
            border-radius: 6px;
            text-align: center;
            width: 80%;
            max-width: 100%;
            font-size: 17px;
            font-weight: 600;
            right: 20px;
        }

        .message-box p {
            margin: 0 !important;
        }

        body.vertical-layout.vertical-menu-modern.menu-expanded .main-menu {
            z-index: 1050;
        }

        body.dark-layout .header-navbar {
            z-index: 1000;
        }

        .emojionearea-editor {
            color: white !important;
        }

        .emojionearea.emojionearea-inline.emojionearea-button {
            opacity: 0 !important;
            top: 8px !important;
        }

        .emojionearea .emojionearea-button {
            opacity: 0 !important;
            top: 6px !important;
            right: 50px !important;
        }

        .chat-application .sidebar-content .chat-user-list {
            margin-top: 0 !important;
            height: calc(100% - 0rem);
        }

        .chat-application .sidebar-content .chat-user-list li .contact-info {
            width: calc(100vw - (100vw - 100%) - 1rem - -10px);
        }

        .favorite-1 {
            margin: 7px;
            cursor: pointer;
        }

        .favorite-1:hover {
            color: goldenrod;
        }

        .custom-success-toast {
            background-color: #4CAF50;
            color: #ffffff;
        }

        .custom-warning-toast {
            background-color: rgb(163, 23, 23);
            color: #ffffff;
        }
    </style>
    @if (Auth::user()->status == 'in-active')
        <div class="overlay">
            <div class="message-box">
                <p>Dein Konto wurde noch nicht freigegeben.</p>
                <p>Bitte Gedulde dich etwas!</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="content-area-wrapper mt-0">
                <div class="AcountsDetail">
                    <h3>Accounts</h3>
                    @if (Auth::user()->role == 'user')
                        <button class='account-btn1' id='addAccountBtn'>Neuen Account hinzufugen</button>
                        <button class='account-btn2' id='updateAccountBtn'>Accounts aktualisieren</button>
                    @endif
                    <div class="scrol-custom">
                        <ul>
                            @if (isset($accounts))
                                @foreach ($accounts as $account)
                                    <li class="list-style" data-refresh="{{ $account->refreshToken }}"
                                        data-user-id="{{ $account->account_id }}" data-id="{{ $account->id }}">
                                        <span class="initials mr-1">{!! strtoupper(substr($account->description, 0, 2)) !!}</span>
                                        <?php
                                        $string = $account->description;
                                        $parts = explode(':', $string);
                                        $email = $parts[0];
                                        ?>
                                        {{ $email }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="sidebar-left">
                    <div class="sidebar">
                        <!-- Chat Sidebar area -->
                        <div class="sidebar-content card">
                            <span class="sidebar-close-icon">
                                <i class="feather icon-x"></i>
                            </span>
                            {{-- <div class="chat-fixed-search">
                                <div class="d-flex align-items-center">
                                    <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                        <div class=" profile-avatar">

                                        </div>
                                        <div class="bullet-success bullet-sm position-absolute"></div>
                                    </div>
                                    <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                        <input type="text" class="form-control round" id="chat-search"
                                            placeholder="Search or start a new chat">
                                        <div class="form-control-position">
                                            <i class="feather icon-search"></i>
                                        </div>
                                    </fieldset>
                                </div>
                            </div> --}}
                            <div id="users-list" class="chat-user-list list-group position-relative">
                                <div style='display:flex; justify-content:space-between; align-items:center;'>
                                    <h3 class="primary p-1 mb-0">Chats</h3>
                                    <button class='account-btn2 chat-btn d-none'>Chats aktualisieren</button>
                                </div>
                                <ul class="chat-users-list-wrapper media-list">

                                </ul>
                            </div>
                        </div>
                        <!--/ Chat Sidebar area -->

                    </div>
                </div>
                <div class="content-right">
                    <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                        <div class="content-body">
                            <div class="chat-overlay"></div>
                            <section class="chat-app-window">
                                <div class="start-chat-area" data-conv-id="" data-user-id="" data-refresh-token="">
                                    <span class="mb-2"><img src="{{ asset('app-assets/images/logo/Logo-main.png') }}"
                                            width="100px"></span>
                                    {{-- <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4> --}}
                                </div>
                                <div class="active-chat">
                                    <div class="chat_navbar">
                                        <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                            <div class="vs-con-items d-flex align-items-center">
                                                <div class="sidebar-toggle d-block d-lg-none mr-1"><i
                                                        class="feather icon-menu font-large-1"></i></div>
                                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                    <span class="initials buyerInitials"></span>
                                                    {{-- <span class="avatar-status-busy"></span> --}}
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0 buyerName"></h6>
                                                    <p><span class="price"></span> € VB</p>

                                                </span>
                                            </div>
                                            <div>
                                                <span class="favorite-1"><i
                                                        class="fa-solid fa-rectangle-ad font-medium-5"></i></span>
                                                <span class="favorite-1 paypal"><i
                                                        class="fa-brands fa-paypal font-medium-5"></i></span>
                                                <span class="favorite-1"><i
                                                        class="fa-solid fa-building-columns font-medium-5"></i></span>
                                                <span class="favorite-1"><i
                                                        class="fa-regular fa-trash-can font-medium-5"></i></span>
                                            </div>
                                        </header>
                                    </div>
                                    <div class="user-chats">
                                        <div class="chats append-chat">

                                        </div>
                                    </div>
                                    <div class="chat-app-form">
                                        <form class="chat-app-input d-flex justify-content-between position-relative"
                                            onsubmit="enter_chat();" id="myform" action="javascript:void(0);">
                                            <div class='position-relative'style='width: 70%;'>
                                                <input type="text" class="form-control message mr-1 ml-50 msg"
                                                    id="iconLeft4-1" placeholder="Sende eine Nachricht">
                                                <i class="type-icon fa fa-image"></i>
                                                <img class='type-icon' src="{{ asset('app-assets/images/logo/face.png') }}"
                                                    alt="user_avatar">
                                            </div>
                                            <button type="button" class="btn btn-primary send" onclick="enter_chat(); "><i
                                                    class="fa fa-paper-plane-o"></i>
                                                <span class="">Senden</span></button>
                                        </form>
                                    </div>

                                </div>
                            </section>
                            <!-- User Chat profile right area -->
                            <div class="user-profile-sidebar">
                                <header class="user-profile-header">
                                    <span class="close-icon">
                                        <i class="feather icon-x"></i>
                                    </span>
                                    <div class="header-profile-sidebar">
                                        <div class="avatar">
                                            <span class="logo initials"></span>
                                        </div>
                                        <h4 class="chat-user-name name"></h4>
                                    </div>
                                </header>
                                <div class="user-profile-sidebar-area p-2">

                                </div>
                            </div>
                            <!--/ User Chat profile right area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        $(document).ready(function() {
            var addAccountBtn = $('#addAccountBtn');
            var chatBtn = $('.chat-btn');
            var updateAccountBtn = $('#updateAccountBtn');

            var storedCountdown = localStorage.getItem('countdown');
            if (storedCountdown && new Date(storedCountdown) > new Date()) {
                var remainingSeconds = Math.floor((new Date(storedCountdown) - new Date()) / 1000);
                startCooldownTimer(remainingSeconds, addAccountBtn, function() {
                    addAccountBtn.text('Neuen Account hinzufügen');
                    addAccountBtn.prop('disabled', false);
                    localStorage.removeItem('countdown');
                });
                addAccountBtn.prop('disabled', true);
            }

            $(document).on('click', '#addAccountBtn', function() {

                localStorage.setItem('countdown', new Date(Date.now() + 60000).toISOString());

                $.ajax({
                    url: '{{ route('assign') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.scrol-custom').empty().append(data.component);
                        if (data.success) {
                            // toastr.success(data.success);
                            toastr.success(data.success, '', {
                                onShown: function() {
                                    $('.toast-success').css({
                                        'background-color': '#4CAF50',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else if (data.error) {
                            toastr.error(data.error, '', {
                                onShown: function() {
                                    $('.toast-error').css({
                                        'background-color': 'rgb(163, 23, 23)',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    },
                });

                startCooldownTimer(60, addAccountBtn, function() {
                    addAccountBtn.text('Neuen Account hinzufügen');
                    addAccountBtn.prop('disabled', false);
                    localStorage.removeItem('countdown');
                });

                addAccountBtn.prop('disabled', true);
            });

            var storedCountdown2 = localStorage.getItem('countdown2');
            if (storedCountdown2 && new Date(storedCountdown2) > new Date()) {
                var remainingSeconds = Math.floor((new Date(storedCountdown2) - new Date()) / 1000);
                startCooldownTimer(remainingSeconds, updateAccountBtn, function() {
                    updateAccountBtn.text('Accounts aktualisieren');
                    updateAccountBtn.prop('disabled', false);
                    localStorage.removeItem('countdown2');
                });
                updateAccountBtn.prop('disabled', true);
            }

            $(document).on('click', '#updateAccountBtn', function() {

                localStorage.setItem('countdown2', new Date(Date.now() + 60000).toISOString());

                $.ajax({
                    url: '{{ route('reload') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.start-chat-area').removeClass('d-none');
                        $('.active-chat').addClass('d-none');
                        $('.list-style').addClass('d-none');
                        $('.scrol-custom').empty().append(data.component);
                    },
                    error: function(error) {
                        console.error(error);
                    },
                });

                startCooldownTimer(60, updateAccountBtn, function() {
                    updateAccountBtn.text('Accounts aktualisieren');
                    updateAccountBtn.prop('disabled', false);
                    localStorage.removeItem('countdown2');
                });

                updateAccountBtn.prop('disabled', true);
            });

            var storedCountdown3 = localStorage.getItem('countdown3');
            if (storedCountdown3 && new Date(storedCountdown3) > new Date()) {
                var remainingSeconds = Math.floor((new Date(storedCountdown3) - new Date()) / 1000);
                startCooldownTimer(remainingSeconds, chatBtn, function() {
                    chatBtn.text('Chats aktualisieren');
                    chatBtn.prop('disabled', false);
                    localStorage.removeItem('countdown3');
                });
                chatBtn.prop('disabled', true);
            }

            $(document).on('click', '.chat-btn', function() {

                localStorage.setItem('countdown3', new Date(Date.now() + 60000).toISOString());

                var refreshToken = $('.list-style').attr('data-refresh');
                var id = $('.list-style').attr('data-id');
                var user_id = $('.list-style').attr('data-user-id');

                $.ajax({
                    type: 'get',
                    url: '{{ route('conversation') }}',
                    data: {
                        id: id,
                        user_id: user_id,
                        refreshToken: refreshToken
                    },
                    success: function(response) {
                        $('.media-list').empty().append(response.component);
                        $('.start-chat-area').removeClass('d-none');
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });

                startCooldownTimer(60, chatBtn, function() {
                    chatBtn.text('Chats aktualisieren');
                    chatBtn.prop('disabled', false);
                    localStorage.removeItem('countdown3');
                });

                chatBtn.prop('disabled', true);
            });

            function startCooldownTimer(seconds, button, callback) {
                var countdown = seconds;

                var timer = setInterval(function() {
                    if (countdown <= 0) {
                        clearInterval(timer);
                        callback();
                    } else {
                        button.text('Warte auf neues Konto ' + countdown + 's');
                    }
                    countdown--;
                }, 1000);
            }
        });
    </script>


    {{-- <script>
        $(document).ready(function() {
            var addAccountBtn = $('#addAccountBtn');
            var updateAccountBtn = $('#updateAccountBtn');
    
            $(document).on('click', '#addAccountBtn', function() {
                $.ajax({
                    url: '{{ route('assign') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.scrol-custom').empty().append(data.component);
                        if (data.success) {
                            toastr.success(data.success);
                        } else if (data.error) {
                            toastr.error(data.error);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
    
                startCooldownTimer(60, addAccountBtn, function() {
                    addAccountBtn.text('Neuen Account hinzufügen');
                    addAccountBtn.prop('disabled', false);
                });
    
                addAccountBtn.prop('disabled', true);
            });
    
            $(document).on('click', '#updateAccountBtn', function() {
                $.ajax({
                    url: '{{ route('reload') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.start-chat-area').removeClass('d-none');
                        $('.active-chat').addClass('d-none');
                        $('.list-style').addClass('d-none');
                        $('.scrol-custom').empty().append(data.component);
                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
    
                startCooldownTimer(60, updateAccountBtn, function() {
                    updateAccountBtn.text('Accounts aktualisieren');
                    updateAccountBtn.prop('disabled', false);
                });
    
                updateAccountBtn.prop('disabled', true);
            });
    
            function startCooldownTimer(seconds, button, callback) {
                var countdown = seconds;
    
                var timer = setInterval(function() {
                    if (countdown <= 0) {
                        clearInterval(timer);
                        callback();
                    } else {
                        button.text('Warte auf neues Konto ' + countdown + 's');
                    }
    
                    countdown--;
                }, 1000);
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $(document).on('click', '.list-style', function() {

                $(".list-style").removeClass("active");
                $(".list-style .initials").css('background-color', '');

                $(this).addClass("active");
                $(this).children('.initials').css('background-color', '#10163A');

                $('.chat-btn').removeClass('d-none');

                var spanValue = $(this).find('span').text();
                var refreshToken = $(this).attr('data-refresh');
                var id = $(this).attr('data-id');
                var user_id = $(this).attr('data-user-id');

                $.ajax({
                    type: 'get',
                    url: '{{ route('conversation') }}',
                    data: {
                        id: id,
                        user_id: user_id,
                        refreshToken: refreshToken
                    },
                    success: function(response) {

                        if (response.hasOwnProperty('error')) {

                            $('.start-chat-area').removeClass('d-none');
                            $('.active-chat').addClass('d-none');
                            $('.media-list').empty();
                            $('.chat-btn').addClass('d-none');

                            toastr.error(response.error, '', {
                                onShown: function() {
                                    $('.toast-error').css({
                                        'background-color': 'rgb(163, 23, 23)',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else {
                            $('.start-chat-area').removeClass('d-none');
                            $('.active-chat').addClass('d-none');
                            $('.media-list').empty().append(response.component);
                        }

                    },
                    error: function(error) {

                        toastr.error('An error occurred. Please try again.');
                        console.error(error);
                    }
                });
            });

            $(document).on('click', '.messages', function() {

                $(".messages").removeClass("active");
                $(".messages .initials").css('background-color', '');

                $(this).addClass("active");
                $(this).find('.pr-1 .initials').css('background-color', '#10163A');

                var user_id = $(this).attr('data-user-id');
                var conv_id = $(this).attr('data-conv-id');
                var refreshToken = $(this).attr('data-refresh-token');
                $.ajax({
                    type: 'get',
                    url: '{{ route('messages') }}',
                    data: {
                        user_id: user_id,
                        conv_id: conv_id,
                        refreshToken: refreshToken,
                    },
                    success: function(response) {

                        if (response.hasOwnProperty('error')) {

                            toastr.error(response.error, '', {
                                onShown: function() {
                                    $('.toast-error').css({
                                        'background-color': 'rgb(163, 23, 23)',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else {
                            $('.active-chat').removeClass('d-none');
                            $('.start-chat-area').addClass('d-none');
                            $('.append-chat').empty().append(response.component);
                            $('.buyerInitials').text(response.buyerInitials);
                            $('.buyerName').text(response.buyerName);
                            $('.initials').text(response.buyerInitials);
                            $('.name').text(response.buyerName);
                            $('.price').text(response.adPrice);
                            $('.start-chat-area').attr('data-conv-id', response.conv_id);
                            $('.start-chat-area').attr('data-user-id', response.user_id);
                            $('.start-chat-area').attr('data-refresh-token', response
                                .refreshToken);
                        }

                    },
                    error: function(error) {

                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '.paypal', function() {
            $(this).css('color', 'goldenrod');
            var user_id = $('.start-chat-area').attr('data-user-id');
            var conv_id = $('.start-chat-area').attr('data-conv-id');
            var refreshToken = $('.start-chat-area').attr('data-refresh-token');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ route('upload.payment') }}',
                data: {
                    user_id: user_id,
                    conv_id: conv_id,
                    refreshToken: refreshToken,
                },
                success: function(response) {
                    toastr.success(response.success, '', {
                        onShown: function() {
                            $('.toast-success').css({
                                'background-color': '#4CAF50',
                                'color': '#ffffff'
                            });
                        }
                    });
                },
                error: function(error) {
                    toastr.error(error);
                }
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function(){
            function refresh() {
                if ($('.start-chat-area').hasClass('d-none')) {
                    var user_id = $('.start-chat-area').attr('data-user-id');
                    var conv_id = $('.start-chat-area').attr('data-conv-id');
                    var refreshToken = $('.start-chat-area').attr('data-refresh-token');

                    $.ajax({
                        type: 'get',
                        url: '{{ route('messages') }}',
                        data: {
                            user_id: user_id,
                            conv_id: conv_id,
                            refreshToken: refreshToken,
                        },
                        success: function(response) {
                            // $('.active-chat').removeClass('d-none');
                            // $('.start-chat-area').addClass('d-none');
                            $('.active-chat').empty().append(response.component);
                            // $('.logo').text(response.logo);
                            // $('.name').text(response.name);
                            // $('.start-chat-area').attr('data-conv-id', response.conv_id);
                            // $('.start-chat-area').attr('data-user-id', response.user_id);
                            // $('.start-chat-area').attr('data-refresh-token', response.refreshToken);
                        },
                        error: function(error) {
                            
                            console.error(error);
                        }
                    });
                }
            }
            setInterval(refresh, 10000);
        })
    </script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <script>
        $('#iconLeft4-1').emojioneArea({
            pickerPosition: 'top'
        });
    </script>
@endsection
