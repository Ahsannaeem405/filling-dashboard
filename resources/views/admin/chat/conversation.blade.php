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
@foreach ($data['conversations'] as $data)
    <li class="messages" data-id="{{ $id }}" data-conv-id="{{ $data['id'] }}">
        <div class="pr-1">
            <span class="initials">{{ $data['buyerInitials'] }}</span>
        </div>
        <div class="user-chat-info">
            <div class="contact-info">
                <div style="display: flex; justify-content:space-between">
                    <h5 class="font-weight-bold mb-0">{{ $data['buyerName'] }}</h5>
                    <p style="margin-bottom: 0px">{{ \Carbon\Carbon::parse($data['receivedDate'])->format('d.m.y, H:i') }}</p>
                </div>
                <div style="display: flex; justify-content:space-between">
                    <p class="truncate" style="max-width:75%">{{ $data['textShortTrimmed'] }}</p>
                    @if($data['unreadMessagesCount'] > 0)
                        <span class="unread-msg">{{ $data['unreadMessagesCount'] }}</span>
                    @endif
                </div>
            </div>
            <div class="contact-meta">
                
                {{-- <span class="float-right mb-25">11</span> --}}
            </div>
        </div>
    </li>
@endforeach
