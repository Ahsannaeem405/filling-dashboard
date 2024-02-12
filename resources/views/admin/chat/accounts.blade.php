<ul style="margin-bottom: 20px">
    @if (isset($accounts))
        @foreach ($accounts as $account)
            <li class="list-style ToggleBtn" data-id="{{ $account->id }}">
                <div class="avatar  mr-1">
                    <img class="adPic" src="{{ $account->adPic }}" alt="">
                    @if ($account->adStatus == 'ACTIVE')
                        <p class="avatar-status-online"></p>
                    @else
                        <p class="avatar-status-busy"></p>
                    @endif
                </div>
                <div class="user-chat-info new-user d-flex">
                    <div class="contact-info">
                        <div style="display: flex; justify-content:space-between">
                            <h5 class="font-weight-bold mb-0 ellipsis">{{ $account->adTitle }}
                                &nbsp;&nbsp;&nbsp;
                            </h5>
                            <p style="margin-bottom: 0px">
                                {{ \Carbon\Carbon::parse($account->reloadDate)->format('d.m.y') }}
                            </p>
                        </div>
                        <div style="display: flex; justify-content:space-between">
                            <p class="truncate" style="max-width:75%">{{ $account->adPrice }} €</p>
                            <p class="unread-chat {{$account->unRead()==0 ? 'd-none' : ''}}" data-account-id="{{ $account->account_id }}">{{$account->unRead()}} </p>

                        </div>
                    </div>
                    @if (Auth::user()->role == 'user')
                        @if ($account->adStatus == 'ACTIVE')
                            <div class="float-right ml-2"><i class="fa fa-rotate-right"
                                    id="{{ $account->id }}"></i></div>
                        @else
                            <div class="float-right ml-2"><i class="fa fa-xmark"
                                    id="{{ $account->id }}"></i></div>
                        @endif
                    @endif
                </div>
            </li>
        @endforeach
    @endif
</ul>
