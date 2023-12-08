<style>
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

@php
    use Carbon\Carbon;
@endphp
@foreach ($data['messages'] as $message)
    @if (!empty($message['textShort']))
        @if (isset($message['boundness']) && $message['boundness'] === 'OUTBOUND')
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
        @elseif(isset($message['boundness']) && $message['boundness'] === 'INBOUND')
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
        @elseif(isset($message['paymentAndShippingMessageType']))
            @php
                $carbonDate = Carbon::parse($message['receivedDate']);
            @endphp
            <div class="chat chat-left">
                <div class="chat-avatar">
                    <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title=""
                        data-original-title="">
                        <span class="initials" style="font-size: 13px">Offer</span>
                    </a>
                </div>
                <div class="chat-body">
                    <div class="chat-content">
                        <p>Title: {{ $message['title'] }}</p>
                        <p>{{ isset($message['itemPriceInEuroCent']) ? 'Price: ' . $message['itemPriceInEuroCent'] / 100 . '€' : '' }}
                        </p>
                        <p>
                            <span class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endforeach
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
