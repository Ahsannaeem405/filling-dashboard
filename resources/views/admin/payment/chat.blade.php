@extends('admin.layouts.master')

@section('title')
    <title>Chat</title>
@endsection

@section('chat')
    active
@endsection

@section('content')
    <style>
        html body .content.app-content .content-area-wrapper {
            height: calc(100% - 0rem);
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

        .initials {
            background-color: #8a82dd75;
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

        .time-right {
            font-size: 12px;
            margin-top: 11px;
            position: absolute;
        }

        .time-left {
            font-size: 12px;
            margin-top: 11px;
            position: absolute;
            right: 95px
        }

        .time-left-append {
            font-size: 12px;
            margin-top: 43px;
            position: absolute;
            right: 95px;
        }

        .chat-application .chat-app-window .user-chats {
            height: calc(var(--vh, 1vh) * 100 - 22.8rem) !important;
        }

        .content-right {
            width: calc(100vw - (100vw - 100%) - 0px) !important;
            float: right;
        }

        .fa-arrow-left {
            color: white;
            cursor: pointer;
            font-size: 22px;
        }

        .send {
            display: flex;
            width: 25%;
            padding: 5px !important;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .type-icon {
            position: absolute;
            right: 1%;
            top: 7px;
            cursor: pointer;
        }

        img.type-icon {
            width: 22px;
            right: 45px;
        }

        .fa-image:before {
            content: "\f03e";
            font-size: 20px;
            color: #C2C6DC;
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

        .emojionearea .emojionearea-picker.emojionearea-picker-position-top {
            right: 32px !important;
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
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="content-area-wrapper mt-0">
                <div class="content-right">
                    <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                        <div class="content-body">
                            <div class="chat-overlay"></div>
                            <section class="chat-app-window">
                                <div class="active-chat">
                                    <div class="chat_navbar">
                                        <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                            <div class="vs-con-items d-flex align-items-center">
                                                <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                    <i class="feather icon-menu font-large-1"></i>
                                                </div>
                                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                    <span
                                                        class="initials buyerInitials">{{ substr($payment->client_name, 0, 1) }}</span>
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0 buyerName">{{ $payment->client_name }}</h6>
                                                    <p><span class="price">{{ $payment->price }}</span> € VB</p>
                                                </span>
                                            </div>
                                            <a href="{{ route('payment') }}"><i class="fa fa-arrow-left"></i></a>
                                        </header>
                                    </div>
                                    <div class="user-chats">
                                        <div class="chats append-chat">
                                            @foreach ($chatMessages as $chat)
                                                @php
                                                    $carbonDate = \Carbon\Carbon::parse($chat['receivedDate']);
                                                @endphp

                                                @if ($chat['boundness'] === 'OUTBOUND')
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                data-placement="right" title=""
                                                                data-original-title="">
                                                                <span
                                                                    class="initials">{{ substr($payment->seller_name, 0, 1) }}</span>
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <p>{{ $chat['textShort'] }}</p>
                                                                <p>
                                                                    <span
                                                                        class="time-left">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($chat['boundness'] === 'INBOUND')
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                data-placement="left" title="" data-original-title="">
                                                                <span
                                                                    class="initials">{{ substr($payment->client_name, 0, 1) }}</span>
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <p>{{ $chat['textShort'] }}</p>
                                                                <p>
                                                                    <span
                                                                        class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="chat-app-form">
                                        <form class="chat-app-input d-flex justify-content-between position-relative"
                                            onsubmit="enter_chat();" id="myform" action="javascript:void(0);">
                                            <div class='position-relative'style='width: 70%;'>
                                                <input type="text" class="form-control message mr-1 ml-50 msg"
                                                    id="iconLeft4-1" placeholder="Sende eine Nachricht">
                                                <i class="type-icon fa fa-image" onclick="selectImage()"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" class="new" value="{{ $refreshToken }}" data-user-id="{{ $data['userIdSeller'] }}"
        data-conv-id="{{ $data['id'] }}">
    <input type="file" id="imageInput" style="display:none" accept="image/jpeg">

    <script>
        function selectImage() {
            $('#imageInput').val('');
            $('#imageInput').click();
        }

        $('#imageInput').on('change', function() {
            var file = this.files[0];
            if (file) {
                var image = file;
                enter_chat(image);
            }
            $(this).val('');
        });

        function enter_chat(image) {
            var message = $(".message").val();
            var refreshToken = $('.new').val();
            var user_id = $('.new').attr('data-user-id');
            var conv_id = $('.new').attr('data-conv-id');

            var formData = new FormData();

            formData.append('image', image);
            formData.append('message', message);
            formData.append('refreshToken', refreshToken);
            formData.append('user_id', user_id);
            formData.append('conv_id', conv_id);

            if (message != "") {
                $(".emojionearea-editor").empty();

                var now = new Date();
                var timestamp =
                    ('0' + now.getDate()).slice(-2) + '.' +
                    ('0' + (now.getMonth() + 1)).slice(-2) + '.' +
                    ('' + now.getFullYear()).slice(-2) + ', ' +
                    ('0' + now.getHours()).slice(-2) + ':' +
                    ('0' + now.getMinutes()).slice(-2);

                var avatarHtml = '<div class="chat-avatar">' +
                    '<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">' +
                    '<span class="initials">{{ $data['sellerInitials'] }}</span>' +
                    '</a>' +
                    '</div>';


                var timeHtml = '<span class="time-left">' + timestamp + '</span>';

                var imageHtml = image ? '<img src="' + URL.createObjectURL(image) +
                    '" width="185px" class="selected-image">' : '';

                var messageHtml = '<div class="chat-content">' +
                    "<p>" + message + "</p>" +
                    imageHtml +
                    "<p>" + timeHtml + "</p>" +
                    "</div>";


                var combinedHtml = '<div class="chat">' +
                    avatarHtml +
                    '<div class="chat-body">' +
                    messageHtml +
                    '</div>' +
                    '</div>';

                $(".user-chats > .chats").append(combinedHtml);
                $(".message").val("");
                $(".user-chats").scrollTop($(".user-chats > .chats").height());

                $.ajax({
                    type: 'POST',
                    url: '{{ route('send.messages') }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#myform').on('submit', function(e) {
                e.preventDefault();
                enter_chat();
            });
        });
    </script>
@endsection
