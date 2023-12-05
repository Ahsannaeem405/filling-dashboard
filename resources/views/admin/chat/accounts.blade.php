<ul>
    @if (isset($accounts))
        @foreach ($accounts as $account)
            <li class="list-style" data-refresh="{{ $account->refreshToken }}"
                data-user-id="{{ $account->account_id }}" data-id="{{ $account->id }}">
                <img src="{{ $account->adPic }}" alt="">
                <div class="user-chat-info">
                    <div class="contact-info">
                        <div style="display: flex; justify-content:space-between">
                            <h5 class="font-weight-bold mb-0">{{ substr($account->adTitle,0,22) }}</h5>
                            <p style="margin-bottom: 0px">{{ \Carbon\Carbon::parse($account->reloadDate)->format('d.m.y, H:i') }}</p>
                        </div>
                        <p class="truncate" style="max-width:75%">{{ $account->adPrice }} €</p>
                    </div>
                </div>
                
                <span></span>
            </li>
        @endforeach
    @endif
</ul>