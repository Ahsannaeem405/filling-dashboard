<style>
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
    .time-left-append{
        font-size: 12px;
        margin-top: 43px;
        position: absolute;
        right: 95px;
    }
</style>

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
                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title=""
                    data-original-title="">
                    <span class="initials">{{ $data['sellerInitials'] }}</span>
                </a>
            </div>
            <div class="chat-body">
                <div class="chat-content">
                    <p>{{ $message['textShort'] }}</p>
                    <p>
                        <span class="time-left">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                    </p>
                </div>
            </div>
        </div>
    @elseif($message['boundness'] === 'INBOUND')
        @php
            $carbonDate = Carbon::parse($message['receivedDate']);
        @endphp
        <div class="chat chat-left">
            <div class="chat-avatar">
                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title=""
                    data-original-title="">
                    <span class="initials">{{ $data['buyerInitials'] }}</span>
                </a>
            </div>
            <div class="chat-body">
                <div class="chat-content">
                    <p>{{ $message['textShort'] }}</p>
                    <p>
                        <span class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endif
@endforeach
<input type="hidden" class="new" value="{{ $refreshToken }}" data-user-id="{{ $data['userIdSeller'] }}" data-conv-id="{{ $data['id'] }}">
<script>
    // Function to handle form submission
    function enter_chat() {
        var message = $(".message").val();
        var refreshToken = $('.new').val();
        var user_id = $('.new').attr('data-user-id');
        var conv_id = $('.new').attr('data-conv-id');

        if (message != "") {
            // Remove the previous message
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

            var messageHtml = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
            var timeHtml = '<span class="time-left-append">' + timestamp + '</span>';

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

    // Function to handle form submission on Enter key press
    $(document).ready(function() {
        $('#myform').on('submit', function(e) {
            e.preventDefault();
            enter_chat();
        });
    });
</script>
