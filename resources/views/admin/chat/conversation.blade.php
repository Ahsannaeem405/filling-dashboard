<style>
    .initials{
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
    .unread-msg{
        border-radius: 50%;
        background-color: goldenrod;
        color: black;
        height: 20px;
        width: 20px;
        text-align: center;
    }
</style>
{{--@foreach ($data['conversations'] as $data)--}}
{{--    <li class="messages" data-id="{{ $id }}" data-conv-id="{{ $data['id'] }}">--}}
{{--        <div class="pr-1">--}}
{{--            <span class="initials">{{ $data['buyerInitials'] }}</span>--}}
{{--        </div>--}}
{{--        <div class="user-chat-info">--}}
{{--            <div class="contact-info">--}}
{{--                <div style="display: flex; justify-content:space-between">--}}
{{--                    <h5 class="font-weight-bold mb-0">{{ $data['buyerName'] }}</h5>--}}
{{--                    <p style="margin-bottom: 0px">{{ \Carbon\Carbon::parse($data['receivedDate'])->format('d.m.y, H:i') }}</p>--}}
{{--                </div>--}}
{{--                <div style="display: flex; justify-content:space-between">--}}
{{--                    <p class="truncate" style="max-width:75%">{{ $data['textShortTrimmed'] }}</p>--}}
{{--                    @if($data['unreadMessagesCount'] > 0)--}}
{{--                        <span class="unread-msg">{{ $data['unreadMessagesCount'] }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </li>--}}
{{--@endforeach--}}

@foreach ($data as $conversation)
    <li class="messages" data-id="{{ $conversation->account_id }}" data-conv-id="{{ $conversation->id }}">
        <div class="pr-1">
            <span class="initials">{{ Str::ucfirst(mb_substr($conversation->from,0,1)) }}</span>
        </div>
        <div class="user-chat-info">
            <div class="contact-info">
                <div style="display: flex; justify-content:space-between">
                    <h5 class="font-weight-bold mb-0">{{ $conversation->from}}</h5>
                    <p style="margin-bottom: 0px">{{ $conversation->created_at->format('d.m.y, H:i') }}</p>
                </div>
                <div style="display: flex; justify-content:space-between">
                    <p class="truncate" style="max-width:75%">{!! $conversation->getLastMessage->message ?? '' !!}</p>
                    @if($conversation->getUnreadMessages->count() > 0)
                        <span class="unread-msg">{{ $conversation->getUnreadMessages->count() }}</span>
                    @endif
                </div>
            </div>

        </div>
    </li>
@endforeach
