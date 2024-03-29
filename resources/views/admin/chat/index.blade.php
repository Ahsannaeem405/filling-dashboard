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
            .account-btn1 {
                margin: 1px 10px;
                border: none;
                outline: none;
                color: white;
                background: #27ce72;
                border-radius: 5px;
                padding: 6px;
                font-size: 11px;
                width: 87px;
                margin-bottom: 20px;
            }
        </style>
    @else
        <style>
            .account-btn1 {
                margin: 1px 1px;
                border: none;
                outline: none;
                color: white;
                background: #27ce72;
                border-radius: 5px;
                padding: 6px;
                font-size: 11px;
                width: 87px;
                margin-bottom: 20px;
            }
        </style>
    @endif
    <style>
        .chat-application .chat-app-window .start-chat-area {
            height: calc(var(--vh, 1vh) * 100 - 5.5rem) !important;
        }

        .chat-application .sidebar-content .chat-user-list {
            width: 330px !important;
        }

        .chat-application .sidebar-content {
            width: 330px !important;
        }

        html body .content.app-content .content-area-wrapper {
            height: calc(100% - 2rem);
            overflow: hidden;
        }

        .chat-application .sidebar-content {
            height: calc(var(--vh, 1vh) * 100 - 6.5rem) !important;
        }

        .chat-application .chat-app-window .start-chat-area {
            height: calc(var(--vh, 1vh) * 100 - 5.5rem) !important;
        }

        .chat-application .chat-app-window .user-chats {
            height: calc(var(--vh, 1vh) * 100 - 20rem) !important;
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
            width: 46px;
            height: 46px;
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

        .account-btn2 {
            margin: 1px 1px;
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

        .account-btn3 {
            margin: 1px 10px;
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
            cursor: pointer;
        }

        img.type-icon {
            width: 22px;
            right: 45px;
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
            position: absolute !important;
            right: 50px !important;
            top: 6px !important;
            opacity: 0 !important;
        }

        .chat-application .sidebar-content .chat-user-list {
            margin-top: 0 !important;
            height: calc(100% - 0rem);
        }

        .chat-application .sidebar-content .chat-user-list li .contact-info {
            width: calc(100vw - (100vw - 100%) - 1rem - -10px);
        }

        .emojionearea .emojionearea-picker.emojionearea-picker-position-top {
            right: 32px !important;
        }

        .favorite-1 {
            margin: 7px;
            cursor: pointer;
        }

        .custom-success-toast {
            background-color: #4CAF50;
            color: #ffffff;
        }

        .custom-warning-toast {
            background-color: rgb(163, 23, 23);
            color: #ffffff;
        }

        .avatar-status-busy {
            width: 13px !important;
            height: 13px !important;
            bottom: -5px !important;
        }

        .avatar-status-online {
            width: 13px !important;
            height: 13px !important;
            bottom: -5px !important;
        }

        .adImage {
            border-radius: 50%;
            width: 46px;
            height: 46px;
            margin-right: 6px;
        }

        body.dark-layout .avatar {
            background-color: transparent !important;
        }

        .ellipsis {
            width: 100px;
            margin-right: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media screen and (max-device-width:768px),
        screen and (max-width:991px) {
            html body .content.app-content .content-area-wrapper {
                height: calc(100% - 0rem);
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .chat-application .sidebar-content {
                -webkit-transform: translateX(0%);
                -ms-transform: translateX(0%);
                transform: translateX(0%);
                width: 100% !important;
            }

            .AcountsDetail,
            .chat-application .sidebar-content .chat-user-list {
                width: 100% !important;
            }

            .chat-application .chat-app-window .user-chats {
                height: calc(var(--vh, 1vh) * 100 - 20rem) !important;
            }
        }

        @media screen and (max-device-width:300px),
        screen and (max-width:768px) {
            .chat-application .sidebar-content {
                -webkit-transform: translateX(0%);
                -ms-transform: translateX(0%);
                transform: translateX(0%);
                width: 100% !important;
            }

            .AcountsDetail,
            .chat-application .sidebar-content .chat-user-list {
                width: 100% !important;
            }

            html body .content.app-content .content-area-wrapper {
                height: calc(100% - 0rem);
                display: grid;
                grid-template: none;
            }

            .chat-application .chat-app-window .user-chats {
                height: calc(var(--vh, 1vh) * 100 - 20rem) !important;
            }

            .special_class {
                display: none;
            }

            .chat-application .sidebar-content .chat-user-list ul {
                max-height: 170px;
                overflow-y: scroll;
            }

            .chat-application .sidebar-content {
                height: calc(var(--vh, 1vh) * 100 - 15.5rem) !important;
            }
        }

        .time-right {
            font-size: 12px;
            margin-top: 12px;
            position: absolute;
        }

        .time-left {
            font-size: 12px;
            margin-top: 12px;
            position: absolute;
            right: 95px
        }

        .time-left-append {
            font-size: 12px;
            margin-top: 45px;
            position: absolute;
            right: 95px;
        }

        .chat {
            margin-top: 20px
        }

        .chat-application .chat-app-form {
            padding: 18px 10px !important;
        }

        .chat-app-form {
            height: 100%;
            min-height: 10rem;
            max-height: 10rem;
        }

        .emojionearea .emojionearea-editor {
            min-height: 2em;
            max-height: 4em;
            width: 19em;
        }

        .emojionearea-editor::-webkit-scrollbar {
            width: 0px !important;
        }

        .fa-rectangle-ad {
            color: #C2C6DC;
        }

        .emojionearea,
        .emojionearea.form-control {
            height: 60px !important;
        }

        .emojionearea-editor {
            color: white !important;
        }

        .emojionearea::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            /* Color for the scrollbar track */
        }

        /* Scrollbar Handle */
        .emojionearea::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Color for the scrollbar handle */
            border-radius: 5px;
            /* Round corners for the scrollbar handle */
        }

        /* Optional: Increase width/thickness of scrollbar */
        .emojionearea::-webkit-scrollbar {
            width: 5px;
            /* Set scrollbar width */
        }

        .user-chat-info .contact-info h5.font-weight-bold.mb-0 {
            max-width: 160px;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        @media screen and (min-width: 1143px) {
            .user-chat-info .contact-info h5.font-weight-bold.mb-0 {
                width: 100px;
            }

            .ellipsis {
                width: 100px;
                /* Change this width value to whatever is appropriate for your design */
            }

            .buyerName {
                width: 100px;
            }
        }

        @media screen and (min-width: 1319px) {
            .ellipsis {
                width: 240px;
                /* Change this width value to whatever is appropriate for your design */
            }

            .user-chat-info .contact-info h5.font-weight-bold.mb-0 {
                width: 160px;
            }

            .buyerName {
                width: 160px;
            }
        }

        @media screen and (min-width: 1635px) {
            .user-chat-info .contact-info h5.font-weight-bold.mb-0 {
                width: 230px;
            }

            .ellipsis {
                width: 160px;
                /* Change this width value to whatever is appropriate for your design */
            }

            .buyerName {
                width: 350px;
            }
        }

        @media screen and (min-width: 2266px) {
            .ellipsis {
                width: 600px;
                /* Change this width value to whatever is appropriate for your design */
            }

            .buyerName {
                width: 600px;
            }
        }

        body {
            overflow: hidden;
        }

        footer {
            display: none;
        }

        .unread-chat {
            border-radius: 50%;
            background-color: rgb(218, 32, 32);
            color: black;
            height: 20px;
            width: 20px;
            text-align: center;
        }

        .chat-application .user-profile-sidebar {
            border-right: unset !important;
        }

        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Add a class to apply a blur effect */
        .blur {
            filter: blur(5px);
        }

        /* CSS for the loader */
        .btn-loader {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #3498db;
            border-radius: 50%;
            margin-left: 25px;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: block;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

    <div class="row load">
        <div class="col-md-12">
            <div class="content-area-wrapper mt-0">
                <div class="AcountsDetail">

                    @if (Auth::user()->role == 'user')
                        <h3>Accounts</h3>
                        <div class="d-flex" style="justify-content: space-between">
                        @else
                            <div class="d-flex" style="justify-content: space-between">
                                <h3 class="mr-1">Accounts</h3>
                    @endif

                    @if (Auth::user()->role == 'user')
                        <button class='account-btn1' id='addAccountBtn'>Neuen Account hinzufugen</button>
                    @endif

                    <button class='account-btn2' id='updateAccountBtn'>Accounts aktualisieren</button>
                    <button class='account-btn3' id='deleteAccountBtn'>Invalid Accounts löschen</button>
                </div>
                
                <div class="scrol-custom">
                    <ul style="margin-bottom: 80px">
                        @if (isset($accounts))
                            @foreach ($accounts as $account)
                                <li class="list-style ToggleBtn" data-id="{{ $account->id }}">
                                    <div class="avatar  mr-1">
                                        @if ($account->adPic)
                                            <img class="adPic" src="{{ $account->adPic }}" alt="">
                                        @else
                                            <span class="initials"
                                                style="height: 50px; width:50px; color:white">{{ Str::ucfirst(mb_substr($account->adTitle, 0, 1)) }}</span>
                                        @endif
                                        @if ($account->imap == '1')
                                            <p class="avatar-status-busy intent" style="background: goldenrod"></p>
                                        @elseif($account->adStatus == 'ACTIVE')
                                            <p class="avatar-status-online intent"></p>                                            
                                        @else
                                            <p class="avatar-status-busy intent"></p>
                                        @endif
                                    </div>
                                    <div class="user-chat-info new-user d-flex">
                                        <div class="contact-info">
                                            <div style="display: flex; justify-content:space-between">
                                                <h5 class="font-weight-bold mb-0 ellipsis">{{ $account->adTitle }}
                                                    &nbsp;&nbsp;&nbsp;
                                                </h5>
                                                <p style="margin-bottom: 0px">
                                                    {{ \Carbon\Carbon::parse($account->reloadDate)->format('d.m.y') }}
                                                </p>
                                            </div>
                                            <div style="display: flex; justify-content:space-between">
                                                <p class="truncate" style="max-width:75%">{{ $account->adPrice }} €</p>

                                                <p class="unread-chat {{ $account->unRead() == 0 ? 'd-none' : '' }}"
                                                    data-account-id="{{ $account->account_id }}">{{ $account->unRead() }}
                                                </p>
                                            </div>
                                        </div>
                                        @if (Auth::user()->role == 'user')
                                            @if ($account->adStatus == 'ACTIVE')
                                                <div class="float-right ml-2"><i class="fa fa-rotate-right"
                                                        id="{{ $account->id }}"></i></div>
                                            @else
                                                <div class="float-right ml-2"><i class="fa fa-xmark"
                                                        id="{{ $account->id }}"></i></div>
                                            @endif
                                        @endif
                                    </div>
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
                        <div id="users-list" class="chat-user-list list-group position-relative">
                            <div style='display:flex; justify-content:space-between; align-items:center;position:relative;'>
                                <i class="feather icon-arrow-left BackArr"
                                    style="position: absolute;top: 0px;left: 0;background-color: #ddd;border-radius: 3px;padding: 2px; display:none"></i>
                                <h3 class="primary p-1 mb-0">Chats</h3>
                                {{-- <button class='account-btn2 chat-btn d-none'>Chats aktualisieren</button> --}}
                            </div>
                            <ul class="chat-users-list-wrapper media-list" style="margin-bottom: 30px">

                            </ul>
                            <div class="custom-img" style="margin-top:150px">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset('app-assets/images/logo/Logo-main.png') }}" width="100px">
                                </div>
                                <span style="display: flex; justify-content: center; align-items: center;">keine nachrichten
                                    wiederfinden</span>
                            </div>
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
                            <div class="start-chat-area" data-conv-id="" data-id="">
                                <span class="mb-2"><img src="{{ asset('app-assets/images/logo/Logo-main.png') }}"
                                        width="100px"></span>
                            </div>
                            <div class="active-chat">
                                <div class="chat_navbar">
                                    <header class="chat_header d-grid p-1">
                                        <div class="vs-con-items d-flex align-items-center justify-content-between">
                                            <div class="sidebar-toggle d-lg-none mr-1 d-none"><i
                                                    class="feather icon-menu font-large-1"></i></div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar user-profile-toggle m-0 m-0">
                                                    <div class="new"></div>
                                                    <img class="adImage buyerInitials" src="" alt="">
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0 buyerName"
                                                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    </h6>
                                                    <p><span class="price"></span> € VB</p>
                                                </span>
                                            </div>
                                            <div class="">
                                                <span class="favorite-1 link-id" data-id="">
                                                    <a href="" target="_blank"
                                                        class="fa-solid fa-rectangle-ad font-medium-5"></a>
                                                </span>
                                                <span class="favorite-1 paypal" data-id=""><i
                                                        class="fa-brands fa-paypal font-medium-5"></i></span>
                                                <span class="favorite-1 bank" data-id=""><i
                                                        class="fa-solid fa-building-columns font-medium-5"></i></span>
                                                <span class="favorite-1 delete-chat"><i
                                                        class="fa-regular fa-trash-can font-medium-5"></i></span>
                                            </div>
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
                                            <textarea class="form-control message mr-1 ml-50 msg" id="iconLeft4-1" placeholder="Sende eine Nachricht"></textarea>
                                            {{-- <input type="text" class="form-control message mr-1 ml-50 msg"
                                                                                            id="iconLeft4-1" placeholder="Sende eine Nachricht"> --}}
                                            <i class="type-icon fa fa-image " onclick="selectImage()"></i>
                                            <img class='type-icon' src="{{ asset('app-assets/images/logo/face.png') }}"
                                                alt="user_avatar" for="emojionearea-button">
                                        </div>
                                        <button type="button" class="btn btn-primary send" onclick="enter_chat();"
                                            style="height: 33px"><i class="fa fa-paper-plane-o"></i>
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
                                        <img class="adImage pop-up-initials" src="" alt=""
                                            width="35px">
                                    </div>
                                    <h4 class="chat-user-name pop-up-name" style="width:300px"></h4>
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

    <!-- User Chat profile right area -->
    <div class="user-profile-sidebar" style="background-color: #10163A">
        <header class="user-profile-header">
            <span class="close-icon">
                <i class="feather icon-x"></i>
            </span>
            <div class="header-profile-sidebar">
                <div class="avatar">
                    <div class="new"></div>
                    <img class="adImage pop-up-initials" src="" alt="" width="35px">
                </div>
                <h4 class="chat-user-name pop-up-name" style="width:300px"></h4>
            </div>
        </header>
        <div class="user-profile-sidebar-area p-2">

        </div>
    </div>
    <!--/ User Chat profile right area -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to add class based on screen size
            function addClassBasedOnSize() {
                var screenWidth = $(window).width();

                if (screenWidth >= 300 && screenWidth <= 768) {
                    $('.sidebar-left, .content-right').addClass('special_class');
                } else {
                    $('.sidebar-left, .content-right').removeClass('special_class');
                }
            }

            // Function to handle click event
            $(document).on('click', '.ToggleBtn', function() {
                var screenWidth = $(window).width();

                if (screenWidth >= 300 && screenWidth <= 768) {
                    $('.special_class').css('display', 'block');
                    $('.AcountsDetail').css('display', 'none');
                } else {
                    $('.special_class').css('display', 'none');
                    $('.AcountsDetail').css('display', 'block');
                }
            });
            $(document).on('click', '.BackArr', function() {
                var screenWidth = $(window).width();

                if (screenWidth >= 300 && screenWidth <= 768) {
                    $('.special_class').css('display', 'none');
                    $('.AcountsDetail').css('display', 'block');
                } else {
                    $('.special_class').css('display', 'block');
                    $('.AcountsDetail').css('display', 'none');
                }
            });

            // Call the function on document ready and on window resize
            addClassBasedOnSize();
            $(window).resize(addClassBasedOnSize);
        });
    </script>
    <script>
        $(document).ready(function() {

            var userRole = '{{ Auth::user()->role }}';

            var addAccountBtn = $('#addAccountBtn');
            var updateAccountBtn = $('#updateAccountBtn');
            var dltBtn = $('#deleteAccountBtn');

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
                var text = $(this).text();
                var containsNumber = /\d/.test(text);
                if (containsNumber) {
                    return;
                }
                if (userRole !== 'admin') {
                    localStorage.setItem('countdown', new Date(Date.now() + 60000).toISOString());

                    startCooldownTimer(60, addAccountBtn, function() {
                        addAccountBtn.text('Neuen Account hinzufügen');
                        addAccountBtn.prop('disabled', false);
                        localStorage.removeItem('countdown');
                    });

                    addAccountBtn.prop('disabled', true);
                }

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

                // startCooldownTimer(60, addAccountBtn, function() {
                //     addAccountBtn.text('Neuen Account hinzufügen');
                //     addAccountBtn.prop('disabled', false);
                //     localStorage.removeItem('countdown');
                // });

                // addAccountBtn.prop('disabled', true);
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
                var text = $(this).text();
                var containsNumber = /\d/.test(text);

                updateAccountBtn.text(''); // Remove text from the button
                updateAccountBtn.append('<span class="btn-loader"></span>');
                
                if (containsNumber) {
                    return;
                }
                if (userRole !== 'admin') {
                    localStorage.setItem('countdown2', new Date(Date.now() + 60000).toISOString());

                    startCooldownTimer(60, updateAccountBtn, function() {
                        updateAccountBtn.text('Accounts aktualisieren');
                        updateAccountBtn.prop('disabled', false);
                        localStorage.removeItem('countdown2');
                    });

                    updateAccountBtn.prop('disabled', true);
                    
                }

                $.ajax({
                    url: '{{ route('reload') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.scrol-custom').empty().append(data.component);
                        $('.start-chat-area').removeClass('d-none');
                        $('.custom-img').removeClass('d-none');
                        // $('.list-style').addClass('d-none');
                        $('.media-list').empty();
                        // $('.chat-btn').addClass('d-none');
                        updateAccountBtn.find('.btn-loader').hide();
                        updateAccountBtn.text('Accounts aktualisieren');
                    },
                    error: function(error) {
                        console.error(error);
                        updateAccountBtn.find('.btn-loader').hide();
                        updateAccountBtn.text('Accounts aktualisieren');
                    },
                });
                // startCooldownTimer(60, updateAccountBtn, function() {
                //     updateAccountBtn.text('Accounts aktualisieren');
                //     updateAccountBtn.prop('disabled', false);
                //     localStorage.removeItem('countdown2');
                // });
                // updateAccountBtn.prop('disabled', true);
            });

            var storedCountdown4 = localStorage.getItem('countdown4');
            if (storedCountdown4 && new Date(storedCountdown4) > new Date()) {
                var remainingSeconds = Math.floor((new Date(storedCountdown4) - new Date()) / 1000);
                startCooldownTimer(remainingSeconds, dltBtn, function() {
                    dltBtn.text('Invalid Accounts löschen');
                    dltBtn.prop('disabled', false);
                    localStorage.removeItem('countdown4');
                });
                dltBtn.prop('disabled', true);
            }

            $(document).on('click', '#deleteAccountBtn', function() {
                var text = $(this).text();
                var containsNumber = /\d/.test(text);
                if (containsNumber) {
                    return;
                }
                if (userRole !== 'admin') {
                    localStorage.setItem('countdown4', new Date(Date.now() + 60000).toISOString());

                    startCooldownTimer(60, dltBtn, function() {
                        dltBtn.text('Invalid Accounts löschen');
                        dltBtn.prop('disabled', false);
                        localStorage.removeItem('countdown4');
                    });

                    dltBtn.prop('disabled', true);
                }

                $.ajax({
                    type: 'get',
                    url: '{{ route('delete.inactive') }}',
                    success: function(response) {
                        if (response.success) {
                            $('.media-list').empty();
                            $('.start-chat-area').removeClass('d-none');
                            $('.custom-img').removeClass('d-none');
                            $('.scrol-custom').empty().append(response.component);
                            toastr.success(response.success, '', {
                                onShown: function() {
                                    $('.toast-success').css({
                                        'background-color': '#4CAF50',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else if (response.error) {
                            toastr.error(response.error, '', {
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
                    }
                });

                // startCooldownTimer(60, dltBtn, function() {
                //     dltBtn.text('Invalid Accounts löschen');
                //     dltBtn.prop('disabled', false);
                //     localStorage.removeItem('countdown4');
                // });

                // dltBtn.prop('disabled', true);
            });

            function startCooldownTimer(seconds, button, callback) {
                var countdown = seconds;

                var timer = setInterval(function() {
                    if (countdown <= 0) {
                        clearInterval(timer);
                        callback();
                    } else {
                        var text = button.text();
                        var updatedText = text.replace(/\d+s\s*/, '');
                        button.text(updatedText + ' ' + countdown + 's');
                    }
                    countdown--;
                }, 1000);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.list-style', function() {

                if ($(event.target).hasClass('fa-xmark')) {
                    Swal.fire({
                        title: 'Bist du sicher?',
                        text: 'Sie können dies nicht rückgängig machen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Stornieren',
                        confirmButtonText: 'Ja, weiter!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = $(this).attr('data-id');
                            handleXMarkClick(id);
                        }
                    });


                } else if ($(event.target).hasClass('fa-rotate-right')) {
                    Swal.fire({
                        title: 'Bist du sicher?',
                        text: 'Sie können dies nicht rückgängig machen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Stornieren',
                        confirmButtonText: 'Ja, weiter!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = $(this).attr('data-id');
                            handleRotate(id);
                        }
                    });


                } else {

                    $('body').append('<span class="loader"></span>');
                    $('.load').addClass('blur');
                    
                    $(".list-style").removeClass("active");
                    $(".list-style .initials").css('background-color', '');

                    var intent = $(this).find('.intent');
                    
                    $(this).addClass("active");
                    $(this).find('.initials').css('background-color', '#10163A');

                    if ($(this).find('.initials').length > 0) {

                        var text = $(this).find('.initials').text();
                        $('.adImage.buyerInitials').remove();
                        $('.adImage.pop-up-initials').remove();

                        $('.new').empty().append(
                            '<span class="initials" style="height: 45px; width: 45px; margin-right:10px; color:white">' +
                            text +
                            '</span>');
                    }
                    var spanValue = $(this).find('span').text();
                    var id = $(this).attr('data-id');

                    $.ajax({
                        type: 'get',
                        url: '{{ route('conversation') }}',
                        data: {
                            id: id,
                        },
                        success: function(response) {

                            if (response.hasOwnProperty('error')) {

                                $('.start-chat-area').removeClass('d-none');
                                $('.active-chat').addClass('d-none');
                                $('.media-list').empty();
                                $('.custom-img').removeClass('d-none');
                                // $('.chat-btn').addClass('d-none');

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
                                $('.custom-img').addClass('d-none');
                                $('.media-list').empty().append(response.component);
                                if(response.imap == '1'){
                                    intent.css('background-color','goldenrod');
                                }else{
                                    if(response.status == 'ACTIVE'){
                                        intent.css('background-color','#28c76f');
                                    }else{
                                        intent.css('background-color','#ea5455');
                                    }
                                }

                            }
                            $('.loader').remove();
                            $('.load').removeClass('blur');

                        },
                        error: function(error) {

                            toastr.error('An error occurred. Please try again.');
                            console.error(error);
                            
                            $('.loader').remove();
                            $('.load').removeClass('blur');
                        }
                    });
                }
            });

            function handleXMarkClick(id) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.delete.accounts') }}',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('.media-list').empty();
                        $('.start-chat-area').removeClass('d-none');
                        $('.custom-img').removeClass('d-none');
                        $('.scrol-custom').empty().append(response.component);

                        if (response.success) {
                            toastr.success(response.success, '', {
                                onShown: function() {
                                    $('.toast-success').css({
                                        'background-color': '#4CAF50',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else if (response.error) {
                            toastr.error(response.error, '', {
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
                    }
                });
            }

            function handleRotate(id) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('re.assign') }}',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('.media-list').empty();
                        $('.start-chat-area').removeClass('d-none');
                        $('.custom-img').removeClass('d-none');
                        $('.scrol-custom').empty().append(response.component);

                        if (response.success) {
                            toastr.success(response.success, '', {
                                onShown: function() {
                                    $('.toast-success').css({
                                        'background-color': '#4CAF50',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else if (response.error) {
                            toastr.error(response.error, '', {
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
                    }
                });
            }
            $(document).on('click', '.messages', function() {
                $(".messages").removeClass("active");
                $(".messages .initials").css('background-color', '');

                $(this).addClass("active");
                $(this).find('.pr-1 .initials').css('background-color', '#10163A');
                var msg = $(this).find('.unread-msg');

                var id = $(this).attr('data-id');

                var conv_id = $(this).attr('data-conv-id');
                // var chatContainer = $('.append-chat')[0];
                $('.ps__rail-y').css({
                    'top': '0px',
                    'height': '0px',
                    'right': '0px'
                });
                $.ajax({
                    type: 'get',
                    url: '{{ route('messages') }}',
                    data: {
                        id: id,
                        conv_id: conv_id,
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
                            msg.addClass('d-none');
                            $('.active-chat').removeClass('d-none');
                            $('.start-chat-area').addClass('d-none');
                            $('.append-chat').empty().append(response.component);
                            $('.buyerInitials').attr('src', response.adImage);
                            $('.fa-rectangle-ad').attr('href', response.adLink);
                            $('.link-id').attr('data-id', response.client_id);
                            $('.buyerName').text(response.adTitle);
                            $('.pop-up-initials').attr('src', response.adImage);
                            $('.pop-up-name').text(response.adTitle);
                            $('.price').text(response.adPrice);
                            $('.paypal').attr('data-id', response.client_id);
                            $('.bank').attr('data-id', response.client_id);
                            $('.start-chat-area').attr('data-conv-id', response.conv_id);
                            $('.start-chat-area').attr('data-id', response.account_id);
                            if (response.paypal == true) {
                                $('.paypal').css('color', 'goldenrod');
                            } else {
                                $('.paypal').css('color', '');
                            }
                            if (response.bank == true) {
                                $('.bank').css('color', 'goldenrod');
                            } else {
                                $('.bank').css('color', '');
                            }
                            setTimeout(function() {
                                var chatContainer = $('.user-chats')[0];
                                chatContainer.scrollTop = chatContainer.scrollHeight;
                            }, 100);
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
            $('.bank').css('color', '');
            var method = 'paypal';
            var currentColor = $(this).css('color');
            if (currentColor === 'rgb(218, 165, 32)') {
                deletePaymentEntry();
                $(this).css('color', '');
            } else {
                uploadPayment(method);
                $(this).css('color', 'goldenrod');
            }
        });
        $(document).on('click', '.bank', function() {
            $('.paypal').css('color', '');
            var method = 'bank';
            var currentColor = $(this).css('color');
            if (currentColor === 'rgb(218, 165, 32)') {
                deletePaymentEntry();
                $(this).css('color', '');
            } else {
                uploadPayment(method);
                $(this).css('color', 'goldenrod');
            }
        });

        function uploadPayment(method) {
            var id = $('.start-chat-area').attr('data-id');
            var conv_id = $('.start-chat-area').attr('data-conv-id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: '{{ route('upload.payment') }}',
                data: {
                    id: id,
                    method: method,
                    conv_id: conv_id
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success, '', {
                            onShown: function() {
                                $('.toast-success').css({
                                    'background-color': '#4CAF50',
                                    'color': '#ffffff'
                                });
                            }
                        });
                    } else if (response.error) {
                        toastr.error(response.error, '', {
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
                    toastr.error(error);
                }
            });
        }

        function deletePaymentEntry() {
            var id = $('.paypal').attr('data-id');
            $.ajax({
                type: 'get',
                url: '{{ route('remove.payment') }}',
                data: {
                    conv_id: id
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success, '', {
                            onShown: function() {
                                $('.toast-success').css({
                                    'background-color': '#4CAF50',
                                    'color': '#ffffff'
                                });
                            }
                        });
                    } else if (response.error) {
                        toastr.error(response.error, '', {
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
                    toastr.error(error);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            function refresh() {
                if ($('.start-chat-area').hasClass('d-none')) {
                    var id = $('.start-chat-area').attr('data-id');
                    var conv_id = $('.start-chat-area').attr('data-conv-id');

                    $.ajax({
                        type: 'get',
                        url: '{{ route('messages') }}',
                        data: {
                            conv_id: conv_id,
                            id: id,
                        },
                        success: function(response) {
                            $('.append-chat').empty().append(response.component);
                            setTimeout(function() {
                                var chatContainer = $('.user-chats')[0];
                                chatContainer.scrollTop = chatContainer.scrollHeight;
                            }, 100);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            }

            function deletePaymentEntry() {
                var id = $('.paypal').attr('data-id');
                $.ajax({
                    type: 'get',
                    url: '{{ route('remove.payment') }}',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success, '', {
                                onShown: function() {
                                    $('.toast-success').css({
                                        'background-color': '#4CAF50',
                                        'color': '#ffffff'
                                    });
                                }
                            });
                        } else if (response.error) {
                            toastr.error(response.error, '', {
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
                        toastr.error(error);
                    }
                });
            }
        });
    </script>
    <script>
        $(document).on('click', '.delete-chat', function() {
            var id = $('.start-chat-area').attr('data-id');
            var conv_id = $('.start-chat-area').attr('data-conv-id');
            $.ajax({
                type: 'get',
                url: '{{ route('delete.conversation') }}',
                data: {
                    conv_id: conv_id,
                    id: id,
                },
                success: function(response) {

                    if (response.success) {
                        toastr.success(response.success, '', {
                            onShown: function() {
                                $('.toast-success').css({
                                    'background-color': '#4CAF50',
                                    'color': '#ffffff'
                                });
                            }
                        });
                        $('.start-chat-area').removeClass('d-none');
                        $('.active-chat').addClass('d-none');
                        $('.append-chat').empty();
                        $('.media-list').empty().append(response.component);

                    } else if (response.error) {
                        toastr.error(response.error, '', {
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
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            function refresh() {
                if ($('.start-chat-area').hasClass('d-none')) {
                    var id = $('.start-chat-area').attr('data-id');
                    var conv_id = $('.start-chat-area').attr('data-conv-id');

                    $.ajax({
                        type: 'get',
                        url: '{{ route('messages') }}',
                        data: {
                            conv_id: conv_id,
                            id: id,
                        },
                        success: function(response) {
                            $('.append-chat').empty().append(response.component);
                            setTimeout(function() {
                                var chatContainer = $('.user-chats')[0];
                                chatContainer.scrollTop = chatContainer.scrollHeight;
                            }, 100);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            }
            setInterval(function() {
                // refresh();
            }, 8000);
        })
    </script>
@endsection
