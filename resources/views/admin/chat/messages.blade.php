    <style>
        .time-right{
            font-size: 10px;
            margin-top: 46px;
            position: absolute;
            right: 320px;
        }
        .time-left{
            font-size: 10px;
            margin-top: 46px;
            position: absolute;
            left: 315px;
        }
    </style>
    <div class="chat_navbar">
        <header class="chat_header d-flex justify-content-between align-items-center p-1">
            <div class="vs-con-items d-flex align-items-center">
                <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                    <span class="initials">{{ $data['sellerInitials'] }}</span>
                    <span class="avatar-status-busy"></span>
                </div>
                <span class='account-prof'>
                    <h6 class="mb-0">{{ $data['sellerName'] }}</h6>
                    <p>75€ VB</p>

                </span>
            </div>
            <div>
                <span class="favorite"><i class="feather icon-home font-medium-5"></i></span>
                <span class="favorite"><i class="feather icon-star font-medium-5"></i></span>
                <span class="favorite"><i class="feather icon-trash font-medium-5"></i></span>
            </div>
        </header>
    </div>
    <div class="user-chats">
        <div class="chats">
            @php
                use Carbon\Carbon;
            @endphp
            @foreach ($data['messages'] as $message)
                @if ($message['boundness'] === 'OUTBOUND')
                    @php
                        $carbonDate = Carbon::parse($message['receivedDate']);
                    @endphp
                    <div class="chat">
                        <div class="chat-avatar">
                            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right"
                                title="" data-original-title="">
                                <span class="initials">{{ $data['buyerInitials'] }}</span>
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-content">
                                <p>{{ $message['textShort'] }}</p>
                            </div>
                            <span class="time-left">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                        </div>
                    </div>
                @elseif($message['boundness'] === 'INBOUND')
                    @php
                        $carbonDate = Carbon::parse($message['receivedDate']);
                    @endphp
                    <div class="chat chat-left">
                        <div class="chat-avatar">
                            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left"
                                title="" data-original-title="">
                                <span class="initials">{{ $data['sellerInitials'] }}</span>
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-content">
                                <p>{{ $message['textShort'] }}</p>
                            </div>
                            <span class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="chat-app-form">
        <form class="chat-app-input d-flex justify-content-between position-relative" onsubmit="enter_chat();"
            id="myform" action="javascript:void(0);">
            <div class='position-relative'style='width: 70%;'>
                <input type="text" class="form-control message mr-1 ml-50 msg" id="iconLeft4-1"
                    placeholder="Type your message">
                <i class="type-icon fa fa-image"></i>
                <img class='type-icon' src="{{ asset('app-assets/images/logo/face.png') }}" alt="user_avatar">
            </div>
            <button type="button" class="btn btn-primary send" onclick="enter_chat(); "><i
                    class="fa fa-paper-plane-o"></i> <span class="">Senden</span></button>
        </form>
    </div>
    <input type="hidden" class="new" value="{{ $refreshToken }}" data-user-id="{{ $data['userIdSeller'] }}" data-conv-id="{{ $data['id'] }}">

    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/pages/app-chat.js')}}"></script>
    

    <script>
        // function enter_chat(source) {
        //     var message = $(".message").val();
        //     var refreshToken = $('.new').val();
        //     var user_id = $('.new').attr('data-user-id');
        //     var conv_id = $('.new').attr('data-conv-id');

        //     if (message != "") {
        //         var avatarHtml = '<div class="chat-avatar">' +
        //             '<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">' +
        //             '<span class="initials">{{ $data['buyerInitials'] }}</span>' +
        //             '</a>' +
        //             '</div>';

        //         var messageHtml = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";

        //         var combinedHtml = '<div class="chat">' +
        //             avatarHtml +
        //             '<div class="chat-body">' +
        //             messageHtml +
        //             '</div>' +
        //             '</div>';

        //         $(".user-chats > .chats").append(combinedHtml);
        //         $(".message").val("");
        //         $(".user-chats").scrollTop($(".user-chats > .chats").height());

        //         $.ajax({
        //             type: 'POST',
        //             url: '{{ route('send.messages') }}',
        //             data: {
        //                 message: message,
        //                 user_id: user_id,
        //                 conv_id: conv_id,
        //                 refreshToken: refreshToken
        //             },
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(response) {
        //                 console.log(response);
        //             },
        //             error: function(error) {
        //                 console.error(error);
        //             }
        //         });
        //     }
        // }

        function enter_chat(source) {
            var message = $(".message").val();
            var refreshToken = $('.new').val();
            var user_id = $('.new').attr('data-user-id');
            var conv_id = $('.new').attr('data-conv-id');

            if (message != "") {
                var now = new Date(); // Get the current date and time
                var timestamp = now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + now.getDate()).slice(-2) + ' ' + ('0' + now.getHours()).slice(-2) + ':' + ('0' + now.getMinutes()).slice(-2) + ':' + ('0' + now.getSeconds()).slice(-2);

                var avatarHtml = '<div class="chat-avatar">' +
                    '<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">' +
                    '<span class="initials">{{ $data['buyerInitials'] }}</span>' +
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

                $.ajax({
                    type: 'POST',
                    url: '{{ route('send.messages') }}',
                    data: {
                        message: message,
                        user_id: user_id,
                        conv_id: conv_id,
                        refreshToken: refreshToken
                    },
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

    </script>