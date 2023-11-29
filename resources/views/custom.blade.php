@extends('admin.layouts.master')
@section('title')
    <title>Chat</title>
@endsection
@section('chat')
    active
@endsection
@section('content')
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
            top: 10px;
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
        .emojionearea.emojionearea-inline.emojionearea-button{
            opacity: 0 !important;
            top: 8px !important;
        }
        .emojionearea .emojionearea-button{
            opacity: 0 !important;
            top: 8px !important;
            right: 50px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="content-area-wrapper mt-0">
                <div class="AcountsDetail">
                    <h3>Accounts</h3>
                    @if (Auth::user()->role == 'user')
                        <button class='account-btn1' id='addAccountBtn'>Neuen Account hinzufugen</button>
                        <button class='account-btn2'>Accounts aktualisieren</button>
                    @endif
                    <div class="scrol-custom">
                        <ul>

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
                            <div class="chat-fixed-search">
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
                            </div>
                            <div id="users-list" class="chat-user-list list-group position-relative">
                                <div style='display:flex; justify-content:space-between; align-items:center;'>
                                    <h3 class="primary p-1 mb-0">Chats</h3>
                                    <button class='account-btn2 chat-btn'>Accounts aktualisieren</button>
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
                                <div class="start-chat-area d-none" data-conv-id="" data-user-id="" data-refresh-token="">
                                    <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                                    <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                                </div>
                                <div class="active-chat">
                                    <div class="chat_navbar">
                                        <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                            <div class="vs-con-items d-flex align-items-center">
                                                <div class="sidebar-toggle d-block d-lg-none mr-1"><i
                                                        class="feather icon-menu font-large-1"></i></div>
                                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                    <span class="initials">A</span>
                                                    <span class="avatar-status-busy"></span>
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0">Afaq</h6>
                                                    <p>75€ VB</p>

                                                </span>
                                            </div>
                                            <div>
                                                <span class="favorite"><i
                                                        class="feather icon-home font-medium-5"></i></span>
                                                <span class="favorite"><i
                                                        class="feather icon-star font-medium-5"></i></span>
                                                <span class="favorite"><i
                                                        class="feather icon-trash font-medium-5"></i></span>
                                            </div>
                                        </header>
                                    </div>
                                    <div class="user-chats">
                                        <div class="chats">

                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                        data-placement="right" title="" data-original-title="">
                                                        <span class="initials">B</span>
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content">
                                                        <p>Hello</p>
                                                    </div>
                                                    <span class="time-left">2018-22-10</span>
                                                </div>
                                            </div>

                                            <div class="chat chat-left">
                                                <div class="chat-avatar">
                                                    <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                        data-placement="left" title="" data-original-title="">
                                                        <span class="initials">A</span>
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content">
                                                        <p>Bye</p>
                                                    </div>
                                                    <span class="time-right">2018-22-10</span>
                                                </div>
                                            </div>

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
                                            <button type="button" class="btn btn-primary send"
                                                onclick="enter_chat(); "><i class="fa fa-paper-plane-o"></i> <span
                                                    class="">Senden</span></button>
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
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-chat.js') }}"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <script>
        $('#iconLeft4-1').emojioneArea({
            pickerPosition: 'top'
        });
    </script>




    {{-- <script>
        function enter_chat(source) {
            var message = $(".message").val();
            var refreshToken = $('.new').val();
            var user_id = $('.new').attr('data-user-id');
            var conv_id = $('.new').attr('data-conv-id');

            if (message != "") {
                var now = new Date(); // Get the current date and time
                var timestamp = now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + now
                .getDate()).slice(-2) + ' ' + ('0' + now.getHours()).slice(-2) + ':' + ('0' + now.getMinutes()).slice(-
                    2) + ':' + ('0' + now.getSeconds()).slice(-2);

                var avatarHtml = '<div class="chat-avatar">' +
                    '<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">' +
                    '<span class="initials">B</span>' +
                    '</a>' +
                    '</div>';

                var messageHtml = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
                var timeHtml = '<span class="time-left">' + timestamp + '</span>'; // Display the timestamp

                var combinedHtml = '<div class="chat">' +
                    avatarHtml +
                    '<div class="chat-body">' +
                    messageHtml +
                    timeHtml +
                    '</div>' +
                    '</div>';

                $(".user-chats > .chats").append(combinedHtml);
                $(".message").val("");
                $(".user-chats").scrollTop($(".user-chats > .chats").height());

                
            }
        }
    </script> --}}
    <script>
        // Function to trigger image input click
        function selectImage() {
            document.getElementById('imageInput').click();
        }

        // Function to handle image preview
        function previewImage() {
            var input = document.getElementById('imageInput');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imageUrl = e.target.result;
                    // You can use imageUrl to display the image preview or send it to the server
                    console.log("Selected Image URL:", imageUrl);

                    // Add the image URL to the message input
                    $(".message").val(imageUrl);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function enter_chat() {
            var content = $(".message").val();
            var refreshToken = $('.new').val();
            var user_id = $('.new').attr('data-user-id');
            var conv_id = $('.new').attr('data-conv-id');

            if (content !== "") {
                var now = new Date();
                var timestamp = now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + now
                        .getDate()).slice(-2) + ' ' + ('0' + now.getHours()).slice(-2) + ':' + ('0' + now.getMinutes())
                    .slice(-
                        2) + ':' + ('0' + now.getSeconds()).slice(-2);

                var avatarHtml = '<div class="chat-avatar">' +
                    '<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">' +
                    '<span class="initials">X</span>' +
                    '</a>' +
                    '</div>';

                var contentHtml;
                if (content.startsWith('data:image/')) {
                    // If the content starts with 'data:image/', treat it as an image
                    contentHtml = '<div class="chat-content">' + '<img src="' + content + '" alt="image">' + '</div>';
                } else {
                    // Otherwise, treat it as a text message
                    contentHtml = '<div class="chat-content">' + '<p>' + content + '</p>' + '</div>';
                }

                var timeHtml = '<span class="time-left">' + timestamp + '</span>';

                var combinedHtml = '<div class="chat">' +
                    avatarHtml +
                    '<div class="chat-body">' +
                    contentHtml +
                    timeHtml +
                    '</div>' +
                    '</div>';

                $(".user-chats > .chats").append(combinedHtml);
                $(".message").val("");
                $(".user-chats").scrollTop($(".user-chats > .chats").height());
            }
        }
    </script>
@endsection
