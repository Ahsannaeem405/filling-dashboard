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
</style>
@foreach ($data['conversations'] as $data)
    <li class="messages" data-user-id="{{ $data['userIdSeller'] }}" data-refresh-token="{{ $refreshToken }}" data-conv-id="{{ $data['id'] }}">
        <div class="pr-1">
            <span class="initials">{{ $data['sellerInitials'] }}</span>
        </div>
        <div class="user-chat-info">
            <div class="contact-info">
                <h5 class="font-weight-bold mb-0">{{ $data['sellerName'] }}</h5>
                <p class="truncate">{{ $data['textShortTrimmed'] }}</p>
            </div>
            <div class="contact-meta">
                <span class="float-right mb-25"></span>
            </div>
        </div>
    </li>
@endforeach
