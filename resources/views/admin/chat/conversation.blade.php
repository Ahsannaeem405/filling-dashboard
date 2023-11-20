@foreach ($data['conversations'] as $data)
    <li class="messages" data-id="{{ $data['userIdBuyer'] }}">
        <div class="pr-1">
            <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ $data['adImage'] }}"
                    height="42" width="42" alt="Generic placeholder image">
                <i></i>
            </span>
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
