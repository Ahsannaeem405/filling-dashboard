<ul>
    @if (isset($accounts))
        @foreach ($accounts as $account)
            <li class="list-style" data-id="{{ $account->id }}">
                <div class="avatar user-profile-toggle mr-1">
                    <img class="adPic" src="{{ $account->adPic }}" alt="">
                    @if ($account->adStatus == 'ACTIVE')
                        <p class="avatar-status-online"></p>
                    @else
                        <p class="avatar-status-busy"></p>
                    @endif    
                </div>
                <div class="user-chat-info new-user">
                    <div class="contact-info">
                        <div style="display: flex; justify-content:space-between">
                            <h5 class="font-weight-bold mb-0">{{ substr($account->adTitle, 0, 11) }} &nbsp;&nbsp;&nbsp;
                            </h5>
                            <p style="margin-bottom: 0px">
                                {{ \Carbon\Carbon::parse($account->reloadDate)->format('d.m.y') }}
                            </p>
                        </div>
                        <p class="truncate" style="max-width:75%">{{ $account->adPrice }} €</p>
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</ul>